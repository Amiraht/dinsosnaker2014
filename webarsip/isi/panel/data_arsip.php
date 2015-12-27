<script type="text/javascript">
$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyFilter").slideToggle(500);
    });
    
    $("#tgl_surat_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_dari").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    
    $("#tgl_surat_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima_sampai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
function edit(id){
    document.location.href="?mod=edit_data_arsip&id=" + id;
}
function hapus(id){
    confirm("Anda yakin akan menghapus data arsip ini?", "PERHATIAN", function(r){
       if(r){
            document.location.href="php/hapus_data_arsip.php?id=" + id;
       } 
    });
}
function cetak(id){
    window.open("isi/cetak_laporan/sampul.php?id=" + id);
}
function digitalisasi(id){
    document.location.href="?mod=digitalisasi_arsip&id=" + id;
}
</script>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">DAFTAR DATA ARSIP</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR DATA ARSIP</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./?mod=data_arsip'" 
                                onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                                </td>
                        </tr>
                    </table>            
                    </div>
            <br>
        </td>
  </tr>
  <tr>
  	<td>
    <div id='content' style='padding-top:10px;'>	<br>
		

	 <input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" />
       <br/><br/>
	<fieldset id="bodyFilter">
		<legend><h3>FILTER DATA PENCARIAN</h3></legend>
	   
	    <form name="frm" action="?mod=<?php echo($_GET["mod"]); ?>" method="post">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='10%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_masalah">
                            <option value="0">[.. Pilih Masalah ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_masalah ORDER BY id_masalah ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds_skpd["id_masalah"] == $_POST["id_masalah"])
                                    echo("<option selected='selected' value='" . $ds_skpd["id_masalah"] . "'>(" . $ds_skpd["kode_masalah"] . ") " . $ds_skpd["masalah"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_masalah"] . "'>(" . $ds_skpd["kode_masalah"] . ") " . $ds_skpd["masalah"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Keterangan</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="keterangan">
                            <option value="0">[.. Pilih Keterangan ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_keterangan_benda_arsip ORDER BY id_keterangan_benda_arsip ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds_skpd["keterangan_benda_arsip"] == $_POST["keterangan"])
                                    echo("<option selected='selected' value='" . $ds_skpd["keterangan_benda_arsip"] . "'>" . $ds_skpd["keterangan_benda_arsip"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["keterangan_benda_arsip"] . "'>" . $ds_skpd["keterangan_benda_arsip"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Jenis Arsip</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_jenis_arsip">
                            <option value="0">[.. Pilih Jenis Arsip ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_jenis_arsip ORDER BY jenis_arsip ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds_skpd["id_jenis_arsip"] == $_POST["id_jenis_arsip"])
                                    echo("<option selected='selected' value='" . $ds_skpd["id_jenis_arsip"] . "'>" . $ds_skpd["jenis_arsip"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_jenis_arsip"] . "'>" . $ds_skpd["jenis_arsip"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Tahun</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tahun" value="<?php echo($_POST["tahun"]); ?>" />
                    </td>
                </tr>
            </table>
            <br/>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
       </form>
	</fieldset><br/><br/>
	<fieldset>
		<legend><h3>DAFTAR DATA ARSIP</h3></legend>
		<input type="button" value="Tambah Data Arsip Aktif" onclick="document.location.href='?mod=tambah_data_arsip';" /><br/>
		<input type="button" value="Cetak Informasi Kotak" onclick="window.open('?mod=cetak_kotak');" /><br/>
   
		<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
			<thead>
			<tr class="headertable">
				<th width='40px'>No.</th>
				<th width='100px'>Kode Klasifikasi</th>
				<th width='70px'>Indeks</th>
				<th width='100px'>Masalah</th>
				<th>Uraian Masalah</th>
				<th width='70px'>Tahun</th>
				<th width='50px'>Sampul</th>
				<th width='50px'>Boks</th>
				<th width='50px'>Rak</th>
				<th width='100px'>Jenis Arsip</th>
				<th width='100px'>Keterangan</th>
				<th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<?php
				$whr = "";
				if($_POST["id_masalah"] <> "" && $_POST["id_masalah"] <> "0"){
					$whr .= " AND a.id_masalah = '" . $_POST["id_masalah"] . "' "; 
				}
				if($_POST["keterangan"] <> "" && $_POST["keterangan"] <> "0"){
					$whr .= "  AND a.keterangan = '" . $_POST["keterangan"] . "' ";
				}
				if($_POST["id_jenis_arsip"] <> "" && $_POST["id_jenis_arsip"] <> "0"){
					$whr .= "  AND a.id_jenis_arsip = '" . $_POST["id_jenis_arsip"] . "'";
				}
				if($_POST["tahun"] <> ""){
					$whr .= " AND a.tahun='" . $_POST["tahun"] . "'"; 
				}
				$res = mysql_query("SELECT
										a.*, c.unit_kerja, d.masalah, e.jenis_arsip
									FROM
										tbl_benda_arsip a
										LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
										LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
										LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
									WHERE
										a.id_jenis_arsip='1' AND a.id_pengguna='47' AND a.id_unit_kerja = '" . $_SESSION["id_unit_kerja"] . "' " . $whr . "
									ORDER BY
										a.tahun");
				/*echo "<pre>SELECT
										a.*, c.unit_kerja, d.masalah, e.jenis_arsip
									FROM
										tbl_benda_arsip a
										LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
										LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
										LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
									WHERE
										a.id_jenis_arsip='1' AND a.id_pengguna='47' AND a.id_unit_kerja = '" . $_SESSION["id_unit_kerja"] . "' " . $whr . "
									ORDER BY
										a.tahun</pre>";*/
				/*echo("SELECT
										a.*, c.unit_kerja, d.masalah, e.jenis_arsip
									FROM
										tbl_benda_arsip a
										LEFT JOIN ref_unit_kerja c ON a.id_unit_kerja = c.id_unit_kerja
										LEFT JOIN ref_masalah d ON a.id_masalah  = d.id_masalah
										LEFT JOIN ref_jenis_arsip e ON a.id_jenis_arsip = e.id_jenis_arsip
									WHERE
										a.id_unit_kerja = '" . $_SESSION["id_unit_kerja"] . "' " . $whr . "
									ORDER BY
										a.tahun");*/
				$ctr = 0;
				while($ds = mysql_fetch_array($res)){
					$ctr++;
			?>
				<tr>
					<td align='center'><?php echo($ctr); ?></td>
					<td><?php echo($ds["kode_klasifikasi"]); ?></td>
					<td><?php echo($ds["indeks"]); ?></td>
					<td><?php echo($ds["masalah"]); ?></td>
					<td><?php echo($ds["uraian"]); ?></td>
					<td align='center'><?php echo($ds["tahun"]); ?></td>
					<td align='center'><?php echo($ds["sampul"]); ?></td>
					<td align='center'><?php echo($ds["box"]); ?></td>
					<td align='center'><?php echo($ds["rak"]); ?></td>
					<td><?php echo($ds["jenis_arsip"]); ?></td>
					<td><?php echo($ds["keterangan"]); ?></td>
					<td>
						<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit Data Arsip' onclick='edit(<?php echo($ds["id_arsip"]); ?>);' />
					</td>
					<td>
						<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data Arsip' onclick='hapus(<?php echo($ds["id_arsip"]); ?>);' />
					</td>
					<td>
						<img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Cetak Informasi Sampul' onclick='cetak(<?php echo($ds["id_arsip"]); ?>);' />
					</td>
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	  </fieldset>
	</div>
</td>
</tr>
<tr>
    <td align="center" valign="middle">
    <div id='menu' style='border:0px solid black;'>
                    <nav>
                            <ul>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./'>BERANDA UTAMA</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=latar_belakang'>LATAR BELAKANG</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=berita_dan_informasi'>BERITA DAN INFORMASI</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=fdownload'>FILE DOWNLOAD</a></li>
                                </ul>
                    </nav>
    </div>
    </td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

