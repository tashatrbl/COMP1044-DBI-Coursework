var navigationdelay = 700;
var audio = new Audio("assets/interface.mp3");
function interfere(link) {
  audio.play();
  setTimeout(() => {
    if (window.location.href.includes(link)) return;
    window.location.href = link;
  }, navigationdelay);
}

function settBtnTrigger() {
  var dropdown = document.getElementById("settDropdown");
  if (dropdown.style.display === "block") {
    dropdown.style.display = "none";
  } else {
    dropdown.style.display = "block";
  }
}
