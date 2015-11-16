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
									a.id_perusahaan = $add";
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
	$worksheet->merge_cells(0,0, 0,21);

	$worksheet->write_string(2,0, "No",$b);
	$worksheet->write_string(2,1, "Nama Perusahaan",$b);
	$worksheet->write_string(2,2, "Alamat",$b);
	$worksheet->write_string(2,3, "Kecamatan",$b);
	$worksheet->write_string(2,4, "Kelurahan",$b);
	$worksheet->write_string(2,6, "Telepon",$b);
	$worksheet->write_string(2,5, "KLUI",$b);
	$worksheet->write_string(2,7, "Kode Pos",$b);
	$worksheet->write_string(2,8, "Nomor AKTE",$b);
	$worksheet->write_string(2,9, "Tanggal Pendirian",$b);
	$worksheet->write_string(2,10, "Jenis Usaha",$b);
	$worksheet->write_string(2,11, "Status Perusahaan",$b);
	$worksheet->write_string(2,12, "Nama Pemilik",$b);
	$worksheet->write_string(2,14, "Alamat Pemilik",$b);
	$worksheet->write_string(2,13, "Nama Pengurus",$b);
	$worksheet->write_string(2,15, "Alamat Pengurus",$b);
	$worksheet->write_string(2,16, "Status Usaha",$b);
	$worksheet->write_string(2,17, "Status Modal",$b);
	$worksheet->write_string(2,18, "Tenaga Kerja Pria",$b);
	$worksheet->write_string(2,19, "Tenaga Wanita",$b);
	$worksheet->write_string(2,20, "Tenaga Kerja Asing Pria ",$b);
	$worksheet->write_string(2,21, "Tenaga Kerja Asing Wanita",$b);

	
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
			$worksheet->write_string($i,$j, $data[12],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[13],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[14],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[15],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[16],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[17],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[18],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[19],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[20],$b);
			$j = $j + 1;
			$worksheet->write_string($i,$j, $data[21],$b);
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