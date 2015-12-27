<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    
    // DATA : ref_pangkat
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
    
    // DATA : usulan_satya_lancana_detail
    $ugbd = array();
    $sql_ugbd = "SELECT
                    	a.*, b.id_pangkat
                    FROM
                    	tbl_usulan_satya_lancana_detail a
                    	LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai
                    WHERE
                    	id_detail_satya_lencana='" . $_GET["id_detail_satya_lancana"] . "'";
    $res_ugbd = mysql_query($sql_ugbd);
    $ds_ugbd = mysql_fetch_array($res_ugbd);
    $ugbd["id_detail_satya_lancana"] = $ds_ugbd["id_detail_satya_lencana"];
    $ugbd["id_usulan"] = $ds_ugbd["id_usulan"];
    $ugbd["id_sk"] = $ds_ugbd["id_sk"];
    $ugbd["id_pegawai"] = $ds_ugbd["id_pegawai"];
    $ugbd["status"] = $ds_ugbd["status"];
    $ugbd["jenis_satya"] = $ds_ugbd["jenis_satya"];
    $ugbd["id_pangkat"] = $ds_ugbd["id_pangkat"];
    $ugbd["pangkat"] = apa_pangkat($ds_ugbd["id_pangkat"]);
    echo("var ugbd = " . json_encode($ugbd) . ";\n");
    
    // DATA : sk_satya_lancana
    require_once("php/model/sk_satya_lancana_model.php");
    $obj = new SKSatyaLancana_Model();
    $obj->Record($ugbd["id_sk"]);
    $sk["id_sk"] = $obj->id_usulan;
    $sk["no_sk"] = $obj->no_usulan;
    $sk["tgl_sk"] = $obj->tgl_usulan;
    $sk["jabatan_ttd_sk"] = $obj->jabatan_ttd_usulan;
    $sk["nama_ttd_sk"] = $obj->nama_ttd_usulan;
    $sk["nip_ttd_sk"] = $obj->nip_ttd_usulan;
    $sk["id_pangkat_ttd_sk"] = $obj->id_pangkat_ttd_usulan;
    echo("var sk = " . json_encode($sk) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tmt");
        ambil_tanggal("tgl_sk");
        ambil_tanggal("tgl_piagam");
        preload();
    });
    
    function preload(){
        $("#id_sk").val(sk.id_sk);
        $("#no_sk").val(sk.no_sk);
        $("#tgl_sk").val(sk.tgl_sk);
        $("#jabatan_pejabat_ttd_sk").val(sk.jabatan_ttd_sk);
        $("#nama_pejabat_ttd_sk").val(sk.nama_ttd_sk);
        $("#nip_pejabat_ttd_sk").val(sk.nip_ttd_sk);
        $("#id_pangkat_pejabat_ttd_sk").val(sk.id_pangkat_ttd_sk);
        $("#id_pegawai").val(ugbd.id_pegawai);
        $("#id_detail_satya_lancana").val(ugbd.id_detail_satya_lancana);
        $("#jenis_satya").val(ugbd.jenis_satya);
    }
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=sl_daftar_sk_diproses&id_usulan=" + ugbd.id_sk;
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data satya lancana pegawai telah disimpan", "PERHATIAN", function(r){
            kembali();
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/satya_lancana/sl_daftar_sk_diproses_lanjut.php" method="post" target="sbm_target">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">SIMPAN DATA SATYA LANCANA PEGAWAI</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <label>Jenis Satya :</label>
                <select name="jenis_satya" id="jenis_satya" class="form-control">
                    <option value="">----- Pilih Jenis Satya -----</option>
                    <option value="x">X</option>
                    <option value="xx">XX</option>
                    <option value="xxx">XXX</option>
                </select>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. SK :</label>
                    <input type="text" name="no_sk" id="no_sk" class="form-control" />
                    <input type="hidden" name="id_pegawai" id="id_pegawai" class="form-control" />
                    <input type="hidden" name="id_detail_satya_lancana" id="id_detail_satya_lancana" class="form-control" />
                </td>
                <td>
                    <label>Tgl. SK :</label>
                    <input type="text" name="tgl_sk" id="tgl_sk" class="form-control" />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Nama Pejabat Penandatangan :</label>
                    <input type="text" name="nama_pejabat_ttd_sk" id="nama_pejabat_ttd_sk" class="form-control" />
                </td>
                <td>
                    <label>NIP Pejabat Penandatangan :</label>
                    <input type="text" name="nip_pejabat_ttd_sk" id="nip_pejabat_ttd_sk" class="form-control" />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Jabatan Pejabat Penandatangan :</label>
                    <input type="text" name="jabatan_pejabat_ttd_sk" id="jabatan_pejabat_ttd_sk" class="form-control" />
                </td>
                <td>
                    <label>Pangkat Pejabat Penandatangan :</label>
                    <select name="id_pangkat_pejabat_ttd_sk" id="id_pangkat_pejabat_ttd_sk" class="form-control">
                        <option value="0">----- Pilih Pangkat -----</option>
                        <script type="text/javascript">
                        $.each(pangkat, function(i, item){
                            document.write("<option value='" + item.id_pangkat + "'>" + item.pangkat + " (" + item.gol_ruang + ")</option>");
                        });
                        </script>
                    </select>
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>NO. Piagam :</label>
                    <input type="text" name="no_piagam" id="no_piagam" class="form-control" />
                </td>
                <td>
                    <label>Tgl. Piagam :</label>
                    <input type="text" name="tgl_piagam" id="tgl_piagam" class="form-control" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Nama Presiden Penandatangan Piagam</label>
                    <input type="text" name="nama_presiden" id="nama_presiden" class="form-control" />
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='left'>
                    <button type="button" class="btn btn-lg btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Tambah</button>
                    <button type="button" class="btn btn-lg btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>