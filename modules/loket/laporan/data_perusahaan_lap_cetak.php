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
	
	HeaderingExcel('data_perusahaan.xls');
	
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
	$worksheet1->write_string(2,1,"LAPORAN DATA PERUSAHAAN",$fBesar);
	//$worksheet1->write_string(3,1,"Mulai : ".$_GET["tgl1"]." s.d ".$_GET["tgl2"],$fBesar);
	
	for ($i=2;$i<=8;$i++)
	{
		$worksheet1->write_blank(2,$i,$fBesar);
	}
	
	$worksheet1->write_string(4,1,"No",$fList_title);
	$worksheet1->write_string(4,2,"Nama",$fList_title);
	$worksheet1->write_string(4,3,"Jenis",$fList_title);
	$worksheet1->write_string(4,4,"KLUI",$fList_title);
	$worksheet1->write_string(4,5,"Alamat",$fList_title);

		
	//tabel content======================================================================================
	
	
 	if(!empty($_GET["tgl"]) || !empty($_GET["nama"]) || !empty($_GET["klui"]) || !empty($_GET["jenis"]) || !empty($_GET["stat_milik"]) || !empty($_GET["stat_modal"])  || !empty($_GET["stat_usaha"]) || !empty($_GET["kecamatan"]) || !empty($_GET["kelurahan"])) 
	{
		$up = '';
		$ada = 1;
		if(!empty($_GET["tgl"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." tgl_pendirian ='".$_GET["tgl1"]."'";
			$ada++;
		}

		if(!empty($_GET["nama"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." nama like '%".$_GET["nama"]."%'";
			$ada++;
		}
		if(!empty($_GET["klui"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." klui='".$_GET["klui"]."'";
			$ada++;
		}
		if(!empty($_GET["jenis"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." jenis_usaha like '%".$_GET["jenis"]."%'";
			$ada++;
		}
		if(!empty($_GET["stat_milik"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." id_status_pemilik like '%".$_GET["stat_milik"]."%'";
			$ada++;
		}
		if(!empty($_GET["stat_modal"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." id_status_permodalan like '%".$_GET["stat_modal"]."%'";
			$ada++;
		}
		if(!empty($_GET["stat_usaha"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." id_status_perusahaan like '%".$_GET["stat_usaha"]."%'";
			$ada++;
		}
		if(!empty($_GET["kelurahan"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." kel like '%".$_GET["kelurahan"]."%'";
			$ada++;
		}
		if(!empty($_GET["kecamatan"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." kec like '%".$_GET["kecamatan"]."%'";
			$ada++;
		}										

	}
	
	
	if(!empty($_GET["tgl"]) || !empty($_GET["nama"]) || !empty($_GET["klui"]) || !empty($_GET["jenis"]) || !empty($_GET["stat_milik"]) || !empty($_GET["stat_modal"]) || !empty($_GET["stat_usaha"]) || !empty($_GET["kecamatan"]) || !empty($_GET["kelurahan"])) 
	{
		$query = mysql_query("select id_perusahaan,nama,jenis,klui,alamat,nama_bagian from vw_dinsos where id_perusahaan  is not null and ".$up." order by nama ");
	}
	else
		$query = mysql_query("select id_perusahaan,nama,jenis,klui,alamat,nama_bagian from vw_dinsos order by nama ");		
		 
	//$t=mysql_fetch_array($qtotal);
	$i = 1;
	while($m1 = mysql_fetch_row($query))
	{
	
		$worksheet1->write_string($i+4,1,$i,$fList);
		$worksheet1->write_string($i+4,2,$m1[1],$fList);
		$worksheet1->write_string($i+4,3,$m1[2],$fList);
		$worksheet1->write_string($i+4,4,$m1[3]."-".$m1[5],$fList);
		$worksheet1->write_string($i+4,5,$m1[4],$fList);
		$i++;
	}
	$workbook->close();
}

?>
