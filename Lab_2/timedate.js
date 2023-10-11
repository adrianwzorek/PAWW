function getDate() {
  todays = new Date();
  theDate =
    "" +
    (todays.getMonth() + 1) +
    "/" +
    todays.getDate() +
    "/" +
    (todays.getYear() - 100);
  document.getElementById("data").innerHTML = theDate;
}

var timerId = null;
var timerRunning = false;

function stopclock() {
  timerRunning ? clearTimeout(timerId) : (timerRunning = false);
}

function startclock() {
  stopclock();
  getDate();
  showtime();
}

function showtime() {
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds();
  var timevalue = " " + (hours > 12 ? hours - 12 : hours);
  timeValue += (minutes < 10 ? ":0" : ":") + minutes;
  timeValue += (seconds < 10 ? ":0" : ":") + seconds;
  timevalue += hours >= 12 ? "P.M." : "A.M.";
  document.getElementById("zegarek").innerHTML = timeValue;
  timerId = setTimeout("showtime()", 1000);
  timerRunning = true;
}
