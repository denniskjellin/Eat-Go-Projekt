/**
 *
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
//Navbar code, current page

// variabels for the navigation current location check
export function siteLocation():void {
let currentLocation = location.href;
let menuItem = document.querySelectorAll("nav a") as unknown as HTMLLinkElement[];
let menuLength = menuItem.length;


//looping trough
for (let i = 0; i < menuLength; i++) {
  //giving the navbar-links + active class on the current navbar href tag
  if (menuItem[i].href === currentLocation) {
    menuItem[i].className = "active";
  }
} // END
}