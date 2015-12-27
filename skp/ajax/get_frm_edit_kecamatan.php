<?php
	include "../php/koneksi.php";
	
	$id_kecamatan = $_GET['id'];
	
	
	$res = mysql_query("SELECT 
						 a.*, b.kabupaten 
						FROM ref_kecamatan a
							LEFT JOIN 
							 ref_kabupaten b ON  b.id_kabupaten = a.id_kabupaten
							WHERE 
								a.id_kecamatan = '".$id_kecamatan."' 
							ORDER BY 
							a.kecamatan ASC ") or die(mysql_error());
							
	$dt = mysql_fetch_array($res);						
?>

<form name="frm_edit_kecamatan" id="frm_edit_kecamatan" action="php/c_panel/cp_edit_kecamatan.php" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Kecamatan</label>
					<input type="hidden" name="id_kab" value="<?=$dt['id_kabupaten'];?>">
					<input type="hidden" name="id_kecamatan" value="<?=$dt['id_kecamatan'];?>" />
                    <input type="text" id="kecamatan" name="kecamatan"  value="<?=$dt['kecamatan'];?>"/>
                </td>
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Kabupaten</label>
					<select name="id_kabupaten" class="form-control">
						<option value='0' selected='selected'>=========================PILIH NAMA KABUPATEN=========================</option>
						<?php
							$qr = mysql_query("SELECT * FROM ref_kabupaten ORDER BY kabupaten ASC") or die(mysql_error());
							while($dt = mysql_fetch_array($qr)){
								echo "<option value='".$dt['id_kabupaten']."'>".$dt['kabupaten']."</option>";
							}	
						?>
					</select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='SIMPAN' style="height: 30px; width: 100px;"  class="btn btn-success"/></td>
				 <td width='50%'><input type="reset" value='RESET' style="height: 30px; width: 100px;" class="btn btn-info"/></td>
            </tr>
        </table>
    </div>
</div>
</form>