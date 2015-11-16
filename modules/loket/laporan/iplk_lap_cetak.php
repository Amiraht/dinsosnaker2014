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
	
	HeaderingExcel('Laporan_iplk.xls');
	
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
	$worksheet1->write_string(2,1,"LAPORAN IPLK",$fBesar);
	$worksheet1->write_string(3,1,"Mulai : ".$_GET["tgl1"]." s.d ".$_GET["tgl2"],$fBesar);
	
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
	
	
	if(!empty($_GET["tgl1"]) || !empty($_GET["tgl2"]) || !empty($_GET["cari"]) || !empty($_GET["no_resi"]) || !empty($_GET["pengurusan"]))
	{
		$up = '';
		$ada = 1;
		if(!empty($_GET["tgl1"]) || !empty($_GET["tgl2"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." tgl_masuk>='".$_GET["tgl1"]."' and tgl_masuk<='".$_GET["tgl2"]."' ";
			$ada++;
		}		
		if(!empty($_GET["cari"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." nama like '%".$_GET["cari"]."%'";
			$ada++;
		}
		if(!empty($_GET["no_resi"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." no_resi like '%".$_GET["no_resi"]."%'";
			$ada++;
		}
		if(!empty($_GET["pengurusan"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." id_pengurusan = '".$_GET["pengurusan"]."'";
			$ada++;
		}
	}
	
	if(!empty($_GET["tgl1"]) || !empty($_GET["tgl2"]) || !empty($_GET["cari"]) || !empty($_GET["no_resi"]) || !empty($_GET["pengurusan"]))
	{
		$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where id is not null and isDisposisi='0' and ".$up."");
	}
	else
	{						
		$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where id is not null and isDisposisi='0' and id_pengurusan in('06')");
	}	
		 
	//$t=mysql_fetch_array($qtotal);
	$i = 1;
	while($m1 = mysql_fetch_row($query))
	{
	
		$worksheet1->write_string($i+4,1,$i,$fList);
		$worksheet1->write_string($i+4,2,$m1[0],$fList);
		$worksheet1->write_string($i+4,3,$m1[1],$fList);
		$worksheet1->write_string($i+4,4,$m1[2],$fList);
		$worksheet1->write_string($i+4,5,$m1[3],$fList);
		$worksheet1->write_string($i+4,6,$m1[4],$fList);
		$worksheet1->write_string($i+4,7,$m1[5],$fList);
		$worksheet1->write_string($i+4,8,$m1[6],$fList);
		$i++;
	}
	$workbook->close();
}

?>
