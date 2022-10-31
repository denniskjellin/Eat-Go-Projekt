

//variabels for reservation form
export const resDateInput = document.getElementById("date") as HTMLInputElement;
export const resTimeInput = document.getElementById("time") as HTMLInputElement;
export const resNameInput = document.getElementById("name") as HTMLInputElement;
export const resPhoneInput = document.getElementById("phonenum") as HTMLInputElement;
export const resPeopleInput = document.getElementById("persons") as HTMLInputElement;
export const subBtn = document.getElementById("submit") as HTMLInputElement;
export const errorMsg = document.getElementById("error") as HTMLElement;
export const successMsg = document.getElementById("success") as HTMLElement;

//url for reservations api
//export const url_res = "http://localhost/P_webbservice/reservations_api.php";
export const url_res = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/reservations_api.php";

export function createRes(event: any) {
    //prevent page from reloading
    event.preventDefault();
  
    //variabels with data value
    let resDate = resDateInput.value;
    let resTime = resTimeInput.value;
    let resPhone = resPhoneInput.value;
    let resName = resNameInput.value;
    let resPeople = resPeopleInput.value;
  
    // insert in this order
    let jsonStr = JSON.stringify({
      //columns
      date: resDate,
      time: resTime,
      phonenum: resPhone,
      name: resName,
      persons: resPeople,
    });
  
    //fetch url, post to it
    fetch(url_res, {
      method: "POST",
      headers: {
        "content-type": "application/json",
      },
      body: jsonStr,
    }).then((response) => {
      //if response is not OK
      if (response.status != 201) {
        errorMsg.innerHTML =
        //errormsg writeout
          "<p class='text-error  t-center'><strong>Kontrollera inmatningsfält och försök igen.</strong></p>";
        successMsg.innerHTML = "";
        return;
      }
      return response
        .json()
        .then((data) => {
          //if response is OK
          successMsg.innerHTML =
          //succesMsg writeout
            "<p class='text-secondary t-center'><strong>Tack för din bokning!</strong></p>";
          errorMsg.innerHTML = "";
          clearForm();
        })
        .catch((err) => {
          console.log(err);
        });
    });
  }

  //Clear form on submit
export function clearForm() {
    resDateInput.value = "";
    resTimeInput.value = "";
    resPhoneInput.value = "";
    resNameInput.value = "";
    resPeopleInput.value = "";
  }

  