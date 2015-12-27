<?php
	$latar_belakang = $_POST["latar_belakang"];
	$q8 = mysql_query("update tbl_latar_belakang set latar_belakang='".$latar_belakang."' where id_latar_belakang=1");
	
	if($q8)
	{
	?>
    	<script type="text/javascript">
			alert('Berhasil Mengubah Latar Belakang');
			parent.parent.document.location.href='./index.php?mod=cp&opt=latar_belakang&opts=view';
		</script>
    <?php
	}
	else
	{
	?>
    	<script type="text/javascript">
			alert('Gagal Mengubah Latar Belakang');
			parent.parent.document.location.href='./index.php?mod=cp&opt=latar_belakang&opts=view';
		</script>
    <?php
	}
?>
