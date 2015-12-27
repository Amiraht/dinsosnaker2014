<?php
    session_start();
    include("../php/koneksi.php");
    
    $sql = "SELECT
            	a.*, c.jenis_cuti
            FROM
            	tbl_riwayat_cuti a
            	LEFT JOIN tbl_usulan_cuti b ON a.id_pegawai = b.id_pegawai
                LEFT JOIN ref_jenis_cuti c ON a.id_jenis_cuti = c.id_jenis_cuti
            WHERE
            	b.id_usulan = '" . $_POST["id_usulan"] . "'";
    $res = mysql_query($sql)
?>
<table class="table table-striped table-bordered" style="font-family: arial; font-size: 8pt;">
    <thead>
        <tr>
            <th style="text-align: center; vertical-align: middle; text-transform: uppercase;">No.</th>
            <th style="text-align: center; vertical-align: middle; text-transform: uppercase;">Jenis Cuti</th>
            <th style="text-align: center; vertical-align: middle; text-transform: uppercase;">Lama (hari)</th>
            <th style="text-align: center; vertical-align: middle; text-transform: uppercase;">Dari / Sampai</th>
            <th style="text-align: center; vertical-align: middle; text-transform: uppercase;">No. SK Cuti</th>
            <th style="text-align: center; vertical-align: middle; text-transform: uppercase;">Tgl. SK Cuti</th>
            <th style="text-align: center; vertical-align: middle; text-transform: uppercase;">Pejabat Penandatangan SK</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $no = 0;
        if(mysql_num_rows($res) > 0){
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("
                    <tr>
                        <td style='text-align: center; vertical-align: middle;'>" . $no . "</td>
                        <td style='text-align: center; vertical-align: middle;'>" . $ds["jenis_cuti"] . "</td>
                        <td style='text-align: center; vertical-align: middle;'>" . $ds["lama"] . "</td>
                        <td style='text-align: center; vertical-align: middle;'>" . $ds["dari"] . "<br />S/D<br />" . $ds["sampai"] . "</td>
                        <td style='text-align: center; vertical-align: middle;'>" . $ds["no_sk"] . "</td>
                        <td style='text-align: center; vertical-align: middle;'>" . $ds["tgl_sk"] . "</td>
                        <td style='text-align: center; vertical-align: middle;'>" . $ds["pejabat_sk"] . "</td>
                    </tr>
                ");
            }
        }else{
            echo("
                    <tr>
                        <td colspan='6' style='text-align: center; vertical-align: middle;'>Data cuti masih kosong</td>
                    </tr>
                ");
        }
    ?>
    </tbody>
</table>