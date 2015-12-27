<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    $res = mysql_query("SELECT
                        	a.catatan, b.nip AS nip_asal, b.nama_pegawai AS nama_asal,
                        	c.nip AS nip_tujuan, c.nama_pegawai AS nama_tujuan
                        FROM
                        	tbl_uraian_realisasi_skp_catatan a
                        	LEFT JOIN tbl_pegawai b ON a.id_asal = b.id_pegawai
                        	LEFT JOIN tbl_pegawai c ON a.id_tujuan = c.id_pegawai
                        WHERE
                        	a.id_skp = '" . $_GET["id_skp"] . "' AND a.bulan = '" . $_GET["bulan"] . "'
                        ORDER BY
                        	a.id_skp_catatan ASC
                        ");
    while($ds = mysql_fetch_array($res)){
        echo("<div class='judullist'>" . $ds["nama_asal"] . " (NIP : " . $ds["nip_asal"] . ")</div>");
        echo("<div class='isilist'>");
            echo("<div>" . $ds["catatan"] . "</div>");
        echo("</div>");
    }
?>