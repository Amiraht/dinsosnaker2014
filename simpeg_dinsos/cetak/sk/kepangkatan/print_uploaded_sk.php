<?php
error_reporting(E_ALL ^ E_NOTICE);
//include "../../../php/koneksi.php";
//include "../../../php/fungsi.php";
include "../../../php/mysqli_connect.php";
require_once '../../../php/excel_reader2.php';

$id_file = $con->real_escape_string($_GET['id_file']);

/* GET FILE NAME FROM DATABASE*/
$sql = "SELECT filename FROM tbl_scan_sk_kenpang WHERE id_files = '".$id_file."'";
$st = $con->query($sql);
$ft = $st->fetch_assoc();
$st->close();

$filename = $ft['filename'];

$DIR = "../../../sys_files/scan_sk_kenpang/" . $filename;
	if(!file_exists($DIR)){
		echo "Maaf, file tidak ada, sehingga tidak dapat dibaca<br/>";
	}
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
<?php echo $data->dump(true,true); ?>
</body>
</html>