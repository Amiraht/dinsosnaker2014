<?php
	if($_GET["jenis"] == 'laporan')
		$file='../file_lap/'.$_GET["path"];
		
	if(!is_readable($file)) die('File not found or inaccessible!');
	
	$size = filesize($file);

	if(ini_get('zlib.output_compression'))
  	{
  		ini_set('zlib.output_compression', 'Off');
	}
	
	header('Content-Type: application/force-download');
 	header('Content-Disposition: attachment; filename="'.$_GET["path"].'"');
 	header("Content-Transfer-Encoding: binary");
 	header('Accept-Ranges: bytes');
	
	header("Cache-control: private");
	header('Pragma: private');

	if(isset($_SERVER['HTTP_RANGE']))
 	{
		list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
		list($range) = explode(",",$range,2);
		list($range, $range_end) = explode("-", $range);
		$range=intval($range);
		if(!$range_end) 
		{
			$range_end=$size-1;
		}else 
		{
			$range_end=intval($range_end);
		}
 
		$new_length = $range_end-$range+1;
		header("HTTP/1.1 206 Partial Content");
		header("Content-Length: $new_length");
		header("Content-Range: bytes $range-$range_end/$size");
 	}else 
	{
		$new_length=$size;
		header("Content-Length: ".$size);
 	}
	
	$chunksize = 1*(1024*1024); //you may want to change this
 	$bytes_send = 0;
 	if ($file = fopen($file, 'r'))
 	{
		if(isset($_SERVER['HTTP_RANGE']))
		{
			fseek($file, $range);
 		}
		while(!feof($file) && (!connection_aborted()) && ($bytes_send<$new_length))
		{
			$buffer = fread($file, $chunksize);
			print($buffer); //echo($buffer); // is also possible
			flush();
			$bytes_send += strlen($buffer);
		}
 		fclose($file);
 	}elseif($_GET["jenis"] == 'foto')
		$file='../upload/'.$_GET["path"];
		
	if(!is_readable($file)) die('File not found or inaccessible!');
	
	$size = filesize($file);

	if(ini_get('zlib.output_compression'))
  	{
  		ini_set('zlib.output_compression', 'Off');
	}
	
	header('Content-Type: application/force-download');
 	header('Content-Disposition: attachment; filename="'.$_GET["path"].'"');
 	header("Content-Transfer-Encoding: binary");
 	header('Accept-Ranges: bytes');
	
	header("Cache-control: private");
	header('Pragma: private');

	if(isset($_SERVER['HTTP_RANGE']))
 	{
		list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
		list($range) = explode(",",$range,2);
		list($range, $range_end) = explode("-", $range);
		$range=intval($range);
		if(!$range_end) 
		{
			$range_end=$size-1;
		}else 
		{
			$range_end=intval($range_end);
		}
 
		$new_length = $range_end-$range+1;
		header("HTTP/1.1 206 Partial Content");
		header("Content-Length: $new_length");
		header("Content-Range: bytes $range-$range_end/$size");
 	}else 
	{
		$new_length=$size;
		header("Content-Length: ".$size);
 	}
	
	$chunksize = 1*(1024*1024); //you may want to change this
 	$bytes_send = 0;
 	if ($file = fopen($file, 'r'))
 	{
		if(isset($_SERVER['HTTP_RANGE']))
		{
			fseek($file, $range);
 		}
		while(!feof($file) && (!connection_aborted()) && ($bytes_send<$new_length))
		{
			$buffer = fread($file, $chunksize);
			print($buffer); //echo($buffer); // is also possible
			flush();
			$bytes_send += strlen($buffer);
		}
 		fclose($file);
 	}else
	
	{
		die('Error - can not open file.');
 	}
	die();
?>