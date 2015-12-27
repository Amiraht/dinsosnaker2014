<script type="text/javascript" src="./libraries/fckeditor/fckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = './libraries/fckeditor/' ;

	var oFCKeditor = new FCKeditor( 'latar_belakang' ) ;
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;
}
</script>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr>
    <td><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
      <table border="0" id="atasan">
        	<tr>
		            <td colspan="2" style="text-align:right; padding-right:10px; ">
                 	<h1><a style="color:#AA9F00;" href="index.php?mod=menu&do=latar_belakang">LATAR BELAKANG</a></h1>
                    </td>
            </tr>
            <tr>
            	<td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='index.php?mod=cp&opt=main'> <span></span> CONTROL PANEL </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span> LATAR BELAKANG
                     </td>
                <td><img  align="right" width="90" height="29" onclick="document.location.href='./index.php?mod=cp&opt=main'" 
                    onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                    </td>
            </tr>
        </table>
</div></td>
  </tr>
  <tr>
    <td>
<fieldset>
<legend style="color:#000000;font-size:16px;font-weight:bold;font-family:Arial, Helvetica, sans-serif"><b>LATAR BELAKANG</b></legend>
<form method="post" action="./index.php?mod=cp&opt=latar_belakang&opts=validasi">
	<textarea id="latar_belakang" name="latar_belakang" rows="30" cols="80" style="width: 100%">
	<?php
		$q6 = mysql_query("select * from tbl_latar_belakang where id_latar_belakang=1");
		$q61 = mysql_fetch_array($q6);
		echo $q61["latar_belakang"];
	?>
	</textarea>
	<br />
	<input type="submit" name="save" value="Submit" />
	<input type="reset" name="reset" value="Reset" />
</form>
</fieldset>
<tr>
  	<td>
	<div id='footer' style='background:url(./image/coba/footer.png) no-repeat; min-height:80px; margin-left:8px;'>
	</div></td>
  </tr>
</table>