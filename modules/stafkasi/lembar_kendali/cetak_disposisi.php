<?php
define('_FCEE_EXEC', '1');
require_once('../../../libraries/dinsos.php');
$resi = $_GET["link"];
	function HeaderingExcel($filename)
	{
    	header("Content-type:application/vnd.ms-excel");
    	header("Content-Disposition:attachment;filename=$filename");
    	header("Expires:0");
    	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
    	header("Pragma: public");
	}
	
	HeaderingExcel('LEMBAR_KENDALI.xls');
	
	require_once('../../../libraries/excel-lib/OLEwriter.php');	
	require_once('../../../libraries/excel-lib/BIFFwriter.php');
	require_once('../../../libraries/excel-lib/Worksheet.php');
	require_once('../../../libraries/excel-lib/Workbook.php');		
	
	
	$workbook=new Workbook("-");
	
	$fJudul=& $workbook->add_format();
	$fJudul->set_bold();
	

	$fList=& $workbook->add_format();
	$fList->set_border(2);
	
	$fList_title=& $workbook->add_format();
	$fList_title->set_border(2);
	$fList_title->set_bold();
	$fList_title->set_merge();
		
	$fBesar=& $workbook->add_format();
	$fBesar->set_bold();
	$fBesar->set_italic();
	
	$worksheet1 =& $workbook->add_worksheet("Sheet 1");
	/*
	$worksheet1->set_column(1,1,5);
	
	
	for ($i=2;$i<8;$i++)
	{
		$worksheet1->set_column(1,$i,15);
	}
	
	$worksheet1->set_column(1,8,20);
	*/
	//$worksheet1->merge_cells(1,1,2,8);
	$worksheet1->write_string(2,1,"LEMBAR KENDALI",$fBesar);
	$worksheet1->write_string(3,1,"NO. RESI : ".$resi,$fBesar);
	
	for ($i=2;$i<=8;$i++)
	{
		$worksheet1->write_blank(2,$i,$fBesar);
	}
	
	$worksheet1->write_string(5,1,"Tanggal",$fList_title);
	$worksheet1->write_string(5,2,"Dari",$fList_title);
	$worksheet1->write_string(5,3,"Level",$fList_title);
	$worksheet1->write_string(5,4,"Kepada",$fList_title);
	$worksheet1->write_string(5,5,"Level",$fList_title);
	$worksheet1->write_string(5,6,"Pesan",$fList_title);
		
	//tabel content======================================================================================
	$i=1;
	$d = mysql_query("select * from tbl_info_disposisi where no_resi='".$resi."'");
	while($d1 = mysql_fetch_array($d))
	{
		$dari=$d1["dari"];
		$nmpri=mysql_query("select nama from user where id_user='".$dari."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$dari_nama=$rnmpri["nama"];
		
		$dari_lev=$d1["dari_level"];
		$nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$dari_lev."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$dari_level=$rnmpri["nama_level"];
		
		
		$tujuan=$d1["tujuan"];
		$nmpri=mysql_query("select nama from user where id_user='".$tujuan."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$tujuan_nama=$rnmpri["nama"];
		
		$tujuan_lev=$d1["tujuan_level"];
		$nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$tujuan_lev."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$tujuan_level=$rnmpri["nama_level"];
		//$nmpri=mysql_query("select level from user where id_user='$tujuan'");
		//$rnmpri = mysql_fetch_array($nmpri);
		//$tujuan_level=$rnmpri["level"];
		
		$worksheet1->write_string(5+$i,1,$d1["tgl"],$fList_title);
		$worksheet1->write_string(5+$i,2,$dari_nama,$fList_title);
		$worksheet1->write_string(5+$i,3,$dari_level,$fList_title);
	    $worksheet1->write_string(5+$i,4,$tujuan_nama,$fList_title);
		$worksheet1->write_string(5+$i,5,$tujuan_level,$fList_title);
		$worksheet1->write_string(5+$i,6,$d1["pesan"],$fList_title);
		
		$i++;
	}
	 
	$workbook->close();


?>


