<?php
/*=============================================*/
		 $conn = mysqli_connect("localhost", "root", "", "db_disnakersos");
			include "./libraries/dinsos.php";
		
		#action get kelurahan
		if(isset($_GET['action']) && $_GET['action'] == "getKab") {
			
			$kode_prop = $_GET['kode_prop'];
		 
			//ambil data kelurahan
			$query = "SELECT '0' as id_kelurahan,'-' AS kelurahan UNION 
			SELECT id_kelurahan, kelurahan FROM t_kelurahan WHERE id_kecamatan='$kode_prop' ORDER BY kelurahan";
			$sql = mysqli_query($conn, $query);
			$arrkab = array();
			while ($row = mysqli_fetch_assoc($sql)) {
				array_push($arrkab, $row);
			}
			echo json_encode($arrkab);
			exit;
		
		}

?>
		
		