/**
 *
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */

// url to api
export const url_email ="https://studenter.miun.se/~dekj2100/writeable/P_webbservice/email_api.php";
// error element
export const error = document.getElementById("error") as HTMLElement;
// success element
export const success = document.getElementById("success") as HTMLElement;
// inpus from the form
export const nameInput = document.getElementById("name") as HTMLInputElement;
export const emailInput = document.getElementById("email") as HTMLInputElement;
export const subInput = document.getElementById("subject") as HTMLInputElement;
export const msgInput = document.getElementById("msg") as HTMLInputElement;
export const sendMailBtn = document.getElementById("sendBtn") as HTMLInputElement;

    export function postEmail(event: any) {
       //prevent page from reloading
       event.preventDefault();
       //variabels with data values
       let name = nameInput.value;
       let email = emailInput.value;
       let subject = subInput.value;
       let msg = msgInput.value;
     
       // insert in this order
       let jsonStr = JSON.stringify({
         //columns
         name: name,
         email: email,
         subject: subject,
         msg: msg
       });
    
     //fetch url, post to it
     fetch(url_email, {
       method: "POST",
       headers: {
         "content-type": "application/json",
       },
       body: jsonStr,
     }).then((response) => {
       //if response is not OK
       if (response.status != 201) {
         error.innerHTML =
           "<p class='text-error'><strong>Kontrollera inmatningsfält och försök igen!</strong></p>";
         success.innerHTML = "";
         return;
       }
       return response
         .json()
         .then((data) => {
           //if response is OK
           success.innerHTML =
             "<p class='text-secondary'><strong>Tack för ditt meddelande!</strong></p>";
           error.innerHTML = "";
           clearEmailForm();
         })
         .catch((err) => {
           console.log(err);
         });
     });
 }

    //Clear form on submit
    export function clearEmailForm() {
      nameInput.value = "";
      emailInput.value = "";
      subInput.value = "";
      msgInput.value = "";
   
    }
  