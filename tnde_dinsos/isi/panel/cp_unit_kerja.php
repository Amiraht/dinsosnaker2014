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
function tambah(){
    jPrompt("Unit Kerja / SKPD", "", "TAMBAH UNIT KERJA / SKPD", function(r){
        if(r){
            document.location.href="php/cp_tambah_unit_kerja.php?uk=" + r;
        }
    });
}
function hapus(id){
    jConfirm("Anda yakin akan menghapus unit kerja ini?", "PERHATIAN", function(r){
        if(r)
            document.location.href = "php/cp_hapus_unit_kerja.php?id=" + id;
    });
}
function edit(id, uk){
    jPrompt("Unit Kerja / SKPD", uk, "TAMBAH UNIT KERJA / SKPD", function(r){
        if(r){
            document.location.href="php/cp_tambah_unit_kerja.php?id=" + id + "&uk=" + r;
        }
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR UNIT KERJA</h3>
    <div class="bodypanel">
        <input type="button" value="Tambah Unit Kerja" onclick="tambah();" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th>Unit Kerja</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $whr = "";
            $res = mysql_query("SELECT * FROM myapp_reftable_unitkerja WHERE 1 " . $whr . " ORDER BY unit_kerja ASC");
            
            
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["unit_kerja"]); ?></td>
                <td>
                    <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit Unit Kerja' onclick='edit(<?php echo($ds["id_unit_kerja"]); ?>, "<?php echo($ds["unit_kerja"]); ?>");' />
                </td>
                <td>
                    <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Unit Kerja' onclick='hapus(<?php echo($ds["id_unit_kerja"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        </table>
    </div>
</div>