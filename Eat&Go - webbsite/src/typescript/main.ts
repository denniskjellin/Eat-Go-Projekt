

"use strict";
//init function, load when page loads
window.onload = init;
function init() {
  getMenus();
  siteLocation();
}
//import of modules
import { siteLocation } from "./navbar_module.js";
import {
  url_menu,
  writeoutWeek,
  getMenus,
  writeMenu,
} from "./menues_module.js";
import {
  resDateInput,
  resTimeInput,
  resNameInput,
  resPeopleInput,
  resPhoneInput,
  subBtn,
  errorMsg,
  successMsg,
  url_res,
  createRes,
  clearForm,
} from "./reservation_module.js";
import {url_email, error, success, nameInput, emailInput, subInput, msgInput, sendMailBtn, postEmail} from "./email_module.js";

// submit button reacts on click
if (subBtn != null) {
  // this if statements helps me from getting error in console on pages where this button isn't used
  subBtn.addEventListener("click", createRes);
}


if (sendMailBtn != null) {
  //event listener to trigger postEmail
  sendMailBtn.addEventListener("click", postEmail)
  }

