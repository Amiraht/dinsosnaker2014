<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once '../../../php/excel_reader2.php';

if(isset($_GET['filename'])){
	$regex = array("@", "'" , "`", "#", "*", "%", "^", "!");
	$filename = str_replace($regex,'',$_GET['filename']); 
}

$DIR = "../../../sys_files/scan_sk_kenpang/" . $filename;

$data = new Spreadsheet_Excel_Reader($DIR);

?>
<html>
<head>
<style type="text/css">
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
</style>
</head>

<body>
<?php
	echo "DATA BERHASIL TERSIMPAN KE DALAM DATABASE<br/>";
	echo "STATISTIK DATA FILE<br/>";
	echo "=============================<br/>";
	echo "Jumlah Baris  : ". $data->rowcount(0)."<br/>";
	echo "Jumlah Kolom  : ". $data->colcount(0)."<br/><br/>";
	echo "<table border='1' cellpadding='3' cellspacing='1' style='width:100%;'>";
	echo "<tr>";
	echo "<td>No</td>";
	echo "<td>No Persetujuan BKN</td>";
	echo "<td>TGL Persetujuan BKN</td>";
	echo "<td>NIP</td>";
	echo "<td>Pendidikan</td>";
	echo "<td>TMT Lama</td>";
	echo "<td>MKG Lama (Tahun)</td>";
	echo "<td>MKG Lama (Bulan)</td>";
	echo "<td>Gaji Pokok Lama</td>";
	echo "<td>Jabatan</td>";
	echo "<td>TMT Baru</td>";
	echo "<td>MKG Baru (Tahun)</td>";
	echo "<td>MKG Baru (Bulan)</td>";
	echo "<td>Unit Kerja / SKPD</td>";
	echo "<td>No SK</td>";
	echo "<td>Tgl SK</td>";
	echo "</tr>";
	
	for($i=5; $i <= $data->rowcount(0); $i++){
		// Cek Jika Pada Suatu Baris Nilainya Kosong atau Tidak
		if($data->value($i,1,0) != ""){
			echo "<tr>";		
			echo "<td>".$data->value($i,1,0)."</td>";
			echo "<td>".$data->value($i,2,0)."</td>";
		    echo "<td>".$data->value($i,3,0)."</td>";
			echo "<td>".$data->value($i,5,0)."</td>";
			echo "<td>".$data->value($i,6,0)."</td>";
			echo "<td>".$data->value($i,8,0)."</td>";
			echo "<td>".$data->value($i,9,0)."</td>";
			echo "<td>".$data->value($i,10,0)."</td>";
			echo "<td>".$data->value($i,11,0)."</td>";
			echo "<td>".$data->value($i,12,0)."</td>";
			echo "<td>".$data->value($i,14,0)."</td>";
			echo "<td>".$data->value($i,15,0)."</td>";
			echo "<td>".$data->value($i,16,0)."</td>";
			echo "<td>".$data->value($i,19,0)."</td>";
			echo "<td>".$data->value($i,21,0)."</td>";
			echo "<td>".$data->value($i,22,0)."</td>";
		    echo "</tr>";
		}			
	}
	echo "</table>";
	
?>
<?php //echo $data->dump(true,true); ?>
</body>
</html>
