
// ***OneSignal Setup***
// Add to index.js or the first page that loads with your app.
// For Intel XDK and please add this to your app.js.

function onLoad() {
  document.addEventListener('deviceready', onDeviceReady, false);
}

function onDeviceReady() {
  alert('Device Ready!');
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
    submitForm();
  };

  window.plugins.OneSignal
    .startInit("88aaa3f2-e759-4311-b1fd-d706b1d18335")
    .handleNotificationOpened(notificationOpenedCallback)
    .endInit();



  // Call syncHashedEmail anywhere in your app if you have the user's email.
  // This improves the effectiveness of OneSignal's "best-time" notification scheduling feature.
  // window.plugins.OneSignal.syncHashedEmail(userEmail);

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

function clicked(){
  console.log('Clicked!');
  alert('Clicked!');
}
