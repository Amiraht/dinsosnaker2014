<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
	$(document).ready(function(){
		$( "#dialog_cadis" ).dialog({
			autoOpen: false,
			height: 600,
			width: 800,
			modal: true,
			show: "fade",
			hide: "fade"
		});
		
		$( "#catatan" ).dialog({
			autoOpen: false,
			height: 300,
			width: 500,
			modal: true,
			show: "fade",
			hide: "fade"
		});
		
		$("#alert_add_sukses").click(function(){
			$(this).fadeOut('slow');
		});
		
	<?php
		$q = mysql_query("SELECT * FROM tbl_usulan_pmk ORDER BY id_usulan ASC");
		while($d = mysql_fetch_array($q)){
	?>
		$("#btn_view<?=$d['id_usulan'];?>").click(function(){
			var id_usulan = "<?=$d['id_usulan'];?>";
				$("#dialog_usul_pmk").dialog("open");
				$.ajax({
					type: "GET",
					url: "ajax/pmk_daftar_diusulkan.php",
					data: "id_usulan=" + id_usulan,
					success: function(r){
						$("#dialog_usul_pmk").html(r);
					}
				});	
			});
	<?php
			
		}
	?>	
	
		
});
	
    function edit(id_usulan){
        document.location.href = "?mod=pmk_daftar_usulan_edit&id_usulan=" + id_usulan;
    }
    
	 function tambah(id_usulan){
       //jAlert("Tambah "+no_usulan);
	   document.location.href="?mod=usulan_pmk_tambah_pegawai&id_usul="+id_usulan;
    }
	
    function hapus(id_usulan){
        jConfirm("Hapus data usulan dengan ID "+ id_usulan + "?", "KONFIRMASI", function(r){
            if(r){
                document.location.href = "php/pmk/pmk_daftar_usulan_hapus.php?id_usul=" + id_usulan;
            }
        });
    }
    
    function proses_ke_bkd(id_usulan){
        jConfirm("Proses data usulan dengan ID "+ id_usulan +" ke BKD ?", "KONFIRMASI", function(r){
            if(r){
                document.location.href = "php/pmk/pmk_daftar_usulan_proses_bkd.php?id_usul=" + id_usulan;
            }
        });
    }
	
	function lihat_catatan(id_usulan){
		$("#catatan").dialog("open");
			$.ajax({
					type: "GET",
					url: "ajax/catatan_usulan_pmk.php",
					data: "id_usulan=" + id_usulan,
					success: function(r){
						$("#catatan").html(r);
					}
			});	
		
    }
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR SURAT USULAN PENINJAUAN MASA KERJA</h3>
	<?php
		// all the notification act mas bro
	  
		if(isset($_GET['code']) AND isset($_GET['act'])){
			if($_GET['code'] == 1 AND $_GET['act'] == 'proses'){	
				//echo "sukses";
				echo "<div class='alert alert-success' role='alert' id='alert_add_sukses' title='Klik Blok ini untuk menghilangkan blok notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />";
				echo "Data Surat Usulan PMK sudah di proses ke admin <strong>BKD</strong>.</center>";
				echo "</div>";
			}else if($_GET['code'] == 2 AND $_GET['act'] == 'proses'){
				echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses' title='Klik Blok ini untuk menghilangkan blok notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />";
				echo "Data surat usukan PMK gagal di <strong>proses !!</strong>.</center>";
				echo "</div>";
			}else if($_GET['code'] == 1 AND $_GET['act'] == 'add'){
				echo "<div class='alert alert-success' role='alert' id='alert_add_sukses' title='Klik Blok ini untuk menghilangkan blok notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />";
				echo "Input Data Surat Usulan Penyesuaian Masa Kerja <strong>Sukses</strong>.</center>";
				echo "</div>";
			}else if($_GET['code'] == 2 AND $_GET['act'] == 'add'){
				echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses' title='Klik Blok ini untuk menghilangkan blok notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />";
				echo "<strong>Maaf</strong>, Data Surat Usulan Penyesuaian Masa Kerja.</center>";
				echo "</div>";	
			}else if($_GET['code'] == 1 AND $_GET['act'] == 'del'){
				echo "<div class='alert alert-success' role='alert' id='alert_add_sukses' title='Klik Blok ini untuk menghilangkan blok notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />";
				echo "Hapus Data Surat Usulan Penyesuaian Masa Kerja <strong>Sukses</strong>.</center>";
				echo "</div>";
			}else if($_GET['code'] == 2 AND $_GET['act'] == 'del'){
				echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses' title='Klik Blok ini untuk menghilangkan blok notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />";
				echo "<strong>Maaf</strong>, Data Surat Usulan Penyesuaian Masa Kerja gagal dihapus.</center>";
				echo "</div>";
			}
         }
       		 		
	?>
    <div class="bodypanel">
    <button type="button" class="btn btn-success" onclick="document.location.href='?mod=pmk_daftar_usulan_add';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Surat Usulan</button>
    <div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
				<th width='50px'>Status</th>
                <th width='40px'>No.</th>
                <th width='180px' >No.Usulan</th>
                <th width='180px'>Tgl Usulan</th>
                <th width='200px'>Pejabat Pengusul</th>
                <th width='180px'>Nip Pejabat Pengusul</th>
				<th width='200px'>Jabatan Pengusul</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
				<th width='50px'>&nbsp;</th>
				<th width='50px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
		<?php
			$sql = "SELECT * FROM tbl_usulan_pmk ORDER BY id_usulan ASC";
			$query = mysql_query($sql) or die(mysql_error());
			$no = 1;
			while($row = mysql_fetch_array($query)){
				echo "<tr>";
				echo "<td style='text-align: center;'><center>".status_supervisi($row['status_supervisi']) ."</center></td>";
				echo "<td style='text-align: center;'><center>".$no ."</center></td>";
				echo "<td style='text-align: center;'><center>".$row['no_usulan']."</center></td>";
				echo "<td style='text-align: center;'><center>".$row['tgl_usulan'] ."</center></td>";
				echo "<td style='text-align: center;'><center>".$row['pejabat_pengusul'] ."</center></td>";
				echo "<td style='text-align: center;'><center>".$row['nip_pejabat_pengusul'] ."</center></td>";
				echo "<td style='text-align: center;'><center>".$row['jabatan_penandatangan'] ."</center></td>";
				
				if($row['status_supervisi'] == 1){
					echo "<td style='text-align: center;'><button type='button' title='Edit Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='edit(". $row['id_usulan'].");'><span class='glyphicon glyphicon-edit'></span></button></td>";
                    echo "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(". $row['id_usulan'] .");'><span class='glyphicon glyphicon-trash'></span></button></td>";
                    echo "<td style='text-align: center;'><button type='button' title='Tambah Pegawai yang diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='tambah(". $row['id_usulan'] .");'><span class=' glyphicon glyphicon-plus'></span></button></td>";
					echo "<td style='text-align: center;'><button type='button' title='Data Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' id='btn_view". $row['id_usulan'] ."'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
                    echo "<td style='text-align: center;'><button type='button' title='Proses Ke BKD' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses_ke_bkd(". $row['id_usulan'] .");'><span class='glyphicon glyphicon-cog'></span></button></td>";
					if(empty($row['catatan'])){
						echo "<td style='text-align: center;'>&nbsp;</td>";
					}else{
						echo "<td><img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat Catatan Penolakan' onclick='lihat_catatan(".$row['id_usulan'].");'/></td>";
					}
				}else{
					 echo "<td style='text-align: center;'>&nbsp;</td>";
                     echo "<td style='text-align: center;'>&nbsp;</td>";
                     echo "<td style='text-align: center;'>&nbsp;</td>";
                     echo "<td style='text-align: center;'>&nbsp;</td>";
					 echo "<td style='text-align: center;'>&nbsp;</td>";
					 echo "<td style='text-align: center;'>&nbsp;</td>";
				}
				echo "</tr>";
				$no++;
			}
		?>	
       
        </tbody>
    </table><br/>
		<span style="font-size:13px; font-weight:bold;">*) - Keterangan Status pada tabel diatas, jika berwarna <span style="color:yellow;">kuning</span> 
		berarti belum diproses oleh BKD.<br/>  - Jika berwarna <span style="color:green;">hijau</span> berarti sudah di ACC oleh Admin BKD.<br/>  - Dan jika berwarna 
		<span style="color:red;">merah</span> berarti sudah di proses ke BKD, namun belum di ACC (Proses) oleh admin BKD.</span><br/>
    </div>
</div>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="DAFTAR PEGAWAI USULAN PENYESUAIAN MASA KERJA" style="display: none;">
    
</div>
<!-- ------------- -->
<!-- DIALOG JQUERY -->
<div id="catatan" title="Catatan Supervisi" style="display: none;">
   
</div>
<!-- ------------- -->