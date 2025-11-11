import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '../css/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';





/* Loop through all dropdown buttons to handle click events */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {

    // Get the dropdown content for the current button
    var currentDropdownContent = this.nextElementSibling;

    // Check if the current dropdown is already open
    var isCurrentOpen = currentDropdownContent.style.display === "block";

    // First, close all other dropdowns and remove the 'active' class from all buttons
    var allDropdowns = document.getElementsByClassName("dropdown-container");
    for (var j = 0; j < allDropdowns.length; j++) {
      allDropdowns[j].style.display = "none";
      // This is the key change: remove active class from all buttons
      dropdown[j].classList.remove("open");
    }

    // Now, if the current dropdown was not already open, open it and add the 'active' class
    if (!isCurrentOpen) {
      currentDropdownContent.style.display = "block";
      this.classList.add("open");
    }
  });
}
// testing
// console.log("connected");
