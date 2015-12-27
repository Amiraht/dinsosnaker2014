<?php
	include "../php/koneksi.php";					
?>

<form name="frm_add_kecamatan" id="frm_add_kecamatan" action="php/c_panel/cp_tambah_kecamatan.php" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Kecamatan</label>
                    <input type="text" id="kecamatan" name="kecamatan" />
                </td>
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Provinsi</label>
                    <select name="id_kabupaten" class="form-control">
						<option value='0' selected='selected'>=============PILIH KABUPATEN===============</option>
						<?php
						$qr = mysql_query("SELECT * FROM ref_kabupaten ORDER BY kabupaten ASC") or die(mysql_error());
						while($opt = mysql_fetch_array($qr)){
							echo "<option value='".$opt['id_kabupaten']."'>".$opt['kabupaten']."</option>";
						}	
						?>
					</select>
                </td>
            </tr>
        </table><br/>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='SIMPAN' style="height: 30px; width: 100px;" class="btn btn-success" /></td>
				 <td width='50%'><input type="reset" value='RESET' style="height: 30px; width: 100px;"  class="btn btn-info"/></td>
            </tr>
        </table>
    </div>
</div>
</form>