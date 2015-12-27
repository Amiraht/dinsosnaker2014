<script type="text/javascript">
$(document).ready(function(){
    //ambil_tanggal("tmt");
    //ambil_tanggal("tgl_sk_jabatan");
    ambil_tanggal("tgl_ijazah");
   
});

function kembali(){
	var id_level = "<?=$_SESSION['simpeg_id_level'];?>";
	if(id_level == 1 || id_level == 2){
		document.location.href='?mod=riwayat_pendidikan_pegawai';
	}else{
		document.location.href='?mod=riwayat_pendidikan';
	}
}
</script>
<form name="frm" id="frm" action="php/riwayat_pendidikan/riwayat_pendidikan_tambah.php" method="post" enctype="multipart/form-data">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">TAMBAH DATA RIWAYAT PENDIDIKAN </h3>
	<?php
		$nip = isset($_SESSION['nip']) ? $_SESSION['nip'] : "";
	?>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick='kembali();' class="btn btn-success"/>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='45%'>
                    <label>NIP :</label>
                    <input type="text" name="nip" id="nip" placeholder=":: INPUT NIP PEGAWAI ::" value="<?=$nip;?>"/>
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
					<input type="file" name="sc_ijazah" id="sc_ijazah" />
                </td>
                <td width='50%'>
                    <label>Nama Tempat Pendidikan :</label>
                    <input placeholder=":: INPUT TEMPAT PENDIDIKAN (contoh : SMA Negri 1 Medan) ::" type="text" name="tempat_pendidikan" id="tmp_pendidikan" />
                </td>
               
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='45%'>
                    <label>Nama Kepala Sekolah / Tempat Pendidikan : </label>
					<input type="text" name="kepala" id="kepala"  placeholder=":: Nama Kepala Sekolah / Pimpinan Tempat Pendidikan ::"/>
                </td>
                <td width='50%'>
                    <label>Nilai/ Indeks :</label>
                    <input placeholder=":: INPUT NILAI / INDEKS YANG DIPEROLEH ::" type="text" name="index" id="index" maxlength="5"/>
                </td>
               
            </tr>
        </table>
      
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='45%'>
                    <label>Nomor Ijazah :</label>
                    <input placeholder=":: Nomor Ijazah ::" type="text" name="no_ijazah" id="no_ijazah" />
                </td>
                <td width='50%'>
                    <label>Tanggal Ijazah:</label>
                    <input placeholder=":: Tanggal Ijazah ::" type="text" name="tgl_ijazah" id="tgl_ijazah" />
                </td>
            </tr>
        </table>

        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" value="SIMPAN" class="btn btn-success" style="width: 150px; height: 40px;" />&nbsp;
                    <input type="reset" value="RESET" style="width: 150px; height: 40px;" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
