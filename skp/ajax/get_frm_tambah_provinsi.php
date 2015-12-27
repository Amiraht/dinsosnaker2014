<?php
	include "../php/koneksi.php";					
?>

<form name="frm_add_provinsi" id="frm_add_provinsi" action="php/c_panel/cp_tambah_provinsi.php" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Provinsi</label>
                    <input type="text" id="provinsi" name="provinsi" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='SIMPAN' style="height: 30px; width: 100px;" class="btn btn-success" /></td>
				 <td width='50%'><input type="reset" value='RESET' style="height: 30px; width: 100px;"  class="btn btn-info"/></td>
            </tr>
        </table>
    </div>
</div>
</form>