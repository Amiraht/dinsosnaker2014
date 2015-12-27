<?php
	include "../php/koneksi.php";
	
	$id_kabupaten = $_GET['id'];
	
	
	$res = mysql_query("SELECT 
						 a.*, b.provinsi 
						FROM ref_kabupaten a
							LEFT JOIN 
							 ref_provinsi b ON  b.id_provinsi = a.id_provinsi 
							WHERE 
								a.id_kabupaten = '".$id_kabupaten."' 
							ORDER BY 
							a.kabupaten ASC ") or die(mysql_error());
							
	$dt = mysql_fetch_array($res);						
?>

<form name="frm_edit_kabupaten" id="frm_edit_kabupaten" action="php/c_panel/cp_edit_kabupaten.php" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Kabupaten</label>
					<input type="hidden" name="id_kab" value="<?=$dt['id_kabupaten'];?>">
					<input type="hidden" name="id_provinsi" value="<?=$dt['id_provinsi'];?>" />
                    <input type="text" id="kabupaten" name="kabupaten"  value="<?=$dt['kabupaten'];?>"/>
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