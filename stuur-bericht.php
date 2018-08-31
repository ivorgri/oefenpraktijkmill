<?php
  // https://stackoverflow.com/questions/41326257/how-i-can-get-origin-of-request-with-php
  // https://stackoverflow.com/questions/18382740/cors-not-working-php
  if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $origin = $_SERVER['HTTP_ORIGIN'];
  }
  else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
    $origin = $_SERVER['HTTP_REFERER'];
  } else {
    $origin = $_SERVER['REMOTE_ADDR'];
  }

  $allowed_domains = [
    "https://festive-austin-f94dda.netlify.com",
    "http://festive-austin-f94dda.netlify.com",
  ];

  if (in_array($origin, $allowed_domains)) {
    header("Access-Control-Allow-Methods: GET, POST");
    // header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Origin: *");
  }

  // https://www.freecontactform.com/email_form.php
  if(isset($_POST['email'])) {

    function errorMessage($error) {
      echo "We are very sorry, but there were error(s) found with the form you submitted. ";
      echo "These errors appear below.<br /><br />";
      echo $error."<br /><br />";
      echo "Please go back and fix these errors.<br /><br />";
      die();
    };

    if(!isset($_POST['firstname']) ||
      !isset($_POST['lastname']) ||
      !isset($_POST['email'])) {
      errorMessage('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email_client = $_POST['email'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_client)) {
      $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$firstname)) {
      $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }

    if(!preg_match($string_exp,$lastname)) {
      $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    }

    if(strlen($error_message) > 0) {
      errorMessage($error_message);
    }

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_company = "ivorgrisel@gmail.com";
    $email_subject_to_company = "Er is een nieuwe aanmelding";
    $email_subject_to_sender = "Bedankt voor uw aanmelding";

    $email_message_to_company .= "De volgende persoon heeft zich aangemeld: "
      .clean_string($firstname)." ".clean_string($lastname).".";

    $email_message_to_client .= "Bedankt voor uw aanmelding "
      .clean_string($firstname)." ".clean_string($lastname).".";

    // Send e-mail to Oefenpraktijk Mill
    $headers = 'From: '.$email_client."\r\n".
        'Reply-To: '.$email_client."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_company, $email_subject, $email_message_to_company, $headers);

    // Send e-mail to sender
    /* $headers = 'From: '.$email_company."\r\n".
        'Reply-To: '.$email_company."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_client, $email_subject, $email_message_to_client, $headers); */
  };
?>