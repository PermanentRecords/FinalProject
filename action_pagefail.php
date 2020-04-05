<!DOCTYPE html>

<html>
  <head>
    <title>Test Title</title>
  </head>
  <body>

<?php

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

function died($error) {
    // errors
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br /><br />";
    echo $error."<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
}

function submitContact() {
  if(!isset($_POST['email'])) {
    return;
  }
  
  //sending email to me
  $email_to = "myEmail";
  $email_subject = "ComIT final project query";

  echo "Submitted:<br/>";
  echo "fname: '" . $_POST['fname'] . "'<br/>";
  echo "lname: '" . $_POST['lname'] . "'<br/>";
  echo "email: '" . $_POST['email'] . "'<br/>";
  echo "phone: '" . $_POST['phone'] . "'<br/>";
  echo "country: '" . $_POST['country'] . "'<br/>";
  echo "message: '" . $_POST['message'] . "'<br/><br/>";

  // validation expected data exists
  if (!isset($_POST['fname']) ||
      !isset($_POST['lname']) ||
      !isset($_POST['email']) ||
      !isset($_POST['phone']) ||
      !isset($_POST['country']) ||
      !isset($_POST['message'])) {
      died('We are sorry, but there appears to be a problem with the form you submitted.');
      return;
  }

  $first_name = $_POST['fname']; // required
  $last_name = $_POST['lname']; // required
  $email_from = $_POST['email']; // required
  $telephone = $_POST['phone'];
  $country = $_POST['country'];
  $message = $_POST['message']; // required

  $error_message = "";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp, $email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

  $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp, $first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp, $last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }

  if(strlen($message) < 2) {
    $error_message .= 'The message you entered do not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
    return;
  }

  $email_message = "Form details below.\n\n";

  $email_message .= "First Name: ".clean_string($fname)."\n";
  $email_message .= "Last Name: ".clean_string($lname)."\n";
  $email_message .= "Email: ".clean_string($email)."\n";
  $email_message .= "Telephone: ".clean_string($phone)."\n";
  $email_message .= "Message: ".clean_string($message)."\n";

  // create email headers
  $headers = 'From: ' . $email_from."\r\n". 'Reply-To: '.$email_from."\r\n" . 'X-Mailer: PHP/' . phpversion();
  $mailResponse = @mail($email_to, $email_subject, $email_message, $headers); 

  echo "<strong>Email sent!</strong>";
}

submitContact();

?>

  </body>
</html>
