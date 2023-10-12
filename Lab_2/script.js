function showTime() {
  let date = new Date();
  let day = date.getDate();
  let mounth = date.getMonth() + 1;
  let year = date.getFullYear();

  let hour = date.getHours();
  let min = date.getMinutes();
  let sec = date.getSeconds();

  document.getElementById("date").innerHTML = day + "/" + mounth + "/" + year;
  document.getElementById("time").innerHTML = hour + ":" + min + ":" + sec;
  setTimeout("showTime()", 1000);
}
