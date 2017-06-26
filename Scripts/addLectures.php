<?php

//header("Location: index.html");
require_once 'databaseCredentials.php';
include 'parseICS.php';

$GLOBALS['globalEventTimeAndTitle'] = $eventTimeAndTitle;

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
$GLOBALS['conn'] = $conn;

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
echo 'Connected successfully' . '<br>';

//Set character set to allow ÅÄÖ
printf("Initial character set: %s\n", mysqli_character_set_name($conn) . '<br>');
if (!mysqli_set_charset($conn, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($conn) . '<br>');
    exit();
} else {
    printf("Current character set: %s\n", mysqli_character_set_name($conn) . '<br>');
}

//Get form variables
$GLOBALS['globalCourseID'] = mysqli_real_escape_string($conn, $_REQUEST['courseID']);

function addLecture(){
  $lectureName = $GLOBALS['globalLecture'];
  $courseID = $GLOBALS['globalCourseID'];

  $sql = "INSERT IGNORE INTO Lectures (CourseID, LectureName)
  VALUES ('$courseID', '$lectureName')";
  $result = $GLOBALS['conn']->query($sql);

  if ($result === TRUE){
    echo 'Record added' . '<br>';
  }
  else {
    echo 'Could not add record:' . ' ' . $GLOBALS['conn']->error . '<br>';
  }
}

foreach ($GLOBALS['globalEventTimeAndTitle'] as $event) :
  echo 'addEvent' . $event['title'] . '<br>';
  $GLOBALS['globalLecture'] = $event['title'];
  echo 'Debug' . '<br>';
  addLecture();
endforeach;


//Close connection
mysqli_close($conn);

?>
