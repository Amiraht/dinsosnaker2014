<?php
	include "../php/koneksi.php";					
?>

<form name="frm_edit_kabupaten" id="frm_edit_kabupaten" action="php/c_panel/cp_tambah_kabupaten.php" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Kabupaten</label>
                    <input type="text" id="kabupaten" name="kabupaten" id="kabupaten"/>
                </td>
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Provinsi</label>
                    <select name="id_provinsi" class="form-control">
						<option value='0' selected='selected'>=============PILIH PROVINSI===============</option>
						<?php
						$qr = mysql_query("SELECT * FROM ref_provinsi ORDER BY provinsi ASC") or die(mysql_error());
						while($opt = mysql_fetch_array($qr)){
							echo "<option value='".$opt['id_provinsi']."'>".$opt['provinsi']."</option>";
						}	
						?>
					</select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='SIMPAN' style="height: 30px; width: 100px;"  /></td>
				 <td width='50%'><input type="reset" value='RESET' style="height: 30px; width: 100px;"/></td>
            </tr>
        </table>
    </div>
</div>
</form>