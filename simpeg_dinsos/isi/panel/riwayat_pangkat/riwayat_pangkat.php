<script type="text/javascript">
$(document).ready(function(){
    $( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: 320,
		width: 650,
		modal: true,
        show: "fade",
		hide: "fade"
    });
	
	$("#upload_sk_kenpang").dialog({
        autoOpen: false,
		height: 300,
		width: 560,
		modal: true,
        show: "fade",
		hide: "fade"
    });
});
function hapus(id_riwayat_pangkat, status_supervisi){
    <?php
        if($_SESSION["simpeg_id_level"] == 12){
    ?>
            jConfirm("Anda yakin ingin menghapus data riwayat pangkat ini?", "PERHATIAN", function(r){
                if(r){
                    document.location.href="php/riwayat_pangkat/riwayat_pangkat_hapus.php?id_riwayat_pangkat=" + id_riwayat_pangkat;
                }
            });
    <?php
        }else {
    ?>
            if(status_supervisi == 3){
                jAlert("Data ini telah di terima (ACC) oleh admin SKPD. Data tidak bisa dihapus kembali", "PERHATIAN");
            }else{
                jConfirm("Anda yakin ingin menghapus data riwayat pangkat ini?", "PERHATIAN", function(r){
                    if(r){
                        document.location.href="php/riwayat_pangkat/riwayat_pangkat_hapus.php?id_riwayat_pangkat=" + id_riwayat_pangkat;
                    }
                });
            }
    <?php
        }
    ?>
    
}
function edit(id_riwayat_pangkat, status_supervisi){
    <?php
        if($_SESSION["simpeg_id_level"] == 12){
    ?>
            document.location.href="?mod=riwayat_pangkat_edit&id_riwayat_pangkat=" + id_riwayat_pangkat;
    <?php
        }else {
    ?>
            if(status_supervisi == 3){
                jAlert("Data ini telah di terima (ACC) oleh admin SKPD. Data tidak bisa diedit kembali", "PERHATIAN");
            }else{
                document.location.href="?mod=riwayat_pangkat_edit&id_riwayat_pangkat=" + id_riwayat_pangkat;
            }
    <?php
        }
    ?>
}
function catatan(id_riwayat_pangkat){
    $("#dialog_cadis").dialog("open");
    $.ajax({
        type: "GET",
        url: "ajax/cadis_spv_riwayat_pangkat.php",
        data: "id_riwayat_pangkat=" + id_riwayat_pangkat,
        success: function(r){
            $("#dialog_cadis").html(r);
        }
    });
}

function upload(){
	$("#upload_sk_kenpang").dialog('open');
}

function lihat_sk(){
	var filename = "<?php echo $_SESSION['simpeg_id_level'] . ".pdf"; ?>";
	window.open('sys_files/scan_sk_kenpang/' + filename);
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DATA RIWAYAT KEPANGKATAN <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
	<button type="button" class="btn btn-success" title="Tambahkan Data Riwayat Pangkat" onclick="document.location.href='?mod=riwayat_pangkat_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Data Riwayat Pangkat</button>
     
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='5px'>&nbsp;</th>
                <th width='40px'>No.</th>
                <th width='200px'>Pangkat</th>
                <th width='100px'>Gol. Ruang</th>
                <th width='200px'>TMT</th>
                <th width='200px'>No. SK</th>
                <th width='200px'>Tanggal SK</th>
                <th>Pejabat Penetapan</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.*, b.pangkat, b.gol_ruang, MD5(a.id_data) AS id_hash
                                FROM
                                	tbl_riwayat_pangkat a
                                	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                                WHERE
                                	a.id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'
                                ORDER BY
                                	a.tmt ASC") or die(mysql_error());
            $no = 0;
			
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . status_supervisi($ds["status"]) . "</td>");
                    echo("<td align='center'>" . $no . "</td>");
                    echo("<td align='center'>" . $ds["pangkat"] . "</td>");
                    echo("<td align='center'>" . $ds["gol_ruang"] . "</td>");
                    echo("<td align='center'>" . tglindonesia($ds["tmt"]) . "</td>");
                    echo("<td align='center'>" . $ds["no_sk"] . "</td>");
                    echo("<td align='center'>" . tglindonesia($ds["tgl_sk"]) . "</td>");
                    echo("<td align='center'>" . $ds["pejabat_penetapan"] . "</td>");
                    echo("<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='edit(\"" . $ds["id_hash"] . "\", " . $ds["status"] . ");' />
                        </td>");
                    echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus' onclick='hapus(" . $ds["id_data"] . ", " . $ds["status"] . ");' />
                        </td>");
                    if($ds["status"] == 2){
                        echo("<td>
                            <img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Catatan supervisi' onclick='catatan(" . $ds["id_data"] . ");' />
                        </td>");
                    }else if($ds["status"] == 3){
						$dir = "sys_files/scan_sk_kenpang/" . $_SESSION['simpeg_id_level'] . ".pdf";
						if(!file_exists($dir)){
							echo("<td>
								<img src='image/Upload-48.png' width='18px' class='linkimage' title='Upload Scan SK Pegawai (File Berupa PDF)' onclick='upload(".$ds['id_data'].");' />
							</td>");
						}else{
							echo("<td>
								<img src='image/pdf.png' width='18px' class='linkimage' title='Lihat File SK Anda (File Sebelumnya Sudah Pernah Anda Download)' onclick='lihat_sk();' />
							</td>");
						}		
					}else{
                        echo("<td>&nbsp;</td>");
                    }
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Revisi / Perbaikan Data Riwayat Pangkat" style="display: none;">
    
</div>
<!-- ------------- -->

<!-- DIALOG JQUERY -->
<div id="upload_sk_kenpang" title="UPLOAD SCAN SK KENAIKAN PANGKAT" style="display: none;">
<form id="frm_upload_scan_kenpang" action="php/upload_scan_sk_kenpang_pegawai.php" method="POST" enctype="multipart/form-data">
<input type="hidden" id="id_textbox" />
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='10%'>
                   <label>Upload File Scan SK Kenaikan Pangkat </label>
				   <input type="file" name="file_sc" id="file_sc" class="form-control" />
                </td>
            </tr>
			<tr>
				<td><span style="color:red;">File yang di upload harus berekstensi .pdf</span></td>
			<tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='UPLOAD' class="btn btn-success" style="height: 30px; width: 100px;"  /></td>
            </tr>
        </table>
    </div>
</div>
</form>
</div>
<!-- ------------- -->
