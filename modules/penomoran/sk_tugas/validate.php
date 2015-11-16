<?php
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
$nomor = $_POST["nomor"];
$tanggal= $_POST["tanggal"];
$mode=$_GET["act"];
$tgl=strtotime($tanggal);
$tahun=date("Y",$tgl);

if($no_resi<>'' and $nomor<>'' and $tanggal<>'')
{
	$data=explode("-",$no_resi);
	$jenis_urus = $data[0];
	
	if($mode==1)
	{
		if($jenis_urus=='03')
		{
			$nmpri=mysql_query("select statusp1,statusp2,statusp3 from tbl_berkas_pengaduan where no_resi='$no_resi'");
			$rnmpri = mysql_fetch_array($nmpri);
			$sp1=$rnmpri["statusp1"];
			$sp2=$rnmpri["statusp2"];
			$sp3=$rnmpri["statusp3"];
			
			if($sp1=='0')
			{
				$a="insert into tbl_sp1(no_resi,no_surat,tanggal,tahun) values('".$no_resi."','".$nomor."','".$tanggal."','".$tahun."')";
			}
			else
			{
				if($sp2=='0')
				{
					$a="insert into tbl_sp2(no_resi,no_surat,tanggal,tahun) values('".$no_resi."','".$nomor."','".$tanggal."','".$tahun."')";
				}
				else
				{
					$a="insert into tbl_sp3(no_resi,no_surat,tanggal,tahun) values('".$no_resi."','".$nomor."','".$tanggal."','".$tahun."')";
				}
				
			}
		}
		else
		{
			$a = "insert into tbl_surat_tugas(no_resi,no_surat,tanggal,tahun) values('".$no_resi."','".$nomor."','".$tanggal."','".$tahun."')";
		}
	}
	else
	{
	
	
		if($jenis_urus=='03')
		{
			$nmpri=mysql_query("select statusp1,statusp2,statusp3 from tbl_berkas_pengaduan where no_resi='$no_resi'");
			$rnmpri = mysql_fetch_array($nmpri);
			$sp1=$rnmpri["statusp1"];
			$sp2=$rnmpri["statusp2"];
			$sp3=$rnmpri["statusp3"];
			
			if($sp1=='0')
			{
				$a="update tbl_sp1 set no_surat='".$nomor."',tanggal='".$tanggal."',tahun='".$tahun."' where no_resi='".$no_resi."'";
			}
			else
			{
				if($sp2=='0')
				{
					$a="update tbl_sp2 set no_surat='".$nomor."',tanggal='".$tanggal."',tahun='".$tahun."' where no_resi='".$no_resi."'";
				}
				else
				{
					$a="update tbl_sp3 set no_surat='".$nomor."',tanggal='".$tanggal."',tahun='".$tahun."' where no_resi='".$no_resi."'";
				}
				
			}
		}
		else
		{
			$a="update tbl_surat_tugas set no_surat='".$nomor."',tanggal='".$tanggal."',tahun='".$tahun."' where no_resi='".$no_resi."'";
		}	
	}
	$do = mysql_query($a);
	if($do)
		{ 
			?>
			<script type="text/javascript">
				alert("Berhasil");
				document.location = "./index.php?link=<?php echo $no_resi; ?>";
			</script>
			<?php
		} 
		
		else {
		echo $a;
		echo "Gagal simpan"; }
}
?>


