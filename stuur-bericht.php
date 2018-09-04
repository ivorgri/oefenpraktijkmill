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
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    // header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: multipart/form-data");
  }

  // https://www.freecontactform.com/email_form.php
  if(isset($_POST['email'])) {

    function sendErrorMessage($error) {
      die(json_encode(array('errorMessage' => $error, 'success' => false)));
    };

    function sendMessage($message) {
      die(json_encode(array('message' => $message, 'success' => true)));
    };

    if(!isset($_POST['firstname'])) {
      sendErrorMessage('Voornaam is leeg.');
    }

    if(!isset($_POST['lastname'])) {
      sendErrorMessage('Achternaam is leeg.');
    }

    if(!isset($_POST['email'])) {
      sendErrorMessage('E-mailadres is leeg.');
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email_client = $_POST['email'];

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_client)) {
      sendErrorMessage('Het ingevoerde e-mailadres is incorrect.');
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$firstname)) {
      sendErrorMessage('De ingevoerde voornaam is incorrect.');
    }

    if(!preg_match($string_exp,$lastname)) {
      sendErrorMessage('De ingevoerde achternaam is incorrect.');
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
      'Reply-To: '.$email_company."\r\n" .
      'X-Mailer: PHP/' . phpversion();
    $did_mail_go_to_company = mail($email_company, $email_subject, $email_message_to_company, $headers);

    if(!$did_mail_go_to_company) {
      sendErrorMessage("Er ging iets fout met het versturen van de mail. Probeer het nogmaals, of verstuur de mail via uw favoriete mail programma.");
    }

    // Send e-mail to sender
    $headers = 'From: '.$email_company;
    $headers = 'From: '.$email_company."\r\n".
      'Reply-To: '.$email_client."\r\n" .
      'X-Mailer: PHP/' . phpversion();
    $did_mail_go_to_client = mail($email_client, $email_subject, $email_message_to_client, $headers);

    if(!$did_mail_go_to_client) {
      sendErrorMessage("Er is een fout opgetreden bij het versturen van de bevestigingsmail. Uw inschrijving is wel verstuurd.");
    }

    sendMessage("Uw inschrijving is succesvol verstuurd. We nemen zo snel mogelijk contact met U op.");
  };
?>