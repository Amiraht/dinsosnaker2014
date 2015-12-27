<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tmt");
    ambil_tanggal("tgl_ijazah");
	
	
});
</script>
<script>
	function pesan($msg){
		jAlert($msg, "KONFIRMASI", function(r){
            document.location.href="?mod=riwayat_pendidikan";
        });
	}
</script>
<?php
    $id_rp = mysql_real_escape_string($_GET['id']);
	$sql = "SELECT
						a.id_data_rp as 'id_data', a.nip, a.tempat_pendidikan, a.k_a_tempat_pendidikan as 'kepala' ,b.nama_pegawai, 
							   c.tingkat_pendidikan , a.nilai, a.no_ijazah, a.tgl_ijazah,
                               a.no_ijazah, a.tgl_ijazah, a.supervisi
                                FROM
                                	tbl_riwayat_pendidikan a
                                	LEFT JOIN tbl_pegawai b ON a.nip = b.nip
									LEFT JOIN ref_tingkat_pendidikan c ON a.id_tingkat_pendidikan = c.id_tingkat_pendidikan
					WHERE 
						a.id_data_rp = '". $id_rp ."'
		";
	$query = mysql_query($sql) or die(mysql_error());
	$data = mysql_fetch_array($query);	
?>

<form name="frm" id="frm" action="php/riwayat_pendidikan/riwayat_pendidikan_edit.php" method="post" enctype="multipart/form-data">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">EDIT DATA RIWAYAT PENDIDIKAN (ID Data : <?=$data['id_data']; ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=riwayat_pendidikan';" />
        <div class="kelang"></div>
       <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='45%'>
                    <label>NIP :</label>
					<input type="hidden" name="id_rp" value="<?=$id_rp;?>" />
                    <input type="text" name="nip" id="nip" value="<?=$data['nip'];?>"/>
                </td>
                 <td width='50%'>
                    <label>Tingkat Pendidikan : </label>
                    <select name="tk_pendidikan" id="tk_pendidikan">
                        <option value="0">:: PILIH TINGKAT PENDIDIKAN ::</option>
					<?php
						$sql = "SELECT * FROM ref_tingkat_pendidikan ORDER BY id_tingkat_pendidikan ASC";
						$qr = mysql_query($sql) or die(mysql_error());
						while($opt = mysql_fetch_array($qr)){
							echo "<option value='". $opt['id_tingkat_pendidikan'] ."'>".$opt['tingkat_pendidikan']."</option>";
						}
					?>	
                    </select>
                </td>
              
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='45%'>
                    <label>Upload Scan File Ijazah : </label>
					<input type="file" name="sc_ijazah" id="sc_ijazah" value="<?=$data['scan_ijazah'];?>" />
                </td>
                <td width='50%'>
                    <label>Nama Tempat Pendidikan :</label>
                    <input type="text" name="tempat_pendidikan" id="tmp_pendidikan" value="<?=$data['tempat_pendidikan'];?>"/>
                </td>
               
            </tr>
        </table>
      <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='45%'>
                    <label>Nama Kepala Sekolah / Tempat Pendidikan : </label>
					<input type="text" name="kepala" id="kepala"  value="<?=$data['kepala'];?>"/>
                </td>
                <td width='50%'>
                    <label>Nilai/ Indeks :</label>
                    <input type="text" name="index" id="index" maxlength="5" value="<?=$data['nilai'];?>"/>
                </td>
               
            </tr>
        </table>
      
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='45%'>
                    <label>Nomor Ijazah :</label>
                    <input type="text" name="no_ijazah" id="no_ijazah" value="<?=$data['no_ijazah'];?>"/>
                </td>
                <td width='50%'>
                    <label>Tanggal Ijazah:</label>
                    <input type="text" name="tgl_ijazah" id="tgl_ijazah" value="<?=$data['tgl_ijazah'];?>"/>
                </td>
            </tr>
        </table>

        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" value="SIMPAN UBAH" class="btn btn-success" style="width: 150px; height: 40px;" />&nbsp;
                    <input type="reset" value="RESET" style="width: 150px; height: 40px;" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>

