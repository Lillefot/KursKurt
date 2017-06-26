
window.onload = function(){
  console.log('Window loaded');
  goodRadioButton = document.getElementById('q1r1');
  badRadioButton = document.getElementById('q1r2');
  goodBadChoice = null;
  databasePHP = 'http://script.studieradet.se/kurskurt/database.php';
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
          document.getElementById('icsArray').value = eventList;
      }
  };
  xhr.send();
}
var listAllEvents = function () {
  console.log('icsArray: ' + document.getElementById('icsArray').value);
  for (var i in eventList) {
    console.log(eventList[i].title + " " + eventList[i].endTime);
  }
}

function submitForm() {
  console.log('Checking form!')

  if (goodRadioButton.checked){
    goodBadChoice = goodRadioButton.value;
  }
  else if (badRadioButton.checked) {
    goodBadChoice = badRadioButton.value;
  }

  if (goodBadChoice) {
  console.log('Submitting form!');
  console.log('goodBadChoice = ' + goodBadChoice);
  document.getElementById('fKurtForm').action = databasePHP;
  document.getElementById('fKurtForm').submit();
  console.log('Form submitted!');
  }
  else {
    alert('Fyll i om bra eller dålig!');
  }
}
