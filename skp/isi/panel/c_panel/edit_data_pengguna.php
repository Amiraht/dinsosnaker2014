<script type="text/javascript">
	$(document).ready(function(){
		// Dialog untuk memunculkan daftar SKPD 
		 $("#dialog_skpd").dialog({
            autoOpen: false,
    		height: "600",
    		width: "1200",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
		
		$("#frm_skpd").submit(function(){
            var filter = $("#txt_filter").val();
			$("#listing_skpd").html("");
            $.ajax({
                type: "GET",
                url: "ajax/get_list_skpd.php",
                data: "filter=" + filter,
                success: function(r){
                    $("#listing_skpd").html(r);
                }
            });
            return false;
        });
		
		$("#alert_add").click(function(){
			$(this).fadeOut('slow');
		});
		
	});
	
</script>
<script>
	function validasi(){
		var pass = $("#password").val();
		if (pass.length < 8){
			jAlert("Maaf, Password Anda Terlalu lemah (minimal 8 digit)");
			return false;
		}
	}
	
	function pilih_skpd(str){
		$("#id_skpd").val(str);
		$("#dialog_skpd").dialog("close");
	}
	
	function show_skpd(){
		$("#dialog_skpd").dialog("open");
	}
	
	function clear_all(){
		$("#listing_skpd").html("");
		$("#txt_filter").val("");
	}
	
	function cek(){
		var pass = $("#password").val();
		var konfirmasi = $("#konfirmasi").val();
		if(pass != konfirmasi){
			$("#konf_msg").fadeIn('slow');
			$("#konf_msg").html("Maaf, Konfirmasi Password anda Masih Salah !!");
		}else{
			$("#konf_msg").html("");
			$("#konf_msg").fadeOut('slow');	
		}
	}
	
</script>
<center>
<?php
		$id = mysql_real_escape_string($_GET['id']);	
		$query= mysql_query("SELECT * FROM tbl_pengguna WHERE id_user = '".$id."' ") or die(mysql_error());
		$dt = mysql_fetch_array($query);
?>
<div class="panelcontainer panelform" style="width: 90%;">
    <h3 style="text-align: left;">EDIT DATA PENGGUNA (ID USER : <?=$dt['id_user'];?>)</h3>
	
	<?php
		if(isset($_GET['msg'])){
			if($_GET['msg'] == "101"){
				echo "<div class='alert alert-warning' role='alert' id='alert_add'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Maaf, konfirmasi password anda salah..</center>";
				echo "</div>";
			}else if($_GET['msg'] ==  1){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data Pengguna Berhasil Diubah.</center>";
				echo "</div>";
			}else{
				echo "<div class='alert alert-danger' role='alert' id='alert_add'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Maaf, Proses error, terjadi kesalahan dalam pemrosesan.</center>";
				echo "</div>";
			}
		}
	?>
	
    <div class="bodypanel bodyfilter" id="bodyfilter">
	<form method="POST" id="frm_add_pengguna" name="frm_add_pengguna" action="php/c_panel/cp_edit_pengguna.php">
	
        <table border="0px" cellspacing='0' cellpadding='6' width='100%'>
            <tr>
				<td><label>Nama Pegawai :</label>
				<input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder=":: INPUT NAMA PEGAWAI ::" 
				value="<?=$dt['nama'];?>"/>
				<input type="hidden" name="id_user" value="<?=$dt['id_user'];?>"/>
				</td>
            </tr>
        </table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Username :</label>
					<input type="text" class="form-control" name="username" id="username" placeholder=":: INPUT USERNAME (HARUS BERUPA NIM) ::" 
					value="<?=$dt['username'];?>"/>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Akses Level :</label>
					<select name="level" id="level" class="form-control" width='75%'>
						<option value='0' selected='selected'>=========PILIH LEVEL USER=========</option>
					<?php
						$str ="SELECT * FROM ref_modul_pengguna ORDER BY id_modul_pengguna ASC";
						$qr = mysql_query($str) or die(mysql_error());
						while($dt = mysql_fetch_array($qr)){
							echo "<option value='".$dt['id_modul_pengguna']."'>".$dt['modul_pengguna']."</option>";
						}
					?>	
					</select>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Unit Kerja / SKPD :</label>
					<input type="text" name="id_skpd" id="id_skpd" onclick="show_skpd();" class="form-control" placeholder=":: ID UNIT KERJA /SKPD ::" 
					value="<?=$dt['id_skpd'];?>"/>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Password :</label>
					<input type="password" class="form-control" name="password" id="password" placeholder=":: INPUT PASSWORD ANDA ::" onchange="validasi();"/>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Konfirmasi Password :</label>
					<input type="password" class="form-control" name="konfirmasi" id="konfirmasi" placeholder=":: KONFIRMASI PASSWORD BARU ::" onchange="cek();"/>
					<span id="konf_msg" style="color:red;display:none;"></span>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		 <table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
				<input type="submit" class="btn btn-success" id="submit" value="EDIT" style="width:120px;height:35px;"/>&nbsp;&nbsp;
				<input type="reset" class="btn btn-warning" value="RESET" style="width:120px;height:35px;"/>&nbsp;&nbsp;
				
				</td>
			</tr>
		 </table>
	</form>	
     </div>
</div>
</center>


<!-- DIALOG JQUERY ---------------------------------------------------------------------------------------------- -->
<div id="dialog_skpd" title="PILIH DATA SKPD" style="display: none;">
<form name="frm_skpd" id="frm_skpd" action="" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <input type="text" id="txt_filter" name="txt_filter" placeholder="Cari Nama SKPD / Unit Kerja" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='FILTER' style="height: 30px; width: 100px;"  /></td>
				 <td width='50%'><input type="button" value='RESET' style="height: 30px; width: 100px;"  onclick="clear_all();"/></td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>

<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtablebackup">
            <thead>
                <tr class="headertable">
                    <th width='30px'>No.</th>
                    <th width='150px'>Kode SKPD</th>
                    <th width='250px'>SKPD</th>
                    <th width='150px'>Alamat SKPD</th>
                    <th width='20px'>&nbsp;</th>
                </tr>
            </thead>
            <tbody id="listing_skpd" style="overflow: scroll;">
            </tbody>
        </table>
        <div class="kelang"></div>
        <div class="alert alert-success" role="alert" id="loading_skpd" style="display: none;">
            <strong>Loading...</strong> Harap tunggu beberapa saat.
        </div>
    </div>
</div>
</div>

