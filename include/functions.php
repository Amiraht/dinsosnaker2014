<?php

function openDatabase(){
	//mysql_connect("localhost", "root", "dinsosrunning100%");
	mysql_connect("localhost", "root", "");
	mysql_select_db("db_disnakersos");
}

function upload_random($fupload_name, $link){
  //direktori gambar
  $vdir_upload = "../foto_random/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  if(!move_uploaded_file($_FILES["file"]["tmp_name"], $vfile_upload))
  {
  	pesan('gagal upload', $link);
	exit();
  }

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 230;
  $dst_height = ($dst_width/$src_width)*$src_height;
  
  $dst_width1 = 110;
  $dst_height1 = 110;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
  
  $im1 = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im1, $im_src, 0, 0, 0, 0, $dst_width1, $dst_height1, $src_width, $src_height);

  //Simpan gambar
  if(imagejpeg($im,$vdir_upload . 'file/' . $fupload_name))
  	return true;
  else
  	return false;

  if(imagejpeg($im1,$vdir_upload . 'thumb/' . $fupload_name))
  	return true;
  else
  	return false;	
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im1);
}

function upload_foto($fupload_name, $link){
  //direktori gambar
  $vdir_upload = "../foto_organisasi/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  if(!move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload))
  {
  	pesan('gagal upload', $link);
	exit();
  }

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = 110;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if(imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name))
  	return true;
  else
  	return false;	
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function upload_gbr($fupload_name, $link){
  //direktori gambar
  $vdir_upload = "./foto_dokter/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  if(!move_uploaded_file($_FILES["file"]["tmp_name"], $vfile_upload))
  {
  	pesan('gagal upload', $link);
	exit();
  }

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = 110;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if(imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name))
  	return true;
  else
  	return false;	
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function upload_image($fupload_name, $link){
  //direktori gambar
  $vdir_upload = "../foto/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  if(!move_uploaded_file($_FILES["file"]["tmp_name"], $vfile_upload))
  {
  	pesan('gagal upload', $link);
	exit();
  }

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = 110;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if(imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name))
  	return true;
  else
  	return false;	
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function cek_image($image)
{
	if($image == 'image/jpg' or $image == 'image/jpeg')
		return true;
	else
		return false;
}

function max_file()
{
	$phpmaxsize = ini_get('upload_max_filesize');
	$phpmaxsize = trim($phpmaxsize);
	$last = strtolower($phpmaxsize{strlen($phpmaxsize)-1});
	switch($last)
	{
		case 'g':
			$phpmaxsize *= 1024;
		case 'm':
			$phpmaxsize *= 1024;
	}
	return $phpmaxsize;
}
function cek_ukuran($ukuran)
{
	if(ceil($ukuran/1024) >= max_file())
		return false;
	else
		return true;
}

function cek_link($link)
{
	$web = $link;
	if(substr($web, 0, 7) != 'http://')
	{
		if(substr($web, 0, 8) == 'https://')
			$web = $web;
		else
			$web = 'http://'.$web;
	}
	
	if(preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $web))
		return true;
	else
		return false;
}

function cek_telepon($telepon)
{
	if(is_numeric($telepon))
		return true;
	else
		return false;
}

function cek_kode_pos($kode_pos)
{
	if(preg_match("/^\d{5}([\-]\d{4})?$/", $kode_pos))
		return true;
	else
		return false;
}

function cek_email($email)
{
	if(preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email))
		return true;
	else
		return false;
}

function pesan($pesan, $link)
{
?>
	<script type="text/javascript">
		alert('<?php echo $pesan; ?>');
		document.location.href='<?php echo $link; ?>';
	</script>
<?php
}

function anti_injection($data)
{
	$data1 = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $data1;
}

function tidak_lengkap($link)
{
?>
	<script type="text/javascript">
		alert('isi form dengan lengkap');
		document.location.href='<?php echo $link; ?>';
	</script>
<?php
}

function benar($link)
{
?>
	<script type="text/javascript">
		alert('berhasil');
		document.location.href='<?php echo $link; ?>';
	</script>
<?php
}

