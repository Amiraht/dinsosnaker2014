<script type="text/javascript">
	$(document).ready(function(){
		$("#submit").click(function(){
			var lama = $('#old_pass').val();
			var baru = $('#new_pass').val();
			var konfirmasi = $('#konfirmasi').val();
			if(lama == '' || baru == '' || konfirmasi == ''){
				jAlert("Maaf, field masih kosong", "PERHATIAN");
				return false;
			}else if(baru != konfirmasi){
				jAlert("Maaf, konfirmasi password baru anda masih salah !!", "PERHATIAN");
				return false;
			}else if(lama == baru){
				jAlert("Maaf, password baru masih sama dengan password lama !!", "PERHATIAN");
				return false;
			}else{
				$('#notifikasi').html("");
				$.post("php/ubah_password.php",
						$("#frm_reset").serialize(),
						function(data){
							$('#notifikasi').show();
							$('#notifikasi').html(data);
						}
				);
				return false;
			}
		});
	});
</script>
<center>
<div class="panelcontainer panelform" style="width: 50%;">
    <h3 style="text-align: left;">GANTI PASSWORD LOGIN </h3>
	<div id="notifikasi" style="display:none;">
	</div>
    <div class="bodypanel bodyfilter" id="bodyfilter">
	<form method="POST" id="frm_reset" name="frm_reset" action="">
        <table border="0px" cellspacing='0' cellpadding='6' width='100%'>
            <tr>
				<td><label>Password Lama :</label>
				<input type="hidden" name="username" id="username" value="<?=$_SESSION['simpeg_username'];?>"/>
				<input type="password" class="form-control" name="old_pass" id="old_pass" placeholder=":: INPUT PASSWORD LAMA ANDA ::"/>
				</td>
            </tr>
			
        </table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Password Baru :</label>
					<input type="password" class="form-control" name="new_pass" id="new_pass" placeholder=":: INPUT PASSWORD BARU ::"/>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
					<label>Konfirmasi Password Baru :</label>
					<input type="password" class="form-control" name="konfirmasi" id="konfirmasi" placeholder=":: KONFIRMASI PASSWORD BARU ::"/>
				</td>
			</tr>
		</table>
		<div class="kelang"></div>
		 <table border="0px" cellspacing='0' cellpadding='6' width='100%'>
			<tr>
				<td>
				<input type="submit" class="btn btn-success" id="submit" value="UBAH" style="width:120px;height:35px;"/>
				<input type="reset" class="btn btn-warning" value="RESET" style="width:120px;height:35px;"/>
				</td>
			</tr>
		 </table>
	</form>	
     </div>
</div>
</center>
