<?php

	$tingkat1 = "";
	$tingkat2 = "S1";
	
	$mt1 = 2;
	$mb1 = 5;
	
	$mt2 = 0;
 	$mb2 = 0;
	
	if($tingkat1 == "SMA" && $tingkat2 == ""){
		$faktor = 0.5;
		
		$ct = $faktor * $mt1;
		$cb = $faktor * $mb1;
		$nt = 0;
		$nb = 0;
		
		if($ct < 1 && $ct >= 0){
			$nt = 1;
		}else if($ct > 1){
			$nt = ceil($ct);
		}
		
		if($cb < 1 && $cb >= 0){
			$nb = 1;
		}else if($cb > 1){
			$nb = ceil($cb);
		}
		
		$th1 = $mt1 + $nt;
		$bh1 = $mb1 + $nb;
		
	}else if($tingkat2 == "S1" && $tingkat1 == ""){
		$faktor = 1;
		
		$ct = $faktor * $mt1;
		$cb = $faktor * $mb1;
		$nt = 0;
		$nb = 0;
		
		if($ct < 1 && $ct >= 0){
			$nt = 1;
		}else if($ct > 1){
			$nt = ceil($ct);
		}
		
		if($cb < 1 && $cb >= 0){
			$nb = 1;
		}else if($cb > 1){
			$nb = ceil($cb);
		}
		
		$th1 = $mt1 + $nt;
		$bh1 = $mb1 + $nb + 5;
		
		if($bh1 > 12){
			$th1 += 1;
			$bh1 = abs(12 - $bh1);
		}
		
	}else if($tingkat1 == "SMA" && $tingkat2 == "S1"){
		$faktor = 1;
	}
	
	// Perhhitungan Selisih Masa kerja dalam tahun dan Bulan
	
	echo "Masa kerja lama ".$mt1." tahun ".$mb1." bulan<br/>";
	echo "Masa kerja baru ".$th1." tahun ".$bh1." bulan<br/>";
	
	echo "<br/><br/><br/>";
	$tgl1 = "2015-10-10";
	$tgl2 = "1992-08-21";
	
	$exp1 = explode('-', $tgl1);
	$exp2 = explode('-', $tgl2);
	
	$thn1 = $exp1[0];
	$bln1 = $exp1[1];
	
	$thn2 = $exp2[0];
	$bln2 = $exp2[1];
	
	$st1 = $thn1 - $thn2;
	if($st1 < 10 && $st1 > 0){
		$st1 = "0" . $st1;
	}
	
	if($bln1 < $bln2){
		$sb1 = "00";
	}else{
		$sb1 = $bln1 - $bln2;
		if($sb1 > 0 && $sb1 < 10){
			$sb1 = "0" . $sb1;
		}else{
			$sb1 = $sb1;
		}
	}
	
	echo "Tahun 1 : ".$tgl1."<br/>";
	echo "Tahun 2 : ".$tgl2."<br/>";
	echo "Selisih Tahun : ".$st1." ".$sb1;
	
	
	
	