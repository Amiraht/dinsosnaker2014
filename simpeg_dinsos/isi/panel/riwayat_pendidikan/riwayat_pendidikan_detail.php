<script type="text/javascript">
 $(document).ready(function(){
       // ambil_tanggal("tgl_usulan");
		$("#cadis").dialog({
			autoOpen: false,
			height: 350,
			width: 600,
			modal: true,
			show: "fade",
			hide: "fade"
		});
    });
	
function hapus(id_riwayat_pend, status_supervisi){
    <?php
        if($_SESSION["simpeg_id_level"] == 12){
    ?>
            jConfirm("Hapus data riwayat pendidikan dengan ID "+ id_riwayat_pend + " ?", "KONFIRMASI", function(r){
                if(r){
                    document.location.href="php/riwayat_pendidikan/riwayat_pendidikan_hapus.php?id=" + id_riwayat_pend;
                }
            });
    <?php
        }else{
    ?>
            if(status_supervisi == 3){
                jAlert("Data ini telah di terima (ACC) oleh admin SKPD. Data tidak bisa dihapus kembali", "PERHATIAN");
            }else{
                jConfirm("Hapus data riwayat pendidikan dengan ID "+ id_riwayat_pend +" ?", "KONFIRMASI", function(r){
                    if(r){
                        document.location.href="php/riwayat_pendidikan/riwayat_pendidikan_hapus.php?id=" + id_riwayat_pend;
                    }
                });
            }
    <?php
        }
    ?>
}
function edit(id_riwayat_pend, status_supervisi){
    <?php
        if($_SESSION["simpeg_id_level"] == 12){
    ?>
            document.location.href="?mod=riwayat_pendidikan_edit&id=" + id_riwayat_pend;
    <?php
        }else{
    ?>
            if(status_supervisi == 3){
                jAlert("Data ini telah di terima (ACC) oleh admin SKPD. Data tidak bisa diedit kembali", "PERHATIAN");
            }else{
                document.location.href="?mod=riwayat_pendidikan_edit&id=" + id_riwayat_pend;
            }
    <?php
        }
    ?>
}

function lihat_pendidikan(id){
		//jAlert(id, "TEST");
		$("#dialog_detail_pendidikan").dialog("open");
		$.ajax({
			type: "GET",
			url: "ajax/spv_riwayat_pendidikan.php",
			data: "id_data=" + id,
			success: function(r){
				$("#dialog_detail_pendidikan").html(r);
			}
		});	
}

function proses_bkd(id_data){
	jConfirm("Proses Supervisi Data Ke BKD ? ", "KONFIRMASI", function(r){
                if(r){
                    document.location.href="php/riwayat_pendidikan/proses_rp.php?id=" + id_data;
                }
      });
}

 function catatan(id_data){
		$("#cadis").dialog("open");
			$.ajax({
					type: "GET",
					url: "ajax/catatan_supervisi_riwayat_pendidikan.php",
					data: "id=" + id_data,
					success: function(dt){
						$("#cadis").html(dt);
					}
			});	
		
    }
	
	function upload(id_data){
		 document.location.href="?mod=upload_ijazah_pendidikan&id="+id_data;
	}
</script>
<div class="panelcontainer" style="width: 100%;">
<?php
	$s = mysql_query("SELECT nama_pegawai, nip FROM tbl_pegawai WHERE nip = '". $_SESSION["nip"] ."' ") or die(mysql_error());
	$rs = mysql_fetch_array($s);
	
	$nip = (isset($_SESSION["nip"])) ? $_SESSION["nip"] : "";
?>
    <h3 style="text-align: left;">RIWAYAT PENDIDIKAN PEGAWAI : <?=$rs['nama_pegawai']." ( ".$rs['nip']." )";?></h3>
    <div class="bodypanel">
	<button type="button" class="btn btn-success" onclick="document.location.href='?mod=riwayat_pendidikan_add';"><span class='glyphicon glyphicon-plus'></span>
		&nbsp;&nbsp;Tambah Data Riwayat Pendidikan</button>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='100px'>NIP</th>
                <th width='200px'>Nama Pegawai</th>
				<th width='100px'>Tingkat Pendidikan</th>
				<th width='100px'>Tempat Pendidikan</th>
				<th width='100px'>Nilai/Index</th>
				<th width='100px'>No.Ijazah</th>
				<th width='100px'>Tgl.Ijazah</th>
                <th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT
                                	a.id_data_rp as 'id_data', a.nip, b.nama_pegawai, c.tingkat_pendidikan , a.tempat_pendidikan, 
                                	a.nilai, a.no_ijazah, a.tgl_ijazah, a.supervisi, a.catatan 
                                FROM
                                	tbl_riwayat_pendidikan a
                                	LEFT JOIN tbl_pegawai b ON a.nip = b.nip
									LEFT JOIN ref_tingkat_pendidikan c ON a.id_tingkat_pendidikan = c.id_tingkat_pendidikan
								WHERE
									a.nip IN
									(SELECT DISTINCT nip FROM tbl_pegawai ORDER BY nip ASC) AND 
									a.nip = '" . $nip ."'
                                ORDER BY
                                	a.nip ASC") or die(mysql_error());
									
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . $no . "</td>");
                    echo("<td align='center'>" . $ds["nip"] . "</td>");
                    echo("<td align='center'>" . $ds["nama_pegawai"] . "</td>");
					echo("<td align='center'>" . $ds["tingkat_pendidikan"] . "</td>");
					echo("<td align='center'>" . $ds["tempat_pendidikan"] . "</td>");
					echo("<td align='center'>" . ($ds["nilai"] == "" ? "-" : $ds["nilai"]) . "</td>");
                    echo("<td align='center'>" . ($ds["no_ijazah"] == "" ? "-" : $ds["no_ijazah"]) . "</td>");
					echo("<td align='center'>" . ($ds["tgl_ijazah"] == "0000-00-00" ? "-" : $ds["tgl_ijazah"]) . "</td>");
				
			if($ds["supervisi"] == 1){			
					echo("<td>
                       <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data' onclick='hapus(\"" . $ds["id_data"] . "\", " . $ds["supervisi"] . ");' />
                   </td>");
                    echo("<td>
                            <img src='image/Application-View-Detail-32.png' width='18px' class='linkimage' title='Lihat Detail Pendidikan' onclick='lihat_pendidikan(\"" .$ds["id_data"]. "\");' />
                        </td>");
					 echo("<td>
                            <img src='image/Upload-48.png' width='18px' class='linkimage' title='Upload File Ijazah Pedidikan' onclick='upload(\"" .$ds["id_data"]. "\");' />
                        </td>");
						
                   if($ds["supervisi"] == 1 && $ds["catatan"] == ""){
						echo "<td style='text-align: center;'><button type='button' title='Proses KE BKD' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses_bkd(".$ds["id_data"].");'>Proses&nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
				   }else if($ds["supervisi"] == 1 && $ds["catatan"] != ""){
						echo "<td>
                            <img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Catatan supervisi' onclick='catatan(" . $ds["id_data"] . ");' />
                        </td>";
				   }
			  }else{
					echo "<td>&nbsp;</td>";
					echo "<td>&nbsp;</td>";
					echo "<td>&nbsp;</td>";
					echo "<td>&nbsp;</td>";
			  }	
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<!-- ------------- -->
<div id="cadis" title="LIHAT CATATAN SUPERVISI PEGAWAI" style="display: none;">
</div>