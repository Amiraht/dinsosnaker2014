<?php
$doa = mysql_query("UPDATE tbl_info_berkas SET arsip_akhir = '2' WHERE no_resi = '".$_GET["id"]."' ");
if($doa)
{
echo "<script type='text/javascript'>
				alert('DATA TELAH DISERAHKAN');
				document.location.href='index.php?mod=loket&opt=main';
		</script>";
}
?>