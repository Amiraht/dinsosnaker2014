<?php
	$q = mysql_query("UPDATE tbl_ucapan_naik_jabatan SET lihat = '2' WHERE tujuan = '".$_SESSION["simpeg_username"]."'");
?>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">Daftar Ucapan Atas Kenaikan Jabatan Buat <?=$username;?></h3>
    <div class="bodypanel">
    <?php
        $sql = "SELECT a.* , b.nama_pegawai as 'dari' 
		
				FROM tbl_ucapan_naik_jabatan a
				LEFT JOIN tbl_pegawai b ON a.dari = b.id_pegawai
				WHERE 
					a.tujuan = '". $_SESSION['simpeg_username'] ."' 
					ORDER BY tgl_post DESC";
					
        $res = mysql_query($sql) or die(mysql_error());
		$no = 1;
        while($ds = mysql_fetch_array($res)){
            echo("<div class='judul_berita'>Ucapan ke - " . $no . "</div>");
            echo("<div class='tgl_berita'>Dikirim oleh ". ($ds["dari"] == "" ? "Admin Simpeg /SKPD" : $ds["dari"] ) ." pada : " . $ds["tgl_post"] . "</div>");
            echo("<div class='intro_berita'>" . $ds["pesan_teks"] . "</div>");
            echo("<div class='kelang_border'></div><br/>");
			$no++;
        }
    ?>
    </div>
</div>