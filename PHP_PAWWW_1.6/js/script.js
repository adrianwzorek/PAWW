let music = new Audio("./music/Prologue.mp3");

// function hideAll() {
//   $("#name").hide();
//   $("#people").hide();
//   $("#info").hide();
//   $("#hero").hide();
//   $("th").hide();
// }

// const showTitle = () => {
//   $("#people").fadeIn(3000);
//   $("#name").fadeIn(2000);
//   $("#info").fadeIn(2000);
//   $("#hero").fadeToggle(2000);
//   $("#herb").animate(
//     {
//       left: 20,
//       top: "8%",
//       fontSize: "120%",
//     },
//     2000
//   );
// };

// const showStudent = () => {
//   $("th").fadeToggle(1000);
// };

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
    if (el.classList.contains("active")) {
      time.classList.remove("m_nactive");
      time.classList.add("m_active");
      time.style.opacity = 100;
    } else {
      time.classList.remove("m_active");
      time.classList.add("m_nactive");
      time.style.opacity = 0;
    }
  }
}

function playMusic(el) {
  let item = document.getElementById("music");
  item.classList.toggle("active");
  if (document.getElementById("menu").classList.contains("m_active")) {
    if (item.classList.contains("active")) {
      music.play();
      item.src = "./css/Pictures/Icons/volume.png";
    } else {
      music.pause();
      item.src = "./css/Pictures/Icons/volume-off.png";
    }
  }
}

function showInfo(el) {
  let item = document.getElementById("info");
  let dock = document.getElementById("main");
  let info = document.getElementById("info_table");
  item.classList.toggle("active");
  if (item.classList.contains("active")) {
    info.style.zIndex = 1;
    info.style.opacity = 100;
    info.classList.replace("m_nactive", "m_active");
    info.classList.remove("nactive_link");
    dock.style.zIndex = 0;
    dock.style.opacity = 0;
    dock.classList.replace("m_active", "m_nactive");
  } else {
    info.classList.replace("m_active", "m_nactive");
    info.style.zIndex = 0;
    info.style.opacity = 0;
    info.classList.add("nactive_link");
    dock.style.zIndex = 1;
    dock.style.opacity = 100;
    dock.classList.replace("m_nactive", "m_active");
  }
}

function goToMovie() {
  window.open("./index.php?id=movies", "_blank");
}

function closeTab() {
  window.close();
}
