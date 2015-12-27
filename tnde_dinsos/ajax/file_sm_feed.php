<?php
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    bacaDisp($_GET["id_disposisi"]);
    $res = mysql_query("SELECT * FROM myapp_filetable_suratmasuk WHERE id_surat_masuk='" . $_GET["id"] . "'");
	$num = mysql_num_rows($res);
	
	if($num <= 0){
		echo "<center><span style='color:green;font-size:14px;font-family:verdana;'>TIDAK ADA FILE LAMPIRAN SURAT MASUK</span></center>";
	}else{
		while($ds = mysql_fetch_array($res)){
?>
			<div class="judullist"><?php echo($ds["nama_file"]) ?></div>
			<div class="isilist">
				<?php echo($ds["keterangan"]) ?>
				<div style="clear: both;"></div>
					<a class="linktambahan" target="_blank" href="../uploaded/sm/<?php echo($ds["nama_file"]); ?>">Download</a>
				<div style="clear: both;"></div>
			</div>
<?php
		}
	}	
?>