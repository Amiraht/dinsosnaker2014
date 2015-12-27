<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $daftar = array();
    $sql_daftar = "SELECT 
				a.*, b.nama_pegawai, c.skpd, d.pangkat, d.gol_ruang, e.jabatan  
			FROM
				tbl_detail_usul_pmk a
				LEFT JOIN tbl_pegawai b ON a.nip = b.nip
				LEFT JOIN ref_skpd c ON b.id_satuan_organisasi = c.id_skpd
				LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
				LEFT JOIN ref_jabatan e ON b.id_jabatan = e.id_jabatan
			WHERE
				a.id_usulan = '". $_GET['id_usul'] ."'
			ORDER BY
			    b.nama_pegawai ASC
		   ";
	
    $res_daftar = mysql_query($sql_daftar);
    while($ds_daftar = mysql_fetch_array($res_daftar)){
        $row_daftar["id_data"] = $ds_daftar["nomor"];
		$row_daftar["id_usulan"] = $ds_daftar["id_usulan"];
        $row_daftar["nama_pegawai"] = $ds_daftar["nama_pegawai"];
        $row_daftar["nip"] = $ds_daftar["nip"];
        $row_daftar["pangkat"] = $ds_daftar["pangkat"];
        $row_daftar["gol_ruang"] = $ds_daftar["gol_ruang"];
        $row_daftar["jabatan"] = $ds_daftar["jabatan"];
        $row_daftar["skpd"] = $ds_daftar["skpd"];
		$row_daftar["pengalaman"] = $ds_daftar["pengalaman"];
        array_push($daftar, $row_daftar);
    }
    echo("var daftar = " . json_encode($daftar) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tgl_mulai_sma");
	ambil_tanggal("tgl_selesai_sma");
	ambil_tanggal("tgl_mulai_1");
	ambil_tanggal("tgl_selesai_1");
    ambil_tanggal("tgl_persetujuan");
	
	$("#btn_submit").click(function(){
		var nip = $("#nip").val();
		if(nip == ""){
			jAlert("Maaf, field NIP pegawai masih kosong !!", "PERHATIAN");
			return false;
		}else{
			$("#notifikasi").html("");
			$.post("php/pmk/usulan_pmk_tambah_pegawai.php",
					$("#frm_us").serialize(),
					function(data){
						$("#notifikasi").show();
						$("#notifikasi").html(data);
					}
			);
			return false;
		}	
	});
	
	$('#btn_close').click(function(){
		$('#notifikasi').fadeOut(200);
	});
});
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">
function something_wrong(what_is_wrong){
    jAlert(what_is_wrong, "PERHATIAN");
}
function success(id_usul){
    jAlert("Tambah Pegawai untuk usulan PMK berhasil ditambah", "PERHATIAN", function(r){
        document.location.href="?mod=usulan_pmk_tambah_pegawai&id_usul"+id_usul;
    });
}
function kembali(){
        document.location.href="?mod=pmk_daftar_usulan";
    }

function hapus(id_data, id_usulan){
        jConfirm("Hapus pegawai dengan ID "+ id_data +" dari daftar usulan ?", "KONFIRMASI", function(r){
            if(r){
                document.location.href = "php/pmk/usulan_pegawai_hapus.php?nomor=" + id_data + "&id_usulan=" + id_usulan;
            }
        });
    }    
</script>
<!-- END OF JAVASCRIPT FROM CHILD -->
<?php
	$id_usulan = mysql_real_escape_string($_GET['id_usul']);
	$no_usulan = get_no_usulan_pmk($id_usulan);
?>
<form id="frm_us" action="" method="POST">
<input type="hidden" name="id_usulan" id="id_usulan" value="<?=$id_usulan; ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">TAMBAH PEGAWAI UNTUK DIUSULKAN KE DALAM NO USULAN PMK : <?=$no_usulan;?></h3>
	<div id="notifikasi" style='display:none;'>
	</div><br/><br/>
	<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
	<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='50%'>
            <tr>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search NIP" id="nip" name="nip" />
                        <span class="input-group-btn">
                            <button type="button" class="btn bnt-sm btn-success" onclick="show_auto_search_pegawai('nip');"><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;Search</button>
                        </span>
                    </div>
                </td>
            </tr>
        </table>
		 <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>No. Persetujuan :</label>
                    <input type="text" name="no_persetujuan" id="no_persetujuan" class="form-control" placeholder=":: NO PERSETUJUAN PMK ::" />
                </td>
				<td width='50%'>
                    <label>TGL. Persetujuan :</label>
                    <input type="text" name="tgl_persetujuan" id="tgl_persetujuan" class="form-control" placeholder=":: TANGGAL PERSETUJUAN PMK ::" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='25%'>
                    <label>Tanggal Mulai SMA :</label>
                    <input type="text" name="tgl_mulai_sma" id="tgl_mulai_sma" class="form-control" placeholder=":: INPUT TGL MASUK SMA ::" />
                </td>
                <td width='25%'>
                    <label>Tanggal Selesai SMA :</label>
                    <input type="text" name="tgl_selesai_sma" id="tgl_selesai_sma" class="form-control" placeholder=":: INPUT TGL SELESAI SMA ::"/>
                </td>
                <td width='25%'>
                    <label>Tanggal Mulai S1 :</label>
                    <input type="text" name="tgl_mulai_1" id="tgl_mulai_1" class="form-control" placeholder=":: INPUT TGL MULAI TINGKAT S1 ::" />
                </td>
                <td width='25%'>
                    <label>Tanggal Mulai S1 :</label>
                    <input type="text" name="tgl_selesai_1" id="tgl_selesai_1" class="form-control" placeholder=":: INPUT TGL SELESAI TINGKAT S1 ::" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Pengalaman :</label>
                    <input type="text" name="pengalaman" id="pengalaman" class="form-control" placeholder=":: INPUT PENGALAMAN BEKERJA PEGAWAI ::" />
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='left'>
                    <input type="submit" class="btn btn-success" id="btn_submit" style="width:120px;height:35px;" value="Tambah" />
                    <input type="reset" class="btn btn-warning" style="width:120px;height:35px;" value="Reset" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PEGAWAI YANG DIUSULKAN</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='200px'>Nama Pegawai</th>
                <th width='150px'>NIP</th>
                <th width='150px'>Pangkat</th>
                <th width='200px'>Jabatan</th>
                <th width='200px'>Unit Kerja / SKPD</th>
				<th>Pengalaman</th>
                <th width='50px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <script type="text/javascript">
            $.each(daftar, function(i, item){
                var text = "";
                text += "<tr>";
                    text += "<td style='text-align: center;'>" + (i+1) + "</td>";
                    text += "<td style='text-align: center;'>" + item.nama_pegawai + "</td>";
                    text += "<td style='text-align: center;'>" + item.nip + "</td>";
                    text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
                    text += "<td style='text-align: center;'>" + item.jabatan + "</td>";
                    text += "<td style='text-align: center;'>" + item.skpd + "</td>";
					text += "<td style='text-align: center;'>" + item.pengalaman + "</td>";
                    text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_data + ", "+ item.id_usulan +");'><span class='glyphicon glyphicon-trash'></span></button></td>";
                text += "</tr>";
                document.write(text);
            });
        </script>
        </tbody>
        </table>
    </div>
</div>
<!-- SUBMIT TARGET -->
<iframe src="" name="sbm_target" style="display: none;"></iframe>
<!-- END OF SUBMIT TARGET -->