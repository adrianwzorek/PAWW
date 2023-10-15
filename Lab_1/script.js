let music = new Audio("./music/Prologue.mp3");

function showTime() {
  let date = new Date();
  let hour = date.getHours();
  let min = date.getMinutes();
  let sec = date.getSeconds();
  min = min < 10 ? "0" + min : min;
  sec = sec < 10 ? "0" + sec : sec;
  document.getElementById("time").innerHTML = hour + ":" + min + ":" + sec;
  if (document.getElementById("clock").classList.contains("active") == true) {
    document.getElementById("time").style.opacity = 100;
  } else {
    document.getElementById("time").style.opacity = 0;
  }
  setTimeout("showTime()", 1000);
}

function changeStyle(el) {
  el.classList.toggle("magic_active");
  let menu = document.getElementById("menu");
  menu.classList.toggle("m_active");
}

function lookAtTime(el) {
  let time = document.getElementById("time");
  if (document.getElementById("menu").classList.contains("m_active")) {
    el.classList.toggle("active");
    el.classList.contains("active")
      ? (time.style.opacity = 100)
      : (time.style.opacity = 0);
  }
}

function playMusic(el) {
  let item = document.getElementById("music");
  item.classList.toggle("active");
  if (document.getElementById("menu").classList.contains("m_active")) {
    if (item.classList.contains("active")) {
      music.play();
      item.classList.replace("fi-rr-volume-off", "fi-rr-volume");
    } else {
      music.pause();
      item.classList.replace("fi-rr-volume", "fi-rr-volume-off");
    }
  }
}
