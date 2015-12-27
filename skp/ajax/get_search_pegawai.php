<?php
    session_start();
    include("../php/koneksi.php");
    $whr = "";
    if($_GET["id_skpd"] != 0)
        $whr = "AND d.kode_skpd LIKE '" . $_GET["id_skpd"] . "%'";
    $sql = "SELECT
            	a.id_pegawai, a.nama_pegawai, a.nip,
            	b.pangkat, b.gol_ruang,
            	c.jabatan, d.skpd
            FROM
            	tbl_pegawai a
            	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
            	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
            	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
            WHERE
            	a.nip LIKE '%" . $_GET["nip"] . "%' AND a.nama_pegawai LIKE '%" . $_GET["nama_pegawai"] . "%' " . $whr . 
            "ORDER BY
                a.nama_pegawai ASC";
    $res = mysql_query($sql);
    $no = 0;
    while($ds = mysql_fetch_array($res)){
        $no++;
        echo("<tr>");
            echo("<td align='center'>" . $no . "</td>");
            echo("<td align='center'>" . $ds["nama_pegawai"] . "</td>");
            echo("<td align='center'>" . $ds["nip"] . "</td>");
            echo("<td align='center'>" . $ds["pangkat"] . "</td>");
            echo("<td align='center'>" . $ds["gol_ruang"] . "</td>");
            echo("<td align='center'>" . $ds["jabatan"] . "</td>");
            echo("<td align='center'>" . $ds["skpd"] . "</td>");
            echo("<td>
                    <img src='image/Button Next_32.png' width='18px' class='linkimage' title='Pilih Pegawai ini' onclick='pilih_pegawai_ini(\"" . $_GET["id_textbox"] . "\", \"" . $ds["nip"] . "\")' />
                  </td>");
        echo("</tr>");
    }
    if($no == 0){
        echo("<tr>");
            echo("<td align='center' colspan='8' style='padding: 10px;'><b>Tidak ada data ditemukan</b></td>");
        echo("</tr>");
    }
?>