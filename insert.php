<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$country = $_POST['country'];
$feedback = $_POST['feedback'];
if (!empty($firstname) || !empty($lastname) || !empty($email) || !empty($country) || !empty($feedback)) {
    /*$host = "sql213.epizy.com";
    $dbUsername = "epiz_28272086";
    $dbPassword = "OXbViTvISP";
    $dbname = "epiz_28272086_mydb";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);*/
    $db = new mysqli('127.0.0.1', 'root', '', 'fb_form');
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (firstname, lastname, email, country, feedback) values(?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $firstname , $lastname , $email, $country , $feedback);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already fill in using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>