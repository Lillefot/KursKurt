
// ***OneSignal Setup***
// Add to index.js or the first page that loads with your app.
// For Intel XDK and please add this to your app.js.

function onLoad() {
  document.addEventListener('deviceready', onDeviceReady, false);
}

function onDeviceReady() {
  // alert('Device Ready!');
  goodRadioButton = document.getElementById('q1r1');
  badRadioButton = document.getElementById('q1r2');
  goodBadChoice = null;
  databasePHP = 'http://script.studieradet.se/kurskurt/database.php';


  // ***OneSignal Setup***
  // Enable to debug issues.
  // window.plugins.OneSignal.setLogLevel({logLevel: 4, visualLevel: 4});

  var notificationOpenedCallback = function(jsonData) {
    console.log('notificationOpenedCallback: ' + JSON.stringify(jsonData));
    console.log('Action Taken by User: ' + JSON.stringify(jsonData.action.actionID));
    goodRadioButton.checked = true;
    //submitForm();
  };

  window.plugins.OneSignal
    .startInit("88aaa3f2-e759-4311-b1fd-d706b1d18335")
    .handleNotificationOpened(notificationOpenedCallback)
    .endInit();


  // Call syncHashedEmail anywhere in your app if you have the user's email.
  // This improves the effectiveness of OneSignal's "best-time" notification scheduling feature.
  // window.plugins.OneSignal.syncHashedEmail(userEmail);

}


function setLectureName(subtitle){
  lectureName = subtitle;
}

function submitForm(choice) {
  console.log('Checking form!')

  //document.getElementById('fKurtForm').action = databasePHP;
  //document.getElementById('fKurtForm').submit();

  //Set depending on user choice of Action Button
  goodBad = null;
  if (choice === 'Good') {
    goodBad = 1;
    console.log('goodBad = ' + goodBad);
  }
  else if (choice === 'Bad') {
    goodBad = 0;
    console.log('goodBad = ' + goodBad);
  }
  else {
    console.log('No choice made');
  }

  //Set form variables
  var comment = document.getElementById('q1comment').value;
  var user = document.getElementById('user').value;
  var courseID = document.getElementById('courseID').value;
  //var lectureName = document.getElementById('lectureName').value;

  //Send form to database
  var xhr = new XMLHttpRequest();
  var url = "http://script.studieradet.se/kurskurt/databaseFromAJAX.php";
  var url = url + "?comment=" + comment + "&goodBad=" + goodBad + "&user=" + user + "&courseID=" + courseID + "&lectureName=" + lectureName;
  xhr.onreadystatechange = function () {
      //Run on success
      if (xhr.readyState === 4 && xhr.status === 200) {
          console.log('Form submitted!');
      }
  };
  //Must be synchronus to keep the app awake long enough for request to finish
  xhr.open("GET", url, false);
  xhr.send(null);
  }
  // var xhr = new XMLHttpRequest();
  // xhr.onreadystatechange = function() {
  //   if (xhr.readyState == XMLHttpRequest.DONE) {
  //       console.log('Done!!!!!!!!', xhr.responseText);
  //   }
  // }
  // xhr.open('GET', 'https://requestb.in/1m4uevf1', false);
  // xhr.send(null);

function clicked(){
  console.log('Clicked!');
}
