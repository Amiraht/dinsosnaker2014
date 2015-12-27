<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    $res = mysql_query("SELECT
                        	b.nip AS nip_asal, b.nama_pegawai AS nama_asal,
                        	c.catatan, c.tgl_catatan
                        FROM
                        	tbl_riwayat_jabatan a
                        	LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai
                        	LEFT JOIN catatan_riwayat_catatan c ON a.id_riwayat_jabatan = c.id_riwayat_catatan
                        WHERE
                        	c.id_riwayat_catatan = '". $_GET['id_riwayat_jabatan'] ."' 
                        ORDER BY
                        	a.id_skp_catatan ASC
                        ");
    while($ds = mysql_fetch_array($res)){
        echo("<div class='judullist'>" . $ds["nama_asal"] . " (NIP : " . $ds["nip_asal"] . "), Tanggal Supervisi : ".$ds["tgl_catatan"]."</div>");
        echo("<div class='isilist'>");
            echo("<div>" . $ds["catatan"] . "</div>");
        echo("</div>");
    }
?>