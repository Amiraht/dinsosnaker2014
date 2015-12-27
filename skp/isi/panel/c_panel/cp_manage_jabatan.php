<script type="text/javascript">
$(document).ready(function(){
	$("#edit_jabatan").dialog({
            autoOpen: false,
    		height: "400",
    		width: "800",
    		modal: true,
            show: "fade",
    		hide: "fade"
      });
	  
	  $("#add_jabatan").dialog({
            autoOpen: false,
    		height: "500",
    		width: "800",
    		modal: true,
            show: "fade",
    		hide: "fade"
      });
	
    $("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
    
	
	$("#alert_add").click(function(){
			$(this).fadeOut('slow');
		});
		
	$("#id_skpd").change(function(){
		var str = $(this).val();
		var pecah = str.split('-'); 
		var id_skpd = pecah[1];
		var kode_skpd = pecah[0];
		$("#kode_skpd").val(kode_skpd);
	});	
});

function hapus(id){
    jConfirm("Anda yakin akan menghapus data jabatan ini?", "KONFIRMASI", function(r){
        if(r){
            document.location.href = "php/c_panel/cp_hapus_jabatan.php?id=" + id;
		}	
    });
}

function editdata(id){
    $("#edit_jabatan").dialog("open");
	$("#sh_jab").html("Memuat Form, harap tunggu sebentar.....");
	$("#sh_jab").load("ajax/get_frm_edit_jabatan.php?id="+id);
}

function add_jabatan(){
	$("#add_jabatan").dialog("open");
	$("#sh_add_jab").html("Memuat Form, harap tunggu sebentar.....");
	$("#sh_add_jab").load("ajax/get_frm_add_jabatan.php");
}


</script>
<form name="frm" action="?mod=<?php echo $mod = (isset($_GET["mod"])) ? $_GET["mod"] : ""; ?>" method="POST">
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
				echo "Data Jabatan Berhasil Di Edit.</center>";
				echo "</div>";
			}else if($_GET['msg'] == 4){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data Jabatan Berhasil Di Hapus.</center>";
				echo "</div>";
			}
		}
	?>
	
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='100%'>
                    <input type="text" name="jabatan" placeholder=":: Cari Berdasarkan Nama Jabatan ::" title="jabatan" />
                </td>
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
			<td>
                    <input type="text" name="kode_jabatan" placeholder=":: Cari Berdasarkan Kode Jabatan ::" title="Kode Jabatan" />
            </td>
		</table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <td>
                    <input type="text" name="kode_skpd" placeholder=":: Cari Berdasarkan Kode SKPD ::" title="Kode SKPD" />
                </td>
		</table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
				<td>
                    <input type="text" name="skpd" placeholder=":: Cari Berdasarkan Nama Unit / SKPD ::" title="Unit Kerja / SKPD" />
                </td>
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
        <input type="button" value="TAMBAH JABATAN" onclick="add_jabatan();" style="height:45px; width:160px;" class="btn btn-success" />&nbsp;&nbsp;
		<input type="button" value="KEMBALI" onclick="document.location.href='?mod=c_panel';" style="height:45px; width:160px;" class="btn btn-info" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='150'>Nama Jabatan</th>
            <th width='100'>Kode Jabatan</th>
            <th width='180'>Unit Kerja / SKPD</th>
			<th width='180'>Kode SKPD</th>
			<th width='100'>Eselon</th>
            <th width='25px'>&nbsp;</th>
            <th width='25px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
		if(isset($_POST['jabatan']) || isset($_POST['kode_jabatan']) || isset($_POST['kode_skpd']) || isset($_POST['skpd'])){
				$whr = "";
				
				if(isset($_POST['jabatan'])){
					$whr .= " a.jabatan LIKE '%".$_POST['jabatan']."%' ";
				}else if(isset($_POST['kode_jabatan'])){
					$whr .= " a.kode_jabatan LIKE '%".$_POST['kode_jabatan']."%' ";
				}else if(isset($_POST['kode_skpd'])){
					$whr .= " b.kode_skpd LIKE '%".$_POST['kode_skpd']."%' ";
				}else if(isset($_POST['skpd'])){
					$whr .= " b.skpd LIKE '%".$_POST['skpd']."%' ";
				}
			
				$res = mysql_query("SELECT 
										a.*, b.skpd, b.kode_skpd, c.eselon 
										FROM ref_jabatan a 
										LEFT JOIN 
											ref_skpd b ON b.id_skpd =  a.id_skpd 
										LEFT JOIN ref_eselon c ON c.id_eselon = a.id_eselon 
										WHERE  
										".$whr."") or die(mysql_error());
            
				$ctr = 0;
				while($ds = mysql_fetch_array($res)){
					$ctr++;
				
        ?>
				<tr>
					<td align='center'><?php echo($ctr); ?></td>
					<td><?php echo($ds["jabatan"]); ?></td>
					<td><?php echo($ds["kode_jabatan"]); ?></td>
					<td><?php echo $ds["skpd"]; ?></td>
					<td><?php echo $ds["kode_skpd"]; ?></td>
					<td><?php echo $ds["eselon"]; ?></td>
					<td align='center'>
						<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='editdata(<?php echo($ds["id_jabatan"]); ?>);' />
					</td>
					<td>
						<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data' onclick='hapus(<?php echo($ds["id_jabatan"]); ?>);' />
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

<!-- DIALOG JQUERY ---------------------------------------------------------------------------------------------- -->
<div id="edit_jabatan" title="EDIT DATA JABATAN" style="display: none;">
<div id="sh_jab"></div>
<div class="kelang"></div>
</div>

<!-- DIALOG JQUERY ---------------------------------------------------------------------------------------------- -->
<div id="add_jabatan" title="TAMBAH DATA JABATAN" style="display: none;">
<div id="sh_add_jab"></div>
<div class="kelang"></div>
</div>
