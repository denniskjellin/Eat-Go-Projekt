
//export const url_menu = "http://localhost/P_webbservice/menu_api.php";
export const url_menu = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/menu_api.php";
export const writeoutWeek = document.getElementById("week-writeout") as HTMLElement;

// fetching menu
export function getMenus() {
    fetch(url_menu).then((response) => {
      if (response.status != 200) {
        return;
      }
      //return response
      return response
        .json()
        .then((data) => writeMenu(data))
        .catch((err) => console.log(err));
    });
  }

  //Write menu to DOM
export function writeMenu(menu: any[]): void {
    // currentDate - represents milliseconds since 1 January 1970 UTC.
    let currentDate = new Date();
    // startade 1 Januari
    let startDate = new Date(currentDate.getFullYear(), 0, 1);
    // substracting startDate from currentDate
    let days = Math.floor(
      (currentDate.getTime() - startDate.getTime()) / (24 * 60 * 60 * 1000)
    );
    //dividing results into milliseconds in a day = difference between dates in days
    let weekNumber = Math.ceil(days / 7);
    // turn into a string
    let currentWeek = weekNumber.toString();
  
      // d stores new date
      let d = new Date();
      // year gets the full year in a int (ex 2022)
      let year = d.getFullYear();
      // currentYear takes year and makes it into a string
      let currentYear = year.toString();
  
      //writeout element
      const writeout = document.getElementById("writeout");
      
  
    if (writeout != null) {
      writeout.innerHTML = "";
    
      menu.forEach((menu) => {
        
        if (currentWeek === menu.week && currentYear === menu.year) {
          writeout.innerHTML += `<h2 class="mt-1 mb-1 text-secondary-dark-3 font-xl"> ${menu.title}</h2>`;
          writeout.innerHTML += `${menu.content}`;
          //writing out the current week in the page title
          writeoutWeek.innerHTML += `<h2 class="font-xl t-center text-white pt-0 pb-1 underline"> vecka ${menu.week}</h2>`;
        }
      });
    }
  }