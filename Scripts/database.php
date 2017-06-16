<?php

//header("Location: index.html");

$servername = 's531.loopia.se';
$username = 'itbev1@k172745';
$password = 'easypass';
$db = 'kurskurt_se';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
echo 'Connected successfully' . '<br>';

//Form variables
$user = mysqli_real_escape_string($conn, $_REQUEST['user']);
$kursID = mysqli_real_escape_string($conn, $_REQUEST['kursID']);
$bra = mysqli_real_escape_string($conn, $_REQUEST['q1']);
$kommentar = mysqli_real_escape_string($conn, $_REQUEST['q1comment']);

//Select and echo table
/*
$sql = 'SELECT * FROM Kurser';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()){
    echo $row['KursID'] . ' ' . $row['Kurs'] . ' ' . $row['Termin'] . '<br>';
  }
}
else {
  echo 'Error: Select FROM Kurser';
}
*/

//Insert from form to table
$sql = "INSERT INTO ResultatKursID1 (KursID, Bra, Kommentar, User)
VALUES ('$kursID', '$bra', '$kommentar', '$user')";
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
