<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../php/dompdf_config.inc.php"); ?>
<?php require_once("../php/koneksi.php"); ?>
<?php require_once("../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>

<?php
    
     
?>
       
<?php
    $html = "";
    $html .= "<html>";
    $html .= "<head>";
    
    $html .= "</head>";
    $html .= "<body>";
    $html .= "TES";
    $html .= "</body>";
    $html .= "</html>";
?>
<?php
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("a4", "portrait");
    $dompdf->render();

    //echo($html);
    $dompdf->stream("laporan.pdf", array("Attachment" => false));
    mysql_close();
  exit(0);
?>