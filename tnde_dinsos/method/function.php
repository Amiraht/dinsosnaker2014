<?php

	function setIDMaxSM(){
		
		
	}
	// open koneksi ke dalam database
	function openDatabase(){
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db_name = "tnde_dinsos";
	
		// set the conection object
		$con = new mysqli($host, $user, $pass, $db_name);
	}
	
	// fungsi untuk melakukan encoding pada URL yang akan di enkrip
	function encode_url($url){
		$string_phrase = 'kamianakmedancintadamaidanmengertiti';
		$gabung  = $url . "__" . $string_phrase;
		return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($gabung)))));
	}
	
	// fungsi untuk melakukan decrypt pada URL yang di enkrip
	function decode_url($encode_string){
		$decode = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($encode_string)))));
		$pecah = explode('__', $decode);
		$plaintext_url = $pecah[0];
		return $plaintext_url;
	}
	
	function tglindonesia($tgl){
		$dt = explode('-', $tgl);
		$tgl = $dt[2]."-".$dt[1]."-".$dt[0];
		
		return $tgl;
	}
	
	// fungs untuk menangani masalah injeksi pada input form
	function anti_injection($data){
		$data1 = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $data1;
	}
	