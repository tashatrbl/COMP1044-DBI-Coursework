var navigationdelay = 700;
var audio = new Audio("assets/interface.mp3");
function interfere(link) {
  audio.play();
  setTimeout(() => {
    if (window.location.href.includes(link)) return;
    window.location.href = link;
  }, navigationdelay);
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
