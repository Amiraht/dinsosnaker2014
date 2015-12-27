<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    $res = mysql_query("SELECT
                        	b.nip AS nip_asal, b.nama_pegawai AS nama_asal,
                        	c.catatan, c.tgl_catatan
                        FROM
                        	tbl_riwayat_pangkat a
                        	LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai
                        	LEFT JOIN catatan_riwayat_pangkat c ON a.id_data = c.id_riwayat_pangkat
                        WHERE
                        	c.id_riwayat_pangkat = '". $_GET['id_riwayat_pangkat'] ."' 
                        ORDER BY
                        	a.id_data ASC
                        ") or die(mysql_error());
    while($ds = mysql_fetch_array($res)){
        echo("<div class='judullist'>" . $ds["nama_asal"] . " (NIP : " . $ds["nip_asal"] . "),<br/> Tanggal Supervisi : 
		   ".tglindonesia($ds["tgl_catatan"])."</div>");
        echo("<div class='isilist'>");
            echo("<div>" . $ds["catatan"] . "</div>");
        echo("</div>");
    }
?>