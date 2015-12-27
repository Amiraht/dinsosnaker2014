<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    require_once("php/model/usulan_pg_model.php");
    
    $pangkat = array();
    $sql_pangkat = "SELECT * FROM ref_pangkat";
    $res_pangkat = mysql_query($sql_pangkat);
    while($ds_pangkat = mysql_fetch_array($res_pangkat)){
        $row_pangkat["id_pangkat"] = $ds_pangkat["id_pangkat"];
        $row_pangkat["gol_ruang"] = $ds_pangkat["gol_ruang"];
        $row_pangkat["pangkat"] = $ds_pangkat["pangkat"];
        array_push($pangkat, $row_pangkat);
    }
    echo("var pangkat = " . json_encode($pangkat) . ";\n");
    
    $obj = new UsulanPG_Model();
    $obj->Record($_GET["id_usulan"]);
    $record["id_usulan"] = $obj->id_usulan;
    $record["no_usulan"] = $obj->no_usulan;
    $record["tgl_usulan"] = $obj->tgl_usulan;
    $record["jabatan_ttd_usulan"] = $obj->jabatan_ttd_usulan;
    $record["nama_ttd_usulan"] = $obj->nama_ttd_usulan;
    $record["nip_ttd_usulan"] = $obj->nip_ttd_usulan;
    $record["id_pangkat_ttd_usulan"] = $obj->id_pangkat_ttd_usulan;
    echo("var record = " . json_encode($record) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_usulan");
        preload();
    });
    
    function preload(){
        $("#id_usulan").val(record.id_usulan);
        $("#no_usulan").val(record.no_usulan);
        $("#tgl_usulan").val(record.tgl_usulan);
        $("#jabatan_ttd_usulan").val(record.jabatan_ttd_usulan);
        $("#nama_ttd_usulan").val(record.nama_ttd_usulan);
        $("#nip_ttd_usulan").val(record.nip_ttd_usulan);
        $("#id_pangkat_ttd_usulan").val(record.id_pangkat_ttd_usulan);
    }
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=pg_daftar_usulan";
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data usulan pencantuman gelar telah disimpan", "PERHATIAN", function(r){
            document.location.href="?mod=pg_daftar_usulan";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/pg/pg_daftar_usulan_edit.php" method="post" target="sbm_target">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">EDIT SURAT USULAN PENCANTUMAN GELAR</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. Surat Usulan :</label>
                    <input type="text" name="no_usulan" id="no_usulan" class="form-control" />
                    <input type="hidden" name="id_usulan" id="id_usulan" class="form-control" />
                </td>
                <td>
                    <label>Tgl. Surat Usulan :</label>
                    <input type="text" name="tgl_usulan" id="tgl_usulan" class="form-control" />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Nama Pejabat Penandatangan :</label>
                    <input type="text" name="nama_ttd_usulan" id="nama_ttd_usulan" class="form-control" />
                </td>
                <td>
                    <label>NIP Pejabat Penandatangan :</label>
                    <input type="text" name="nip_ttd_usulan" id="nip_ttd_usulan" class="form-control" />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Jabatan Pejabat Penandatangan :</label>
                    <input type="text" name="jabatan_ttd_usulan" id="jabatan_ttd_usulan" class="form-control" />
                </td>
                <td>
                    <label>Pangkat Pejabat Penandatangan :</label>
                    <select name="id_pangkat_ttd_usulan" id="id_pangkat_ttd_usulan" class="form-control">
                        <option value="0">----- Pilih Pangkat -----</option>
                        <script type="text/javascript">
                        $.each(pangkat, function(i, item){
                            document.write("<option value='" + item.id_pangkat + "'>" + item.pangkat + " (" + item.gol_ruang + ")</option>");
                        });
                        </script>
                    </select>
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='left'>
                    <button type="button" class="btn btn-lg btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Simpan</button>
                    <button type="button" class="btn btn-lg btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>