function salah($link)
{
?>
	<script type="text/javascript">
		alert('gagal');
		document.location.href='<?php echo $link; ?>';
	</script>
<?php
}

function cek_browser()
{
	$u_agent = $_SERVER["HTTP_USER_AGENT"];
	if(!preg_match('/Firefox/i',$u_agent) and !preg_match('/Chrome/i',$u_agent))
    {
	?>
    	<script type="text/javascript">
			alert('Web ini dapat berjalan dengan baik, jika Anda menggunakan Mozilla Firefox 3.6+ atau Chrome');
		</script>
    <?php
		echo '<br>';
		echo '<div style="color:#FF0000; text-align:center; font-weight:bold; font-size:16px">Web ini dapat berjalan dengan baik, jika Anda menggunakan Mozilla Firefox 3.6+ atau Chrome</div>';	
    }
}

function failed()
{
?>
	<script type="text/javascript">
		alert('failed');
		document.location.href='./index.php';
	</script>
<?php
}

	
function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			}
			
function hari($tgl){
	$tanggal = substr($tgl,8,2);
	return $tanggal;
}
function bln($tgl){
	$tanggal = substr($tgl,5,2);
	return $tanggal;
}
function thn($tgl){
	$tanggal = substr($tgl,0,4);
	return $tanggal;
}

function tgl_biasa($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = substr($tgl,5,2);
			$tahun = substr($tgl,0,4);
			return $tanggal.'-'.$bulan.'-'.$tahun;		 
	}			
function terbilang($bilangan){
 $bilangan = abs($bilangan);

$angka = array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
 $temp = "";

if($bilangan < 12){
 $temp = " ".$angka[$bilangan];
 }else if($bilangan < 20){
 $temp = terbilang($bilangan - 10)." belas";
 }else if($bilangan < 100){
 $temp = terbilang($bilangan/10)." puluh".terbilang($bilangan%10);
 }else if ($bilangan < 200) {
 $temp = " seratus".terbilang($bilangan - 100);
 }else if ($bilangan < 1000) {
 $temp = terbilang($bilangan/100). " ratus". terbilang($bilangan % 100);
 }else if ($bilangan < 2000) {
 $temp = " seribu". terbilang($bilangan - 1000);
 }else if ($bilangan < 1000000) {
 $temp = terbilang($bilangan/1000)." ribu". terbilang($bilangan % 1000);
 }else if ($bilangan < 1000000000) {
 $temp = terbilang($bilangan/1000000)." juta". terbilang($bilangan % 1000000);
 }

return $temp;
}

// fungsi untuk menentukan nilai id maks setiap tabel database
   function setIDTabel($nama_tabel, $FIELD_ID){
	   openDatabase();
	   $id = 0;
	   $sql = "SELECT MAX(".$FIELD_ID.") as maks FROM ".$nama_tabel."";
	   $query = mysql_query($sql) or die(mysql_error());
	   $fetch = mysql_fetch_array($query);
	   $tmp = $fetch['maks'];
	   
	   if($tmp <= 0){
		   $id = 1;
	   }else{
		   $id = (int) ($tmp + 1);
	   }
	   mysql_close(); // close the connection stream database
	   return $id;
   }

	function iniateResi(){
		openDatabase();
		$rse = array();
		$query = mysql_query("SELECT no_resi FROM tbl_berkas_iplk ORDER BY no_resi DESC") or die(mysql_error());
			if(mysql_num_rows($query) > 0)
			{
				$result = mysql_fetch_row($query);
				$data = explode("-",$result[0]);
				$jenis_urus = $data[0];
				$data[1]+=1;
				if($data[1]>99)
					$no_resi="06-".$data[1];
				else if($data[1]>9)
					$no_resi="06-0".$data[1];
				else if($data[1]<=9)
					$no_resi="06-00".$data[1];
				$rse['jenis_urus'] = $jenis_urus;
				$rse['no_resi'] = $no_resi;
			}else
			{
				$no_resi="06-001";
				$jenis_urus="06";
				$rse['jenis_urus'] = $jenis_urus;
				$rse['no_resi'] = $no_resi;
			}
		
		return $rse;
	}
?>