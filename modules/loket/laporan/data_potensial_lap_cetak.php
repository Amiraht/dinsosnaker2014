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
	
	HeaderingExcel('data_potensial.xls');
	
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
	$worksheet1->write_string(2,1,"LAPORAN DATA POTENSIAL",$fBesar);
	//$worksheet1->write_string(3,1,"Mulai : ".$_GET["tgl1"]." s.d ".$_GET["tgl2"],$fBesar);
	
	for ($i=2;$i<=8;$i++)
	{
		$worksheet1->write_blank(2,$i,$fBesar);
	}
	
	$worksheet1->write_string(4,1,"No",$fList_title);
	$worksheet1->write_string(4,2,"Nama",$fList_title);
	$worksheet1->write_string(4,3,"Alamat",$fList_title);
	$worksheet1->write_string(4,4,"Jenis",$fList_title);
	$worksheet1->write_string(4,5,"Sumber",$fList_title);

		
	//tabel content======================================================================================
	$batas = 50;
	if(empty($halaman))
	{
		$posisi = 0;
		$halaman = 1;
	}
	else
		$posisi = ($halaman - 1) * $batas;	
	
	$filter = "db_dinsos.nama IS NULL AND result.nama LIKE '%" . $_GET["cari"] . "%' ";
	if(isset($_GET["sumber"]) && $_GET["sumber"] != "0")
		$filter .= "AND result.sumber = '" . $_GET["sumber"] . "'";
	if(isset($_GET["jenis"]) && $_GET["jenis"] != "0")
		$filter .= "AND result.jenis = '" . $_GET["jenis"] . "'";
	if(isset($_GET["kec"]) && $_GET["kec"] != "0")
		$filter .= "AND result.kec = '" . $_GET["kec"] . "'";
	if(isset($_GET["kel"]) && $_GET["kel"] != "0")
		$filter .= "AND result.kel = '" . $_GET["kel"] . "'";	
		
		
	$sql = "SELECT result.id_perusahaan, result.nama, result.alamat, result.jenis,result.kec,result.kel, result.sumber
			FROM (
				(SELECT
					a.id_perusahaan, a.nama, a.alamat, a_ju.jenis, kec,kel, 'BPJS KETENAGAKERJAAN' AS sumber
				FROM
					db_jamsostek a
					LEFT JOIN t_jenis_usaha a_ju ON a.jenis_usaha = a_ju.id_jenis_usaha
				ORDER BY
					a.nama ASC)
				UNION
				(
				SELECT
					b.id as id_perusahaan , b.nama, b.alamat, c.jenis,kecamatan as kec,kelurahan as kel, 'BPPT' AS sumber
				FROM
					bppt b
					LEFT JOIN t_jenis_usaha c ON b.bentuk_badan = c.id_jenis_usaha
				ORDER BY
					b.nama ASC)
			) AS result
			  LEFT JOIN db_dinsos ON result.nama = db_dinsos.nama
			WHERE
				$filter
			GROUP BY
				result.nama
			ORDER BY
				result.nama
			LIMIT ".$posisi.", ".$batas."
	";		
	$query=mysql_query($sql);
	//$t=mysql_fetch_array($qtotal);
	$i = 1;
	while($m1 = mysql_fetch_row($query))
	{
	
		$worksheet1->write_string($i+4,1,$i,$fList);
		$worksheet1->write_string($i+4,2,$m1[1],$fList);
		$worksheet1->write_string($i+4,3,$m1[2],$fList);
		$worksheet1->write_string($i+4,4,$m1[3],$fList);
		$worksheet1->write_string($i+4,5,$m1[6],$fList);
		$i++;
	}
	$workbook->close();
}

?>
