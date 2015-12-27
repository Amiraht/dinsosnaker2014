<?php

	error_reporting(E_ALL ^ E_NOTICE);
	include "../../../libraries/dinsos.php";
	require_once('../../../libraries/excel-lib/OLEwriter.php');	
	require_once('../../../libraries/excel-lib/BIFFwriter.php');
	require_once('../../../libraries/excel-lib/Worksheet.php');
	require_once('../../../libraries/excel-lib/Workbook.php');
	
	$filter = "db_jamsostek.nama IS NULL AND result.nama LIKE '%" . $_GET["cari"] . "%' ";
	if(isset($_GET["sumber"]) && $_GET["sumber"] != "0")
		$filter .= "AND result.sumber = '" . $_GET["sumber"] . "'";
	if(isset($_GET["jenis"]) && $_GET["jenis"] != "0")
		$filter .= "AND result.jenis = '" . $_GET["jenis"] . "'";
	if(isset($_GET["kec"]) && $_GET["kec"] != "0")
		$filter .= "AND result.kec = '" . $_GET["kec"] . "'";
	if(isset($_GET["kel"]) && $_GET["kel"] != "0")
		$filter .= "AND result.kel = '" . $_GET["kel"] . "'";	

	$posisi=$_GET["posisi"];
	$batas=$_GET["lim"];
	

	$query = "SELECT result.id_perusahaan, result.nama, result.alamat, result.jenis,result.kec,result.kel, result.sumber,result.telepon,result.nama_kec,result.nama_kel
									FROM 
									(
										(
										SELECT
											a.id_perusahaan, a.nama, a.alamat, a_ju.jenis,kec,kel, 'DINSOSNAKER' AS sumber,telpon as telepon,a_k.kecamatan as nama_kec, a_kel.kelurahan as nama_kel
										FROM
											db_dinsos a
											LEFT JOIN t_jenis_usaha a_ju ON a.jenis_usaha = a_ju.id_jenis_usaha
											LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
											LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan											
										ORDER BY
											a.nama ASC
										)
										UNION
										(
										SELECT
											b.id as id_perusahaan , b.nama, b.alamat, c.jenis,b.kecamatan,b.kelurahan, 'BPPT' AS sumber,notelp as telepon,a_k.kecamatan as nama_kec, a_kel.kelurahan as nama_kel
										FROM
											bppt b
											LEFT JOIN t_jenis_usaha c ON b.bentuk_badan = c.id_jenis_usaha
											LEFT JOIN t_kecamatan a_k ON b.kecamatan = a_k.id_kecamatan
									  		LEFT JOIN t_kelurahan a_kel ON b.kelurahan = a_kel.id_kelurahan
										ORDER BY
											b.nama ASC
										)
									) AS result
									  LEFT JOIN db_jamsostek ON result.nama = db_jamsostek.nama
									  
									WHERE
										$filter
									GROUP BY
										result.nama
									ORDER BY
										result.nama
									LIMIT ".$posisi.",".$batas."";
							

	
	function HeaderingExcel($filename)
	{
    	header("Content-type:application/vnd.ms-excel");
    	header("Content-Disposition:attachment;filename=$filename");
    	header("Expires:0");
    	header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
    	header("Pragma: public");
	}
	
	HeaderingExcel('Daftar_perusahaan.xls');
	
	$workbook=new Workbook("-");
	
	$worksheet =& $workbook->add_worksheet("Sheet ");

	$a =& $workbook->add_format();
	$a->set_size(14);
	$a->set_bold();
	$a->set_align('center');

	$b =& $workbook->add_format();
	$b->set_border(1);
	$b->set_pattern();
	$b->set_fg_color('cyan');

	$c =& $workbook->add_format();
	$c->set_border(1);

	$worksheet->write_string(0,0, "Tabel Data Perusahaan",$a);
	//$worksheet->write_string(0,0,$query,$a);
	$worksheet->merge_cells(0,0, 0,21);

	$worksheet->write_string(2,0, "No",$b);
	$worksheet->write_string(2,1, "Nama Perusahaan",$b);
	$worksheet->write_string(2,2, "Alamat",$b);
	$worksheet->write_string(2,3, "Jenis",$b);
	$worksheet->write_string(2,4, "Kecamatan",$b);
	$worksheet->write_string(2,5, "Kelurahan",$b);
	$worksheet->write_string(2,6, "Sumber",$b);
	$worksheet->write_string(2,7, "Telepon",$b);
	
	$result = mysql_query($query);
	$i=4;
	$x=1;
	$row = mysql_num_rows ($result);	

	while($data=mysql_fetch_array($result))
	{
		$j=0;
		
		while($j<3)
		{
			$worksheet->write_string($i,$j,$x,$c);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[1],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[2],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[3],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[8],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[9],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[6],$b);
			$j = $j + 1;		
			$worksheet->write_string($i,$j, $data[7],$b);
			$j = $j + 1;					
			}
		$i= $i + 1;
		$x++;

	}	
	

	$workbook->close();


?>