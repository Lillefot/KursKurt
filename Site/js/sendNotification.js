var sendNotification = function(){
var xhr = new XMLHttpRequest();
var url = "https://onesignal.com/api/v1/notifications";
xhr.open("POST", url, true);
xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
xhr.setRequestHeader("Authorization", "Basic OTViNGEyM2ItNWRkMC00MmMzLTk2OWMtNzFmZjc1ODgwYmY5")
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var json = JSON.parse(xhr.responseText);
        console.log("JSON responseText: " + json);
    }
};
var data = JSON.stringify({
  "app_id": "88aaa3f2-e759-4311-b1fd-d706b1d18335",
  "included_segments": ["All"],
  "contents": {"en": "English Message"}
});
xhr.send(data);
}
