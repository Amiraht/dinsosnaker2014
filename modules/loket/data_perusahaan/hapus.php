<?php
require_once("../../../libraries/dinsos.php");
if($_GET["optss"] == 'hapus')
{
	
	if(!empty($_GET["id"]))
	{
		$hapus = mysql_query("delete from db_dinsos where id_perusahaan='".$_GET["id"]."'");
		if($hapus)
		{
		?>
        	<script type="text/javascript">
				alert('Berhasil Menghapus Data');
				parent.parent.document.location.href='../../../index.php?mod=loket&opt=data_perusahaan';
			</script>
        <?php
		}
		else
		{
		?>
        	<script type="text/javascript">
				alert('Gagal Menghapus Data');
				parent.parent.document.location.href='../../../index.php?mod=loket&opt=data_perusahaan';
			</script>
        <?php
		}
	}
	else
	{
	?>
    <script type="text/javascript">
		alert('Data Tidak Dapat Dihapus');
		parent.parent.document.location.href='../../../index.php?mod=loket&opt=data_perusahaan';
	</script>
    <?php
	exit();
	}
}
?>