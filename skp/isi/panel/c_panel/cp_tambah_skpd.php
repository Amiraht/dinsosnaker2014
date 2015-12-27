<script type="text/javascript">
	$(document).ready(function(){
		// Dialog untuk memunculkan daftar SKPD 
		 $("#dialog_instansi").dialog({
            autoOpen: false,
    		height: "600",
    		width: "1200",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
		
		$("#frm_instansi").submit(function(){
            var filter = $("#txt_filter").val();
			$("#listing_instansi").html("");
            $.ajax({
                type: "GET",
                url: "ajax/get_list_instansi.php",
                data: "filter=" + filter,
                success: function(r){
                    $("#listing_instansi").html(r);
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
	function pilih_instansi(str){
		$("#txt_filter").val("");
		$("#listing_instansi").html("");
		$("#id_instansi").val(str);
		$("#dialog_instansi").dialog("close");
	}
	
	function show_instansi(){
		$("#dialog_instansi").dialog("open");
	}
	
	function clear_all(){
		$("#listing_instansi").html("");
		$("#txt_filter").val("");
	}
	
	function kembali(){
		document.location.href = "?mod=cp_manage_skpd";
	}
</script>
<center>
<div class="panelcontainer panelform" style="width: 90%;">
    <h3 style="text-align: left;">TAMBAH DATA SKPD</h3><br/>
	<?php
		if(isset($_GET['msg'])){
			if($_GET['msg'] ==  1){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data SKPD Berhasil Ditambahkan.</center>";
				echo "</div><br/>";
			}else{
				echo "<div class='alert alert-danger' role='alert' id='alert_add'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Maaf, Proses error, terjadi kesalahan dalam pemrosesan.</center>";
				echo "</div><br/>";
			}
		}
	?>
	<button id="back" class="btn btn-success" style="width:135px; height:35px; float:left; margin-left:20px;" onclick="kembali();">KEMBALI</button><br/>
    <div class="bodypanel bodyfilter" id="bodyfilter">
	
	<form method="POST" id="frm_add_pengguna" name="frm_add_pengguna" action="php/c_panel/cp_tambah_skpd.php">
        <table border="0px" cellspacing='0' cellpadding='6' width='100%'>
            <tr>
				<td><label>Nama SKPD / Unit Kerja :</label>
				<input type="text" class="form-control" name="skpd" id="skpd" placeholder=":: INPUT NAMA SKPD / UNIT KERJA ::"/>
				</td>
            </tr>
        </table>
		<div class="kelang"></div>
		
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Nama Instansi :</label>
					<input type="text" name="id_instansi" id="id_instansi" onclick="show_instansi();" class="form-control" placeholder=":: PILIH INSTANSI (ID) ::"/>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Kode SKPD:</label>
					<input type="text" class="form-control" name="kode" id="kode" placeholder=":: INPUT KODE SKPD ::" />
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Alamat SKPD:</label>
					<input type="text" class="form-control" name="alamat" id="alamat" placeholder=":: INPUT ALAMAT SKPD  ::"/>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		 <table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
				<input type="submit" class="btn btn-success" id="submit" value="SUBMIT" style="width:120px;height:35px;"/>&nbsp;&nbsp;
				<input type="reset" class="btn btn-warning" value="RESET" style="width:120px;height:35px;"/>&nbsp;&nbsp;
			
				</td>
			</tr>
		 </table>
		 
	</form>	
     </div>
</div>
</center>


<!-- DIALOG JQUERY ---------------------------------------------------------------------------------------------- -->
<div id="dialog_instansi" title="PILIH DATA INSTANSI" style="display: none;">
<form name="frm_instansi" id="frm_instansi" action="" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <input type="text" id="txt_filter" name="txt_filter" placeholder="Cari Nama Instansi.." />
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
                    <th width='180px'>Nama Instansi</th>
                    <th width='20px'>&nbsp;</th>
                </tr>
            </thead>
            <tbody id="listing_instansi" style="overflow: scroll;">
            </tbody>
        </table>
        <div class="kelang"></div>
        <div class="alert alert-success" role="alert" id="loading_instansi" style="display: none;">
            <strong>Loading...</strong> Harap tunggu beberapa saat.
        </div>
    </div>
</div>
</div>

