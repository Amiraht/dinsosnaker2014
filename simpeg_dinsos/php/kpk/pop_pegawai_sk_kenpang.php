<?php
	
	include "../mysqli_connect.php";

	$id_detail = $_GET['id_detail'];
	$id_sk = $_GET['id_sk'];
	
	
	$sql = "DELETE FROM tbl_sk_kenpang_detail WHERE id_detail = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id_detail);
	
	$query = $stm->execute();
	
	if($query){
		echo "
			<script>
				window.parent.sukses_pop();	
			</script>
		";
	}else{
		echo "
			<script>
				window.parent.gagal_pop();
			</script>
		";
	}
	