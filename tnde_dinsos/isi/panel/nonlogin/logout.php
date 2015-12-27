<?php
	unset($_SESSION["id_user"]);
	session_destroy();
	//pesan('Anda telah logout', './index.php');
	header('Location:./index.php?mod=umum&do=login');
?>