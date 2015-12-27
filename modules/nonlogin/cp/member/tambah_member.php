<style type="text/css" media="all">@import "../../../css/template.css";</style>
<script type="text/javascript">
function cek_tambah()
{
	if(document.ftambah.nama.value == '')
		alert('nama tidak boleh kosong');
	else if(document.ftambah.username.value == '')
		alert('username tidak boleh kosong');
	else
		document.ftambah.submit();

}

function cek_pass(){
	var k_pass = document.ftambah.k_pass.value;
	var pass = document.ftambah.password.value;
	var ps = document.getElementById("p_cek");
	if(k_pass != pass){
		ps.html("<span style='color:red;font-size:11px;font-family:verdana;'><i>Maaf, konfirmasi password masih salah..</i></span>");
	}else{
		ps.html("");
	}
}
</script>
<?php
		require_once('../../../../libraries/dinsos.php');	
?>

<fieldset style="margin:10px">
<legend style="font-family:verdana; font-size:12px;"><b>Tambah Data Pengguna</b></legend>
<form action="./validasi.php?optss=tambah" method="post" name="ftambah" enctype="multipart/form-data">
<table cellpadding="2px" cellspacing="1px" border="0" align="left" id="tbl">
<tr id="tbl-content">
	<td width="40%">NIP</td>
    <td><input type="text" name="nip" maxlength="100" style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td width="40%">NAMA</td>
    <td><input type="text" name="nama" maxlength="100" style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>

<tr id="tbl-content">
	<td >JABATAN</td>
    <td><input type="text" name="jabatan"  style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td>UNIT KERJA / SKPD</td>
    <td>
		<select name="kode_skpd">
		<?php
			$sk = "SELECT * FROM ref_skpd ORDER BY id_skpd ASC";
			$qr = mysql_query($sk) or die(mysql_error());
			while($skpd = mysql_fetch_array($qr)){
				if($skpd["kode_skpd"] == '016'){
					echo "
						<option selected='selected' value='". $skpd["kode_skpd"] ."'>
							". $skpd["skpd"] ."
						</option>
					";
				}else{
					echo "
						<option value='". $skpd["kode_skpd"] ."'>
							". $skpd["skpd"] ."
						</option>
					";
				}	
			}
		?>
		</select>
	</td>
</tr>

<tr id="tbl-content">
	<td>LEVEL</td>
    <td><select name="level">
    <option value="0">PILIH LEVEL</option>
    <?php
		$c = mysql_query("select * from tbl_ket_level order by id_level asc");
		while($c1 = mysql_fetch_array($c))
		{
				echo '<option value="'.$c1["id_level"].'">'.$c1["nama_level"].'</option>';
		}
	?>
    </select></td>
</tr>
<tr id="tbl-content">
	<td>ALAMAT</td>
    <td><input type="text" name="alamat"  style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td>NO KONTAK</td>
    <td><input type="text" name="no_kontak"  style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td>EMAIL</td>
    <td><input type="text" name="email"  style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td>PANGKAT DAN GOL.RUANG</td>
    <td><select name="panggol">
		<?php
			$p = "SELECT * FROM ref_pangkat ORDER BY id_pangkat ASC";
			$r = mysql_query($p) or die(mysql_error());
			while($pg = mysql_fetch_array($r)){
				
					echo "
						<option value='". $pg["id_pangkat"] ."'>
							". $pg["pangkat"] ." (". $pg["gol_ruang"] .")
						</option>
					";
				
			}
		?>
		</select></td>
</tr>
<tr id="tbl-content">
	<td >USERNAME</td>
    <td><input type="text" name="username" maxlength="100" style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td >PASSWORD</td>
    <td><input type="password" name="password" style="font-family:verdana; font-size:10px;" size="30"/></td>
</tr>
<tr id="tbl-content">
	<td >KONFIRMASI PASSWORD</td>
    <td><input type="password" name="k_pass" onchange="cek_pass();" style="font-family:verdana; font-size:10px;" size="30"/>
		&nbsp;
		<div id="p_cek"></div>
	</td>
</tr>
<tr id="tbl-content">
	<td>IZIN</td>
    <td><input type="radio" value="Y" name="izin" />YA&nbsp;&nbsp;&nbsp;<input type="radio" value="N" name="izin" />TIDAK</td>
</tr>
<tr id="tbl-content">
	<td colspan="2"><img src="../../../../image/button/simpan.gif" style="border:none" onmouseover="this.src='../../../../image/button/simpan2.gif';this.style.cursor='pointer';" onmouseout="this.src='../../../../image/button/simpan.gif';" width="90" height="27" title="Klik Untuk Menyimpan" onclick="cek_tambah();"/></td>
</tr>
</table>