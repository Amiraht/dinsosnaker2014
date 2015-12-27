<?php
	/******************************************************************************																			  
	/*	File : Function.php														  *
	/*	Description : Berisi kumpulan fungsi-fungsi yang berguna pada sistem	  *
	/******************************************************************************/
	
	// fungsi untuk membuka koneksi ke host database
	function openConnection(){
		
		$koneksi = mysql_connect("localhost","root","");
	}
	
	// fungsi untuk memilih database
	function select_db($db){
		$select = mysql_select_db($db) or die(mysql_error());
	}
	
	function insertPegawaiToSimpeg($id_pegawai, $nip, $nama, $id_unit, $id_pangkat, $alamat){
		
		// call open connection class
		openConnection();
		
		// call select the database name
		select_db("simpeg_dinsos");
		
		$sql = "INSERT INTO tbl_pegawai(id_pegawai, nip, nama_pegawai, id_status_kepegawaian, id_jenis_kepegawaian, id_kedudukan_kepegawaian, 
					id_satuan_organisasi, id_pangkat, alamat) 
				VALUES('". $id_pegawai ."', '". $nip ."', '". $nama ."', '4', '4', '1', '". $id_unit ."', '". $id_pangkat ."','". $alamat ."')";
				
		mysql_query($sql) or die(mysql_error());		
	}
	
	function insertPegawai($id_pegawai, $nip, $nama, $id_unit, $id_pangkat, $alamat){
		
		// call open connection class
		openConnection();
		
		// call select the database name
		select_db("db_disnakersos");
		
		$sql = "INSERT INTO tbl_pegawai(id_pegawai, nip, nama_pegawai, id_status_kepegawaian, id_jenis_kepegawaian, id_kedudukan_kepegawaian, 
					id_satuan_organisasi, id_pangkat, alamat) 
				VALUES('". $id_pegawai ."', '". $nip ."', '". $nama ."', '4', '4', '1', '". $id_unit ."', '". $id_pangkat ."','". $alamat ."')";
				
		mysql_query($sql) or die(mysql_error());		
	}
	
	// untuk melakukan editing data pegawai
	function editPegawai($id_pegawai, $nip, $nama, $id_unit, $id_pangkat, $alamat){
		openConnection();
		select_db("db_disnakersos");
		
		$sql = "UPDATE tbl_pegawai SET nip = '". $nip ."', nama_pegawai = '". $nama ."', id_satuan_organisasi = '". $id_unit ."', 
				id_pangkat = '". $id_pangkat ."', alamat = '". $alamat ."' WHERE id_pegawai = '". $id_pegawai ."'";
		
		mysql_query($sql) or die(mysql_error());		
	}
	
	// fungsi untuk mengeset id pegawai
	function setIdPegawai(){
		openConnection();
		
		select_db("db_disnakersos");
		
		$sql = "SELECT MAX(id_pegawai) as 'maks' FROM tbl_pegawai";
		$query = mysql_query($sql) or die(mysql_error());
		$dt = mysql_fetch_array($query);
		$id = "";
		$maks = $dt["maks"];
		if($maks <= 0){
			$id = 1;
		}else{
			$id = (int) ($maks + 1);
		}
		
		return $id;
	}
	
	// fungsi untuk mengeset id pegawai pada database simpeg dinsos
	function setIdPegawaiSimpegDinsos(){
		openConnection();
		
		select_db("simpeg_dinsos");
		$sql = "SELECT MAX(id_pegawai) as 'maks' FROM tbl_pegawai";
		$query = mysql_query($sql) or die(mysql_error());
		$dt = mysql_fetch_array($query);
		$id = "";
		$maks = $dt["maks"];
		if($maks <= 0){
			$id = 1;
		}else{
			$id = (int) ($maks + 1);
		}
		
		return $id;
	}
	
	// fungsi untuk menentukan id skpd berdasarkan kode skpd 
	function id_skpd($kode){
		openConnection();
		select_db("db_disnakersos");
		$sql = "SELECT id_skpd FROM ref_skpd WHERE kode_skpd = '". $kode ."'";
		$query = mysql_query($sql) or die(mysql_error());
		$dt = mysql_fetch_array($query);
		
		return $dt["id_skpd"];
	}
	