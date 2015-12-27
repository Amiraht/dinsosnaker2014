<script type="text/javascript">
$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
    
    $("#tgl_surat_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    
    $("#tgl_surat_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
</script>
<form name="frm" action="?mod=nl_file_download" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Tanggal Upload</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_dari" id="tgl_surat_dari" class="ufilter" value="<?php echo($_POST["tgl_dari"]); ?>" />
                        S/D
                        <input type="text" name="tgl_sampai" id="tgl_surat_sampai" class="ufilter" value="<?php echo($_POST["tgl_sampai"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Judul</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="judul" value="<?php echo($_POST["judul"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi" value="<?php echo($_POST["deskripsi"]); ?>" /></td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR FILE DOWNLOAD</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>Judul</th>
            <th>Deskripsi</th>
            <th width='100px'>Tgl. Pembuatan</th>
            <th width='200px'>Nama File</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $whr = "";
            if($_POST["tgl_dari"] <> "" AND $_POST["tgl_sampai"] <> "")
                $whr .= " AND tanggal BETWEEN '" . $_POST["tgl_dari"] . "' AND '" . $_POST["tgl_sampai"] . "'";
            if($_POST["judul"] <> "")
                $whr .= " AND judul LIKE '%" . $_POST["judul"] . "%'";
            if($_POST["deskripsi"] <> "")
                $whr .= " AND deskripsi LIKE '%" . $_POST["deskripsi"] . "%'";
            $res = mysql_query("SELECT * FROM myapp_nonlogintable_filedownload WHERE 1 " . $whr);
            
            
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["judul"]); ?></td>
                <td><?php echo($ds["deskripsi"]); ?></td>
                <td align='center'><?php echo($ds["tanggal"]); ?></td>
                <td><?php echo($ds["isi"]); ?></td>
                <td>
                    <img src='image/Upload-48.png' width='18px' class='linkimage' title='Download' onclick='window.open("uploaded/fd/<?php echo($ds["isi"]); ?>");' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        </table>
    </div>
</div>