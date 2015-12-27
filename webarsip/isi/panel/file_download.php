<script type="text/javascript">
function download(id){
    //alert(id);
    window.open("php/file_download.php?id=" + id);
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>
        <?php
            switch($_GET["id"]){
                case 1 :
                    echo("FILE DOWNLOAD");
                    break;
                case 2 :
                    echo("PANDUAN PENGGUNAAN");
                    break;
                case 3 :
                    echo("BERITA DAN INFORMASI");
                    break;
            }
        ?>
    </h3>
    <div class="bodypanel">
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>Judul</th>
            <th width='150px'>Kategori</th>
            <th width='200px'>Nama File</th>
            <th>Keterangan</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $whr = "";
            switch($_SESSION["id_level"]){
                case 2 :
                    $whr = " AND web_skpd = 1 ";
                    break;
                case 9 :
                    $whr = " AND web_umum = 1 ";
                    break;
            }
            $res = mysql_query("SELECT
                                	id_file, judul, kategori, nama_file, keterangan
                                FROM
                                	nl_file_download
                                WHERE
                                	tipe_fd = '" . $_GET["id"] . "' " . $whr . "
                                ORDER BY
                                    judul ASC");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["judul"]); ?></td>
                <td><?php echo($ds["kategori"]); ?></td>
                <td><?php echo($ds["nama_file"]); ?></td>
                <td><?php echo($ds["keterangan"]); ?></td>
                <td>
                    <img src='image/Upload-48.png' width='18px' class='linkimage' title='Download File' onclick='download(<?php echo($ds["id_file"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>
</div>