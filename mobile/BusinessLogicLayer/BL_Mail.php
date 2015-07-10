<?php
function SendMail($To_,$Subject_,$Message_) {
    $to  = $To_;
    $subject = $Subject_;
    $message = '
<html>
<head>
  <title>'.$Subject_.'</title>
</head>
<body>'.
  $Message_.'
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
    $headers .= 'From: BeatBeans <team@beatbeans.com>' . "\r\n";
    $headers .= 'Bcc: admin@beatbeans.com' . "\r\n";

// Mail it
    return(mail($to, $subject, $message, $headers));
}
?>
