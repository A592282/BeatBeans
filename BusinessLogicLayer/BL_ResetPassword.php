<?php
@session_start();
function checkEmail($email) {
  // First, we check that there's one @ symbol,
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not,
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
↪([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}
require_once(dirname(__FILE__)."/BL_LoginClass.php");
$Email=$_POST['email'];
if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();
if(checkEmail($Email)) {
    if($Login->PasswordResetRequest($Email)) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../PostMessage.php?message=resetmailsent&email='.$Email.'">';
    }
}
else {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../resetpwd.php?message=wrongmailidformat&email='.$Email.'">';

}
?>
