
window.onload = function(){
  console.log('Window loaded');
}
eventList = null;

var parseICS = function(){
  console.log("parseICS");
  var xhr = new XMLHttpRequest();
  var url = "http://script.studieradet.se/kurskurt/parseICS.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          eventList = JSON.parse(xhr.responseText);
          console.log("JSON responseText: " + eventList);
      }
  };
  xhr.send();
}
var listAllEvents = function () {
  for (var i in eventList) {
    console.log(eventList[i].title + " " + eventList[i].endTime);
  }
}
