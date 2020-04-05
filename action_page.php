<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$call = $_POST['call'];
$website = $_POST['website'];
$type = $_POST['type'];
$message = $_POST['message'];
$formcontent = "From: $name \n Phone: $phone \n Call Back: $call \n Website: $website \n Type: $type \n Message: $message";
$recipient = "andrew@permanentrecords.ca";
$subject = "School Project Query";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("There's a problem!");
echo "Thank You!";
?>