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
    jConfirm("Anda yakin akan menghapus pengguna ini?", "PERHATIAN", function(r){
        if(r)
            document.location.href = "php/cp_hapus_pengguna.php?id=" + id;
    });
}
function edit(id, uk){
    jConfirm("Anda yakin akan mereset password pengguna ini menjadi 1234?", "PERHATIAN", function(r){
        if(r)
            document.location.href = "php/cp_reset_password_pengguna.php?id=" + id;
    });
}
function editdata(id){
    document.location.href = "?mod=edit_data_pengguna&id=" + id;
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR UNIT KERJA</h3>
    <div class="bodypanel">
        <input type="button" value="Tambah Pengguna" onclick="document.location.href='?mod=daftar_pengguna';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th>Level / Jabatan</th>
            <th width='150'>Username</th>
            <th width='150'>Nama</th>
            <th width='150'>NIP</th>
            <th width='100'>No. Kontak</th>
            <th width='200'>Email</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $whr = "";
            $res = mysql_query("SELECT
                                	a.*, b.level
                                FROM
                                	myapp_maintable_pengguna a
                                	LEFT JOIN myapp_reftable_levelpengguna b ON a.id_level = b.id
                                ORDER BY
                                	b.urutan, b.level");
            
            
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["level"]); ?></td>
                <td><?php echo($ds["username"]); ?></td>
                <td><?php echo($ds["nama"]); ?></td>
                <td><?php echo($ds["nip"]); ?></td>
                <td><?php echo($ds["kontak"]); ?></td>
                <td><?php echo($ds["email"]); ?></td>
                <td align='center'>
                    <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='editdata(<?php echo($ds["id"]); ?>);' />
                </td>
                <td>
                    <img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Reset Password' onclick='edit(<?php echo($ds["id"]); ?>, "<?php echo($ds["unit_kerja"]); ?>");' />
                </td>
                <td>
                    <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Pengguna' onclick='hapus(<?php echo($ds["id"]); ?>);' />
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        </table>
    </div>
</div>