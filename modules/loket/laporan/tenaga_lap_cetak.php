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
	
	HeaderingExcel('Laporan_tenaga_kerja.xls');
	
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
	$worksheet1->write_string(2,1,"Laporan Tenaga Kerja",$fBesar);
	//$worksheet1->write_string(3,1,"Mulai : ".$_GET["tgl1"]." s.d ".$_GET["tgl2"],$fBesar);
	
	for ($i=2;$i<=8;$i++)
	{
		$worksheet1->write_blank(2,$i,$fBesar);
	}
	
	$worksheet1->write_string(4,1,"No",$fList_title);
	$worksheet1->write_string(4,2,"Nama Perusahaan",$fList_title);
	$worksheet1->write_string(4,3,"Alamat",$fList_title);
	$worksheet1->write_string(4,4,"WNI Pria",$fList_title);
	$worksheet1->write_string(4,5,"WNI Wanita",$fList_title);
	$worksheet1->write_string(4,6,"WNA Pria",$fList_title);
	$worksheet1->write_string(4,7,"WNA Wanita",$fList_title);
	
		
	//tabel content======================================================================================
	
	if(!empty($_GET["cari"]) || !empty($_GET["alamat"]))
	{
		$up = '';
		$ada = 1;	
		if(!empty($_GET["cari"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." nama like '%".$_GET["cari"]."%'";
			$ada++;
		}
		if(!empty($_GET["alamat"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." alamat like '%".$_GET["alamat"]."%'";
			$ada++;
		}		
	}
		
	if(!empty($_GET["cari"]) || !empty($_GET["alamat"]))
	{
		$query = mysql_query("select id_perusahaan,nama,alamat from db_dinsos where id_perusahaan is not null and ".$up."");
	}
	else
	{						
		$query = mysql_query("select id_perusahaan,nama,alamat from db_dinsos where id_perusahaan is not null");
	}		
		 
	//$t=mysql_fetch_array($qtotal);
	$i = 1;
	while($m1 = mysql_fetch_row($query))
	{
		$c = mysql_query("select * from tbl_tenagakerja_dinsos where id_perusahaan='".$m1[0]."' order by id_jlh desc limit 0,1");
		$c1 = mysql_fetch_array($c);
		
		$jlh_wnilk= $c1["wnilk"];
		$jlh_wnipr= $c1["wnipr"];
		$jlh_wnalk= $c1["wnalk"];
		$jlh_wnapr= $c1["wnapr"];	
	
		$worksheet1->write_string($i+4,1,$i,$fList);
		$worksheet1->write_string($i+4,2,$m1[1],$fList);
		$worksheet1->write_string($i+4,3,$m1[2],$fList);
		$worksheet1->write_string($i+4,4,number_format($jlh_wnilk),$fList);
		$worksheet1->write_string($i+4,5,number_format($jlh_wnipr),$fList);
		$worksheet1->write_string($i+4,6,number_format($jlh_wnalk),$fList);
		$worksheet1->write_string($i+4,7,number_format($jlh_wnapr),$fList);
		$i++;
	}
	$workbook->close();
}

?>
