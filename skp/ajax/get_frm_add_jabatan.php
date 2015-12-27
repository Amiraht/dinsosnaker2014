<?php
	include "../php/koneksi.php";
	include "../php/mysqli_connect.php";	
?>

<form name="frm_add_jabatan" id="frm_add_jabatan" action="php/c_panel/cp_add_jabatan.php" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan"/>
                </td>
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Kode Jabatan</label>
                    <input type="text" id="kode_jabatan" name="kode_jabatan"/>
                </td>
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Tipe Eselon</label>
                    <select name="id_eselon" class="form-control">
						<option value='0' selected='selected'>==============PILIH TIPE ESELON==============</option>
						<?php
							$qr = "SELECT * FROM ref_eselon ORDER BY id_eselon ASC";
							$rs = $con->query($qr);
							$rs->data_seek(0);
							while($row = $rs->fetch_assoc()){
								echo "<option value='".$row['id_eselon']."'>".$row['eselon']."</option>";
							}
							$rs->close();
						?>
					</select>
                </td>
            </tr>
        </table>
	    <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Tipe Jabatan</label>
                    <select name="id_tipe_jabatan" class="form-control">
						<option value='0' selected='selected'>===================TIPE JABATAN===============</option>
					<?php
						$jb = $con->query("SELECT * FROM ref_tipe_jabatan ORDER BY id_tipe_jabatan ASC");
						$jb->data_seek(0);
						while($dt = $jb->fetch_assoc()){
							echo "<option value='".$dt["id_tipe_jabatan"]."'>".$dt["tipe_jabatan"]."</option>";
						}
						$jb->close();
					?>	
					</select>
                </td>
            </tr>
        </table>
		
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Unit Kerja / SKPD</label>
                    <select name="id_skpd" class="form-control" id="id_skpd">
						<option value='0' selected='selected'>=============Unit Kerja / SKPD===============</option>
						<?php
						$skpd = $con->query("SELECT * FROM ref_skpd ORDER BY skpd ASC");
						$skpd->data_seek(0);
						while($dt = $skpd->fetch_assoc()){
							echo "<option value='".$dt["id_skpd"]."'>".$dt["skpd"]."</option>";
						}
						$skpd->close();
						?>
					</select>
                </td>
            </tr>
        </table>
		
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='SIMPAN' style="height: 30px; width: 100px;" class="btn btn-success" /></td>
				 <td width='50%'><input type="reset" value='RESET' style="height: 30px; width: 100px;" class="btn btn-info"/></td>
            </tr>
        </table>
    </div>
</div>
</form>