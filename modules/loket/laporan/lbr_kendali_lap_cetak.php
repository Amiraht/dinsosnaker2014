<?php
	session_start();
	

	//define(DS,'/');
	//define(K_LIBRARIES,'libraries');
	//include("connect.php");

if ($_GET["mode"]=='1')
{
	define('_FCEE_EXEC', '1');
	require_once('../../../libraries/dinsos.php');
	$resi = $_GET["link"];
	$mode = $_GET["mode"];
	
	function HeaderingExcel($filename)
	{
    	header("Content-type:application/vnd.ms-excel");
    	header("Content-Disposition:attachment;filename=$filename");
    	header("Expires:0");
    	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
    	header("Pragma: public");
	}
	
	HeaderingExcel('Laporan_lembar_kendali.xls');
	
	require_once('../../../libraries/excel-lib/OLEwriter.php');	
	require_once('../../../libraries/excel-lib/BIFFwriter.php');
	require_once('../../../libraries/excel-lib/Worksheet.php');
	require_once('../../../libraries/excel-lib/Workbook.php');		
	
	
	$workbook=new Workbook("-");
	
	$fJudul=& $workbook->add_format();
	$fJudul->set_bold();
	$fJudul->set_pattern(1);
	$fJudul->set_fg_color($color='red');

	$fList=& $workbook->add_format();
	$fList->set_border(1);
	
	$fList_title=& $workbook->add_format();
	$fList_title->set_border(1);
	$fList_title->set_bold();
	$fList_title->set_merge();
	
	$fBesar=& $workbook->add_format();
	$fBesar->set_bold();
	$fBesar->set_size(10);
	
	$worksheet1= & $workbook->add_worksheet("Sheet 1");
	$worksheet1->set_column(1,1,5);
	for ($i=2;$i<8;$i++)
	{
		$worksheet1->set_column(1,$i,15);
	}
	$worksheet1->set_column(1,8,20);
	$worksheet1->merge_cells(2,1,2,8);

	// tabel title=================================================================================
	$worksheet1->write_string(2,1,"LAPORAN LEMBAR KENDALI",$fBesar);
	//$worksheet1->write_string(3,1,"Mulai : ".$_GET["tgl1"]." s.d ".$_GET["tgl2"],$fBesar);
	
	for ($i=2;$i<=8;$i++)
	{
		$worksheet1->write_blank(2,$i,$fBesar);
	}
	
	$worksheet1->write_string(4,1,"No",$fList_title);
	$worksheet1->write_string(4,2,"No Resi",$fList_title);
	$worksheet1->write_string(4,3,"Tgl Masuk",$fList_title);
	$worksheet1->write_string(4,4,"Jenis Pengurusan",$fList_title);
	$worksheet1->write_string(4,5,"Perusahaan",$fList_title);
	$worksheet1->write_string(4,6,"Pemohon",$fList_title);
	$worksheet1->write_string(4,7,"Alamat Perusahaan",$fList_title);
	$worksheet1->write_string(4,8,"Alamat Pemohon",$fList_title);

		
	//tabel content======================================================================================
	
	
	if(!empty($_GET["cari"]) and $_GET["jenis"]!='0')
					{
						$str = "SELECT 
									a.* , b.nama , b.alamat as alamat_usaha , c.jenis 
								FROM
									tbl_info_berkas a 
								LEFT JOIN vw_dinsos b ON a.id_perusahaan = b.id_perusahaan 
								LEFT JOIN tbl_jenis_pengurusan c ON a.jenis_pengurusan = c.kode 
                                WHERE 
									a.nama LIKE '%".$_GET['cari']."%' AND 
									a.jenis_pengurusan='".$_GET["jenis"]."'  
											
						";
						
						$query = mysql_query($str) or die(mysql_error());
					}
				elseif(!empty($_GET["cari"]) )
					{
						$str = "SELECT 
									a.* , b.nama , b.alamat as alamat_usaha , c.jenis 
								FROM
									tbl_info_berkas a 
								LEFT JOIN vw_dinsos b ON a.id_perusahaan = b.id_perusahaan 
								LEFT JOIN tbl_jenis_pengurusan c ON a.jenis_pengurusan = c.kode 
                                WHERE 
									a.nama LIKE '%".$_GET['cari']."%'  
												
						";
						
						$query = mysql_query($str) or die(mysql_error());
					}
				elseif($_GET["jenis"]!='0' and $_GET["jenis"] != '')
					{
						$str = "SELECT 
									a.* , b.nama , b.alamat as alamat_usaha , c.jenis 
								FROM
									tbl_info_berkas a 
								LEFT JOIN vw_dinsos b ON a.id_perusahaan = b.id_perusahaan 
								LEFT JOIN tbl_jenis_pengurusan c ON a.jenis_pengurusan = c.kode 
                                WHERE 
									a.jenis_pengurusan='".$_GET["jenis"]."'  
										
						";
						
						$query = mysql_query($str) or die(mysql_error());
					}
					else
					{
						$str = "SELECT 
									a.* , b.nama , b.alamat as alamat_usaha , c.jenis 
								FROM
									tbl_info_berkas a 
								LEFT JOIN vw_dinsos b ON a.id_perusahaan = b.id_perusahaan 
								LEFT JOIN tbl_jenis_pengurusan c ON a.jenis_pengurusan = c.kode 
												
						";
						
						$query = mysql_query($str) or die(mysql_error());
					}		
		 
	//$t=mysql_fetch_array($qtotal);
	$i = 1;
	while($m1 = mysql_fetch_array($query))
	{
	
		$worksheet1->write_string($i+4,1,$i,$fList);
		$worksheet1->write_string($i+4,2,$m1['no_resi'],$fList);
		$worksheet1->write_string($i+4,3,$m1['tgl_masuk'],$fList);
		$worksheet1->write_string($i+4,4,$m1['jenis'],$fList);
		$worksheet1->write_string($i+4,5,$m1['nama'],$fList);
		$worksheet1->write_string($i+4,6,$m1['pemohon'],$fList);
		$worksheet1->write_string($i+4,7,$m1['alamat_usaha'],$fList);
		$worksheet1->write_string($i+4,8,$m1['alamat_pemohon'],$fList);
		$i++;
	}
	$workbook->close();
}

?>
