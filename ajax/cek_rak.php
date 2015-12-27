<?php
	include("../libraries/dinsos.php");

	$t = mysql_query("select * from tbl_lemari_rak where id_lemari='".$_GET["kd_lemari"]."'");
	while($t1 = mysql_fetch_array($t))
	{
		echo"<option value=$t1[id]>$t1[kode_rak]</option>";
	}
?>
 	