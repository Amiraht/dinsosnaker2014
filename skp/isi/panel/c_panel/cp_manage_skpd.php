<script type="text/javascript">
$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
    
	
	$("#alert_add").click(function(){
			$(this).fadeOut('slow');
		});
});

function hapus(id){
    jConfirm("Anda yakin akan menghapus data skpd ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href = "php/c_panel/cp_hapus_skpd.php?id=" + id;
		}	
    });
}

function editdata(id){
    document.location.href = "?mod=edit_data_skpd&id=" + id;
}
</script>
<form name="frm" action="?mod=<?php echo $mod = (isset($_GET["mod"])) ? $_GET["mod"] : ""; ?>" method="post">
<div class="panelcontainer" style="width: 100%;">
    <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
	<br/>
	<?php
		if(isset($_GET['msg'])){
			if($_GET['msg'] ==  1){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data SKPD Berhasil Ditambahkan .</center>";
				echo "</div>";
			}else if($_GET['msg'] == 2){
				echo "<div class='alert alert-danger' role='alert' id='alert_add'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Maaf, Proses error, terjadi kesalahan proses.</center>";
				echo "</div>";
			}else if($_GET['msg'] == 3){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data SKPD Berhasil Dihapus.</center>";
				echo "</div>";
			}
		}
	?>
	
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <input type="text" name="skpd" placeholder="Cari Nama Unit Kerja / SKPD" title="Nama SKPD" value="<?php 
					$skpd = (isset($_POST["skpd"]) ? $_POST["skpd"] : "");
					echo  $skpd;
					?>" />
                </td>
                <td>
                    <input type="text" name="kode" placeholder="Cari Berdasarkan Kode SKPD " title="Kode SKPD" value="<?php 
					$kode = (isset($_POST["kode"]) ? $_POST["kode"] : ""); 
					echo $kode;
					
					?>" />
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='Filter' style="width: 100%;" class="btn btn-success"/></td>
                <td width='50%'><input type="reset" value='Reset' style="width: 100%;" class="btn btn-info"/></td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div><div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR DATA SKPD</h3>
    <div class="bodypanel">
        <input type="button" value="TAMBAH SKPD" onclick="document.location.href='?mod=cp_tambah_skpd';" style="height:45px; width:160px;" class="btn btn-success" />&nbsp;&nbsp;
		<input type="button" value="KEMBALI" onclick="document.location.href='?mod=c_panel';" style="height:45px; width:160px;" class="btn btn-info" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='250'>Unit Kerja / SKPD</th>
            <th width='100'>Kode SKPD</th>
            <th width='180'>Nama Instansi</th>
			<th width='180'>Alamat SKPD</th>
            <th width='25px'>&nbsp;</th>
            <th width='25px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
		if(isset($_POST['skpd']) || isset($_POST['kode'])){
				$whr = "";
				
				if(isset($_POST['skpd'])){
					$whr = " WHERE a.skpd LIKE '%".$_POST['skpd']."%' ";
				}else if(isset($_POST['kode'])){
					$whr = " WHERE a.kode_skpd LIKE '%".$_POST['kode']."%' ";
				}
			
				$res = mysql_query("SELECT 
										a.*, b.instansi  
										FROM ref_skpd a
										LEFT JOIN 
											ref_instansi b ON  b.id_instansi = a.id_instansi  
										".$whr."") or die(mysql_error());
            
				$ctr = 0;
				while($ds = mysql_fetch_array($res)){
					$ctr++;
				
        ?>
				<tr>
					<td align='center'><?php echo($ctr); ?></td>
					<td><?php echo($ds["skpd"]); ?></td>
					<td><?php echo($ds["kode_skpd"]); ?></td>
					<td><?php echo $ds["instansi"]; ?></td>
					<td><?php echo $ds["alamat_skpd"]; ?></td>
					<td align='center'>
						<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='editdata(<?php echo($ds["id_skpd"]); ?>);' />
					</td>
					<td>
						<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data' onclick='hapus(<?php echo($ds["id_skpd"]); ?>);' />
					</td>
				</tr>
        <?php
				}
		}		
        ?>
        </tbody>
        </table>
    </div>
</div>