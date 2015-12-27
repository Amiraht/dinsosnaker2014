<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("php/koneksi.php"); ?>
<?php include("php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--<meta name="viewport" content="width=device-width, initial-scale=1" />-->
	<title>:: PORTAL ANGGOTA KEARSIPAN PEMERINTAH KOTA MEDAN ::</title>
	<link rel="shortcut icon" href="image/favicon no sharpen.ico" />
	<!--<script src="jquery/js/jquery.js"></script>-->
    <script src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.19.custom.min.js"></script>
	<script src="js/jquery.alerts.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<link rel="stylesheet" href="css/laundry.css" />
	<link rel="stylesheet" href="js/alert/jquery.alerts.css" />
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" href="css/demo_table_jui.css" type="text/css" media="all" />
    <!--<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />-->
    <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.3.custom.css" type="text/css" media="all" />
    
    <!-- <FANCYBOX> -->
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <!-- </FANCYBOX> -->
    
    <script type="text/javascript">
    $(document).ready(function(){
        <?php
            if(isset($_SESSION["id_pengguna"])){
        ?>
            $("#topmenu").slideDown(500);
        <?php
            }
        ?>
        
        $('.listingtable').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
    });
    </script>
</head>
<body>
<div id="body">
<?php
    
            switch($_GET["mod"]){
                case "tambah_pps" :
                    include("isi/panel/tambah_pps.php");
                    break;
                /* =========== */
            }
?>
</div>
</body>
</html>
<?php ob_end_flush(); ?>