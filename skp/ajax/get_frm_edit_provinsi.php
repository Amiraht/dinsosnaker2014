<?php
	include "../php/koneksi.php";
	
	$id_provinsi = $_GET['id'];
	
	
	$res = mysql_query("SELECT * FROM ref_provinsi WHERE id_provinsi = '".$id_provinsi."'") or die(mysql_error());
							
	$dt = mysql_fetch_array($res);						
?>

<form name="frm_edit_provinsi" id="frm_edit_provinsi" action="php/c_panel/cp_edit_provinsi.php" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Provinsi</label>
					<input type="hidden" name="id_provinsi" value="<?=$dt['id_provinsi'];?>" />
                    <input type="text" id="provinsi" name="provinsi"  value="<?=$dt['provinsi'];?>"/>
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