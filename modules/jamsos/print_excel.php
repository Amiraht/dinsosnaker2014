<?php

	error_reporting(E_ALL ^ E_NOTICE);
	include "../../../libraries/dinsos.php";
	require_once('../../../libraries/excel-lib/OLEwriter.php');	
	require_once('../../../libraries/excel-lib/BIFFwriter.php');
	require_once('../../../libraries/excel-lib/Worksheet.php');
	require_once('../../../libraries/excel-lib/Workbook.php');
	
	$abc="";

	if(!empty($_GET["id"]))
	{
		$add = $_GET["id"];
		$query = "SELECT
									a.id_perusahaan, a.nama, a.alamat,
									a_k.kecamatan, a_kel.kelurahan,
									a.telpon, a.kode_pos, a.klui,
									a.nomor_akte,a.tgl_pendirian, 
									a_j.jenis, a_s.status,
									a.nama_pemilik, a.nama_pengurus,
									a.alamat_pemilik, a.alamat_pengurus,a_m.status,a_mod.modal,
									a_tbl.wnilk, a_tbl.wnipr, a_tbl.wnalk, a_tbl.wnapr
								FROM
									db_dinsos a
									LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
									LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
									LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.id_status
									LEFT JOIN t_status a_s ON a.id_status_perusahaan = a_s.id_status
									LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
									LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan
									LEFT JOIN tbl_tenagakerja_jamsos a_tbl ON a.id_perusahaan = a_tbl.id_perusahaan 
								WHERE
									a.id_perusahaan = $add
								";
		$abc = "1";
	}else
	{
		$query = "
					SELECT
									a.id_perusahaan, a.nama, a.alamat,
									a_k.kecamatan, a_kel.kelurahan,
									a.telpon, a.kode_pos, a.klui,
									a.nomor_akte,a.tgl_pendirian, 
									a_j.jenis, a_s.status,
									a.nama_pemilik, a.nama_pengurus,
									a.alamat_pemilik, a.alamat_pengurus,a_m.status,a_mod.modal,
									a_tbl.wnilk, a_tbl.wnipr, a_tbl.wnalk, a_tbl.wnapr
								FROM
									db_dinsos a
									LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
									LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
									LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.id_status
									LEFT JOIN t_status a_s ON a.id_status_perusahaan = a_s.id_status
									LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
									LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan
									LEFT JOIN tbl_tenagakerja_jamsos a_tbl ON a.id_perusahaan = a_tbl.id_perusahaan 
		
		";
	}
	
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
	$a->set_size(10);
	$a->set_bold();
	$a->set_align('center');

	$b =& $workbook->add_format();
	$b->set_border(1);
	$b->set_bold();
	$b->set_pattern();
	$b->set_fg_color('yellow');

	$c =& $workbook->add_format();
	$c->set_border(1);

	$worksheet->write_string(0,0, "Tabel Data Perusahaan",$a);
	$worksheet->merge_cells(0,0, 0,12);

	$worksheet->write_string(1,0, "No",$b);
	$worksheet->write_string(1,1, "Nama Perusahaan",$b);
	$worksheet->write_string(1,2, "Alamat",$b);
	$worksheet->write_string(1,3, "Telepon",$b);
	$worksheet->write_string(1,4, "Kode Pos",$b);
	$worksheet->write_string(1,5, "Jenis Usaha",$b);
	$worksheet->write_string(1,6, "Nama Pemilik",$b);
	$worksheet->write_string(1,7, "Alamat Pemilik",$b);
	$worksheet->write_string(1,8, "Nama Pengurus",$b);
	$worksheet->write_string(1,9, "Nama Pengurus",$b);
	$worksheet->write_string(1,10, "Tanggal Pendirian",$b);
	$worksheet->write_string(1,11, "Nomor AKTE",$b);
	$worksheet->write_string(1,12, "KLUI",$b);

	
	$result = mysql_query($query);
	$i=2;
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
			$worksheet->write_string($i,$j, $data[4],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[5],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[6],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[7],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[8],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[9],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[10],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[11],$b);
			$j = $j + 1;
	
			}
		$i= $i + 1;
		$x++;

	}
	
	if(!empty($abc))
	{
		$worksheet->write_string(13,0, "Tabel Jumlah Tenaga Kerja",$a);
		$worksheet->merge_cells(13,0, 13,13);
		$worksheet->write_string(14,0, "Nama Perusahaan",$b);
		$worksheet->write_string(14,1, "WNI Laki-Laki",$b);
		$worksheet->write_string(14,2, "WNI Perempuan",$b);
		$worksheet->write_string(14,3, "WNA Laki-Laki",$b);
		$worksheet->write_string(14,4, "WNA Perempuan",$b);
		
		$tenagakerja = mysql_query("select b.nama, a.wnilk, a.wnipr, a.wnalk, a.wnapr from tbl_tenagakerja a inner join db_jamsostek b on a.id_perusahaan=b.id_perusahaan where a.id_perusahaan='".$_GET['id']."'");
		$i=15;
		while($hasil=mysql_fetch_array($tenagakerja))
		{
		
				$j=0;
				while($j<3)
				{
					$worksheet->write_string($i,$j, $hasil[0],$b);
					$j = $j + 1;
					$worksheet->write_string($i,$j, $hasil[1],$b);
					$j = $j + 1;
					$worksheet->write_string($i,$j, $hasil[2],$b);
					$j = $j + 1;
					$worksheet->write_string($i,$j, $hasil[3],$b);
					$j = $j + 1;
					$worksheet->write_string($i,$j, $hasil[4],$b);
					$j = $j + 1;			
					}
				$i= $i + 1;		
		}
	}

	$workbook->close();


?>