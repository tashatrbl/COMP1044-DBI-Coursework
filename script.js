// Login audio cue
function playButton() {
  var audio = new Audio("button.mp3");
  audio.play();
}

// Audio cue when switching pages
var navigationdelay = 700;
var audio = new Audio("assets/interface.mp3");
function interfere(link) {
  audio.play();
  setTimeout(() => {
    if (window.location.href.includes(link)) return;
    window.location.href = link;
  }, navigationdelay);
}

// function to dim the background when sidebar is open OR when delete alert box is prompted
function dimBG() {
  var overlay = document.getElementById("bgOverlay");
  overlay.classList.toggle("active");
}

// Dropdown Menu Function
function settBtnTrigger() {
  var dropdown = document.getElementById("settDropdown");
  if (dropdown.style.display === "block") {
    dropdown.style.display = "none";
  } else {
    dropdown.style.display = "block";
  }
}

// Revealing next div
function revealDiv() {
  var carSection = document.getElementById("carSection");
  carSection.style.display = "block";
}

// Revealing Cars depending on the Car Type Selected
function revealCarModel() {
  var carType = document.getElementById("Cartype").value;
  var luxCarMenu = document.querySelector(".luxCarMenu");
  var sportsCarMenu = document.querySelector(".sportsCarMenu");
  var classCarMenu = document.querySelector(".classCarMenu");

  if (carType === "luxCar") {
    luxCarMenu.style.display = "block";
    sportsCarMenu.style.display = "none";
    classCarMenu.style.display = "none";
  } else if (carType === "sportsCar") {
    luxCarMenu.style.display = "none";
    sportsCarMenu.style.display = "block";
    classCarMenu.style.display = "none";
  } else if (carType === "classCar") {
    luxCarMenu.style.display = "none";
    sportsCarMenu.style.display = "none";
    classCarMenu.style.display = "block";
  }
}

// Changing Select buttons to change labels + Lowering opacity of modelBoxes of those unselected
function setSelected(radioId, labelId) {
  var label = document.getElementById(labelId);
  var modelBoxes = document.querySelectorAll(".modelBoxes");

  if (document.getElementById(radioId).checked) {
    label.innerHTML = "SELECTED";
  } else {
    label.innerHTML = "SELECT";
  }

  for (var i = 0; i < modelBoxes.length; i++) {
    if (modelBoxes[i].querySelector("input[type='radio']").id !== radioId) {
      modelBoxes[i].style.opacity = "0.5";
    } else {
      modelBoxes[i].style.opacity = "1";
    }
  }
}

// functions use in delete-reservation.php/manage-reservation.php
var selectedReservationId;

function autofillForm() {
  var checkboxes = document.getElementsByName("selected[]");
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      selectedReservationId = checkboxes[i].getAttribute("data-reservationid");
      break;
    }
  }

  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener("change", autofillForm);
  }
}

// function to delete reservation
// Show confirmation message before deleting the record
function deleteReservation() {
  const checkboxes = document.getElementsByName("selected[]");
  const selectedIds = [];
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      selectedIds.push(checkboxes[i].value);
    }
  }
  if (selectedIds.length === 0) {
    alert("Please select at least one record to delete.");
  } else {
    const confirmation = confirm(
      "Are you sure you want to delete the selected reservation(s)?\nReservation ID(s): " +
        selectedIds.join(", ") +
        "\n"
    );
    if (confirmation) {
      const reservationIdInputs = document.getElementsByName("reservationid");
      for (let i = 0; i < reservationIdInputs.length; i++) {
        const reservationIdInput = reservationIdInputs[i];
        if (selectedIds.includes(reservationIdInput.value)) {
          reservationIdInput.parentNode.parentNode.remove();
        }
      }
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
          alert("Reservation(s) deleted successfully.");
        }
      };
      xhr.open("POST", "delete-reservation-action.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("selected=" + selectedIds.join(","));
    }
  }
}

// highlighting row when checkbox/radio button is checked
function selectRow() {
  var radios = document.querySelectorAll("input[type=radio]");
  var checkboxes = document.querySelectorAll("input[type=checkbox]");

  for (var i = 0; i < radios.length; i++) {
    radios[i].onclick = function () {
      // remove class from the other rows

      var el = document.getElementById("first-tr");

      // go to the nex sibing
      while ((el = el.nextSibling)) {
        {
          if (el.tagName === "TR") {
            // remove the selected class
            el.classList.remove("selected");
          }
        }
      }

      this.parentElement.parentElement.classList.toggle("selected");
    };
  }

  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].onclick = function () {
      // remove class from the other rows

      var el = document.getElementById("first-tr");

      if (this.id !== "menu__toggle") {
        if (this.checked) {
          this.parentElement.parentElement.classList.toggle("selected");
        } else {
          this.parentElement.parentElement.classList.remove("selected");
        }
      }
    };
  }
}

// function to prompt alert box when user clicks on delete button
function revealAlertBox() {
  var alertBoxText = document.getElementById("text");

  const checkboxes = document.getElementsByName("selected[]");
  const selectedIds = [];
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      selectedIds.push(checkboxes[i].value);
    }
  }
  if (selectedIds.length === 0) {
    alert("Please select at least one record to delete.");
  } else {
    var overlay = document.getElementById("alertOverlay");
    overlay.classList.toggle("active");

    var alertBox = document.getElementById("alertBox");
    alertBox.style.display = "block";
    text.innerHTML = selectedIds.join("<br>");
  }
}

// function to close alert box
function closeAlertBox() {
  var overlay = document.getElementById("alertOverlay");
  overlay.classList.toggle("active");

  var alertBox = document.getElementById("alertBox");
  alertBox.style.display = "none";
}
