<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $daftar = array();
    $sql_daftar = "SELECT
                    	a.id_pegawai, a.nama_pegawai, a.nip, a.gelar_depan, a.gelar_belakang,
                    	b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
                    	e.jenis_kelamin, a.alamat, a.tanggal_lahir, f.skpd, g.pangkat, g.gol_ruang, h.jabatan,
                   		i.id_detail_satya_lencana, i.jenis_satya, j.no_usulan, j.tgl_usulan
                    FROM
                    	tbl_pegawai a
                    	LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
                    	LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
                    	LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
                    	LEFT JOIN ref_jenis_kelamin e ON a.id_jenis_kelamin = e.id_jenis_kelamin
                    	LEFT JOIN ref_skpd f ON a.id_satuan_organisasi = f.id_skpd
                    	LEFT JOIN ref_pangkat g ON a.id_pangkat = g.id_pangkat
                    	LEFT JOIN ref_jabatan h ON a.id_jabatan = h.id_jabatan
                    	INNER JOIN tbl_usulan_satya_lancana_detail i ON (a.id_pegawai = i.id_pegawai AND i.status = 1)
                    	INNER JOIN tbl_usulan_satya_lancana j ON (i.id_usulan = j.id_usulan AND j.status = 2 )	
                    ORDER BY
                    	i.id_detail_satya_lencana, j.id_usulan DESC";
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["id_detail_satya_lencana"] = $ds_daftar["id_detail_satya_lencana"];
        $row_daftar["nama_pegawai"] = $ds_daftar["nama_pegawai"];
        $row_daftar["nip"] = $ds_daftar["nip"];
        $row_daftar["pangkat"] = $ds_daftar["pangkat"];
        $row_daftar["gol_ruang"] = $ds_daftar["gol_ruang"];
        $row_daftar["jabatan"] = $ds_daftar["jabatan"];
        $row_daftar["skpd"] = $ds_daftar["skpd"];
        $row_daftar["jenis_satya"] = $ds_daftar["jenis_satya"];
        $row_daftar["no_usulan"] = $ds_daftar["no_usulan"];
        $row_daftar["tgl_usulan"] = $ds_daftar["tgl_usulan"];
        array_push($daftar, $row_daftar);
    }
    echo("var daftar = " . json_encode($daftar) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_usulan");
    });
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=sl_daftar_sk_diusulkan&id_usulan=<?php echo($_GET["id_usulan"]); ?>";
    }
    
    function cekall(){
        $(".chksatya").each(function(){
            if($("#chkall").is(":checked"))
                $(this).prop('checked', true);
            else
                $(this).prop('checked', false);
        });
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Daftar usulan pegawai yang menerima satya lancana telah disimpan", "PERHATIAN", function(r){
            document.location.href="?mod=sl_daftar_sk_diusulkan&id_usulan=<?php echo($_GET["id_usulan"]); ?>";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/satya_lancana/sl_daftar_sk_diusulkan_push.php" method="post" target="sbm_target">
<input type="hidden" name="id_usulan" id="id_usulan" value="<?php echo($_GET["id_usulan"]); ?>" />
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PEGAWAI YANG DIUSULKAN MENDAPATKAN SATYA LANCANA OLEH SKPD MASING-MASING</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtablebackup">
        <thead>
            <tr class="headertable">
                <th width='40px'><input type="checkbox" id="chkall" onclick="cekall();" /></th>
                <th width='40px'>No.</th>
                <th width='150px'>Nomor<br />Usulan</th>
                <th width='200px'>Nama Pegawai</th>
                <th width='150px'>NIP</th>
                <th width='150px'>Pangkat</th>
                <th width='200px'>Jabatan</th>
                <th>SKPD</th>
                <th width='150px'>Jenis<br />Satya</th>
            </tr>
        </thead>
        <tbody>
        <script type="text/javascript">
            $.each(daftar, function(i, item){
                var text = "";
                text += "<tr>";
                    text += "<td style='text-align: center;'><input type='checkbox' class='chksatya' id='chk_" + item.id_detail_satya_lencana + "' name='chk_" + item.id_detail_satya_lencana + "' /></td>";
                    text += "<td style='text-align: center;'>" + (i+1) + "</td>";
                    text += "<td style='text-align: center;'>" + item.no_usulan + "</td>";
                    text += "<td style='text-align: center;'>" + item.nama_pegawai + "</td>";
                    text += "<td style='text-align: center;'>" + item.nip + "</td>";
                    text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
                    text += "<td style='text-align: center;'>" + item.jabatan + "</td>";
                    text += "<td style='text-align: center;'>" + item.skpd + "</td>";
                    text += "<td style='text-align: center;'>" + item.jenis_satya + "</td>";
                text += "</tr>";
                document.write(text);
            });
        </script>
        </tbody>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='left'>
                    <button type="button" class="btn btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;OK</button>
                    <button type="button" class="btn btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>