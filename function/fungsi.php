<?php

	function tglindonesia($tgl){
		$dt = explode('-', $tgl);
		$tgl = $dt[2]."-".$dt[1]."-".$dt[0];
		
		return $tgl;
	}