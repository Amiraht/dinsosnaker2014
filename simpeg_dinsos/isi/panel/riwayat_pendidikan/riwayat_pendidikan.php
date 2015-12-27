<script type="text/javascript">
$(document).ready(function(){
	$("#expand").click(function(){
            $("#bodyfilter").slideToggle(800);
        });		
});
</script>
<script type="text/javascript">
function hapus(id_riwayat_pend, status_supervisi){
    <?php
		if(isset($_SESSION["simpeg_id_level"])){
			$simpeg_id_level = $_SESSION["simpeg_id_level"];
		}
		
        if($simpeg_id_level == 5){
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
        if($simpeg_id_level == 5){
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

function acc(id_data){
	  jConfirm("Proses (ACC) data riwayat pendidikan dengan ID "+ id_data + " ini ?", "KONFIRMASI", function(r){
                if(r){
                    document.location.href="php/riwayat_pendidikan/acc_riwayat_pendidikan.php?id=" + id_data;
                }
      });
  }

</script>
<?php
	/*
		// all the notification act mas bro
		if(isset($_GET['code'])  && isset($_GET['act'])){
			if($_GET['code'] == 1 && $_GET['act'] == 'add'){	
				//echo "sukses";
	?>
			
				<div class="alert alert-success" role="alert">
                    <center><img src="image/icn_alert_success.png" width="18px;" />
					Input Data Riwayat Pendidikan <strong>Sukses</strong>.</center>
				</div>
	<?php
			}else if($_GET['code'] == 2 && $_GET['act'] == 'add'){
	?>		
				<div class="alert alert-warning" role="alert">
                    <center><img src="image/icn_alert_warning.png" width="18px;" />
					<strong>Maaf</strong>, data riwayat pendidikan gagal disimpan.</center>
				</div>
	<?php	
			}else if($_GET['code'] == 1 && $_GET['act'] == 'del'){
	?>		
			<div class="alert alert-success" role="alert">
                    <center><img src="image/icn_alert_success.png" width="18px;" />
					Hapus Data Riwayat Pendidikan <strong>Sukses</strong>.</center>
				</div>
	<?		
			}else if($_GET['code'] == 2 && $_GET['act'] == 'del'){
	?>	
				<div class="alert alert-warning" role="alert">
                    <center><img src="image/icn_alert_warning.png" width="18px;" />
					<strong>Maaf</strong>, data riwayat pendidikan gagal dihapus.</center>
				</div>
	<?	
			}else if($_GET['code'] == 1 && $_GET['act'] == 'edit'){
	?>
				<div class="alert alert-success" role="alert">
                    <center><img src="image/icn_alert_success.png" width="18px;" />
					Edit Data Riwayat Pendidikan <strong>Sukses</strong>.</center>
				</div>
	<?	
			}else if($_GET['code'] == 2 && $_GET['act'] == 'edit'){
	?>		
				<div class="alert alert-warning" role="alert">
                    <center><img src="image/icn_alert_warning.png" width="18px;" />
					<strong>Maaf</strong>, data riwayat pendidikan gagal diupdate.</center>
				</div>
	<?	
			}
		}
		*/
?>	
	
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR DATA RIWAYAT PENDIDIKAN </h3>
    <div class="bodypanel">
        <button type="button" class="btn btn-success" onclick="document.location.href='?mod=riwayat_pendidikan_add';"><span class='glyphicon glyphicon-plus'></span>
		&nbsp;&nbsp;Tambah Data Riwayat Pendidikan</button>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='90px'>NIP</th>
                <th width='200px'>Nama Pegawai</th>
				<th width='100px'>Tingkat Pendidikan</th>
				<th width='100px'>Tempat Pendidikan</th>
				<th width='150px'>Nama Kepala / Pimpinan Tempat Pendidikan </th>
                <th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
			//$where = " b.nama_pegawai LIKE '%" . $nama_pegawai . "%' AND a.nip LIKE '%" . $nip . "%' ";
            $res = mysql_query("SELECT
                                	a.id_data_rp as 'id_data', a.nip, a.tempat_pendidikan, a.k_a_tempat_pendidikan as 'kepala' ,b.nama_pegawai, 
									c.tingkat_pendidikan ,
                                	a.no_ijazah, a.tgl_ijazah, a.supervisi
                                FROM
                                	tbl_riwayat_pendidikan a
                                	LEFT JOIN tbl_pegawai b ON a.nip = b.nip
									LEFT JOIN ref_tingkat_pendidikan c ON a.id_tingkat_pendidikan = c.id_tingkat_pendidikan
								WHERE 	
									a.nip = '".$_SESSION["nip"]."' 
                                ORDER BY
                                	a.id_data_rp ASC") or die(mysql_error());
									
            $no = 0;
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo "<tr>";
                    echo "<td align='center'>" . $no . "</td>";
                    echo "<td align='center'>" . $ds["nip"] . "</td>";
                    echo "<td align='center'>" . $ds["nama_pegawai"] . "</td>";
                    echo "<td align='center'>" . $ds["tingkat_pendidikan"] . "</td>";
					echo "<td align='center'>" . ($ds["tempat_pendidikan"] == "" ? "---------" : $ds["tempat_pendidikan"]) . "</td>";
					 echo "<td align='center'>" . ($ds["kepala"] == "" ? "---------" : $ds["kepala"]) . "</td>";
                    echo "<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='edit(\"" . $ds["id_data"] . "\", " . $ds["supervisi"] . ");' />
                        </td>";
					echo "<td>
                       <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data' onclick='hapus(\"" . $ds["id_data"] . "\", " . $ds["supervisi"] . ");' />
                   </td>";
				
                    if($ds["supervisi"] == 2){
                        echo "<td>
                            <img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Catatan supervisi' onclick='catatan(" . $ds["id_data"] . ");' />
                        </td>";
                    }else if($ds["supervisi"] == 1){
							echo "<td style='text-align: center;'><button type='button' title='ACC' class='btn btn-sm btn-success' style='width: 100%;' onclick='acc(".$ds["id_data"].");'>Proses (ACC)&nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
					}else{
                        echo "<td>&nbsp;</td>";
                    }
				
                echo "</tr>";
            }
        ?>
        </tbody>
        </table>
    </div>
</div>