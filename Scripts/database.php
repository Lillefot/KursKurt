<?php

//header("Location: index.html");

require_once 'databaseCredentials.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

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
$user = mysqli_real_escape_string($conn, $_REQUEST['user']);
$courseID = mysqli_real_escape_string($conn, $_REQUEST['courseID']);
$courseTable = null;
$lectureName = mysqli_real_escape_string($conn, $_REQUEST['lectureName']);
$lectureID = null;
$goodBad = mysqli_real_escape_string($conn, $_REQUEST['q1']);
$comment = mysqli_real_escape_string($conn, $_REQUEST['q1comment']);

//Select and set chosen lectures lectureID
$sql = "SELECT LectureID FROM Lectures WHERE LectureName = '$lectureName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()){
    $lectureID = $row['LectureID'];
    echo ' Lecture ID = ' . $lectureID . '<br>';
  }
}
else {
  echo 'Error: Select FROM Lectures' . $conn->error;
}


//Insert from form to table
$courseTable = 'ResultsCourseID' . $lectureID;
echo 'CourseTable = ' . $courseTable . '<br>';
$sql = "INSERT INTO ResultsCourseID1 (CourseID, LectureName, LectureID, GoodBad, Comment, User)
VALUES ('$courseID', '$lectureName', '$lectureID', '$goodBad', '$comment', '$user')";
$result = $conn->query($sql);

if ($result === TRUE){
  echo 'Record added' . '<br>';
}
else {
  echo 'Could not add record:' . ' ' . $conn->error . '<br>';
}

//Close connection
mysqli_close($conn);

?>
