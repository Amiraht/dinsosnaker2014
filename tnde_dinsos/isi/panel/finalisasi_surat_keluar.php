
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
function disposisi(id_surat, id_disposisi){
	 var t = document.getElementById("div_cek_"+id_surat);
	 if(t.innerHTML != ''){
		 t.innerHTML = '';
	  }else
		t.innerHTML='<iframe src="./isi/panel/modal/dialog_frm_dsp.php?id_surat_masuk='+id_surat+'&id_disposisi='+id_disposisi+'" width="100%" style="height:1300px" frameborder="0" ' + 
		'scrolling="no" id="iframe_detail"></iframe>';	
}

	
function kestaff(id_bidang){
    //$("#staff").html(id_bidang);
    $("#staff").html("Loading . . .");
    $.ajax({
        type: "GET",
        url: "ajax/disposisi_kasubbid.php",
        data: "id=" + id_bidang,
        success: function(r){
            //alert(r);
            $("#staff").html(r);
        }
    });
}
</script>
<script type="text/javascript" src="./libraries/main.js"></script>

<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="./?mod=finalisasi_surat_keluar">UPLOAD FINAL SURAT KELUAR</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='<?=$url_main;?>'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>UPLOAD FINAL SURAT KELUAR</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./<?=$url_main;?>'" 
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
		
		<input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><br/>	
		<fieldset id='bodyFilter'>
			<legend><h3>FILTER DATA PENCARIAN</h3></legend>
			<form name="frm" action="?mod=<?php echo($_GET["mod"]); ?>" method="post">
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td width='20%'>Nomor Register</td>
						<td width='10px'>:</td>
						<td><input type="text" name="id" value="<?=isset($_POST["id"]) ? $_POST["id"] : ""; ?>" /></td>
					</tr>
					<tr>
						<td width='20%'>Nomor Surat</td>
						<td width='10px'>:</td>
						<td><input type="text" name="no_surat" value="<?=isset($_POST["no_surat"]) ? $_POST["no_surat"] : ""; ?>" /></td>
					</tr>
					<tr>
						<td width='20%'>Tanggal Surat</td>
						<td width='10px'>:</td>
						<td>
							<input type="text" name="tgl_surat_dari" id="tgl_surat_dari" class="ufilter" value="<?=isset($_POST["tgl_surat_dari"]) ? $_POST["tgl_surat_dari"] : ""; ?>" />
							S/D
							<input type="text" name="tgl_surat_sampai" id="tgl_surat_sampai" class="ufilter" value="<?=isset($_POST["tgl_surat_sampai"]) ? $_POST["tgl_surat_sampai"] : ""; ?>" />
						</td>
					</tr>
					<tr>
						<td width='20%'>Tanggal Pengiriman</td>
						<td width='10px'>:</td>
						<td>
							<input type="text" name="tgl_terima_dari" id="tgl_terima_dari" class="ufilter" value="<?=isset($_POST["tgl_terima_dari"]) ? $_POST["tgl_terima_dari"] : "" ; ?>" />
							S/D
							<input type="text" name="tgl_terima_sampai" id="tgl_terima_sampai" class="ufilter" value="<?=isset($_POST["tgl_terima_sampai"]) ? $_POST["tgl_terima_sampai"] : ""; ?>" />
						</td>
					</tr>
					<tr>
						<td width='20%'>Perihal</td>
						<td width='10px'>:</td>
						<td><input type="text" name="perihal_surat" value="<?=isset($_POST["perihal_surat"]) ? $_POST["perihal_surat"] : ""; ?>" /></td>
					</tr>
					<tr>
						<td width='20%'>Deskripsi Surat</td>
						<td width='10px'>:</td>
						<td><input type="text" name="deskripsi_surat" value="<?=isset($_POST["deskripsi_surat"]) ? $_POST["deskripsi_surat"] : ""; ?>" /></td>
					</tr>
					<tr>
						<td width='20%'>SKPD / Unit Tujuan</td>
						<td width='10px'>:</td>
						<td>
							<select name="id_skpd_pengirim">
								<option value="0">[.. Pilih SKPD Tujuan ..]</option>
							<?php
								$res_skpd = mysql_query("SELECT * FROM myapp_reftable_unitkerja ORDER BY unit_kerja ASC");
								while($ds_skpd = mysql_fetch_array($res_skpd)){
									if($ds_skpd["id_unit_kerja"] == $_POST["id_skpd_pengirim"])
										echo("<option selected='selected' value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
									else
										echo("<option value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
								}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td width='20%'>Filter Berdasarkan</td>
						<td width='10px'>:</td>
						<td>
							<input type="radio" name="ftype" value="1" <?php if(isset($_POST['ftype']) && $_POST["ftype"]==1 || empty($_POST["ftype"]))echo("checked='checked'"); ?> />Surat Keluar<br />
							<input type="radio" name="ftype" value="2" <?php if(isset($_POST['ftype']) && $_POST["ftype"]==2)echo("checked='checked'"); ?> />Surat Masuk Yang Dibalas
						</td>
					</tr>
				</table><br/>
				<table border="0px" cellspacing='0' cellpadding='0' width='40%'>
					<tr>
						<td width='50%'><input type="submit" value='Filter' style="width: 100%;" /></td>
						<td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
					</tr>
				</table>
			</form>
		</fieldset><br/>	   

		<fieldset>
			<legend><h3>DAFTAR SURAT KELUAR YANG TELAH SELESAI DITANDA TANGANI</h3></legend>
		
			<table border="1" width="100%" align="left" cellpadding="5" cellspacing="1" class='tblisi'>
				 <tr>
					<td>No.</td>
					<td>No. Register</td>
					<td>No. Surat</td>
					<td>Tgl. Surat</td>
					<td>Tgl. Terima</td>
					<td>Perihal</td>
					<td>Unit Pengirim</td>
					<td>Asal Disposisi</td>
					<td>Tipe Disposisi</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
		<?php
        $whr = "";
        $sql = "";
        if(isset($_POST["ftype"]) && $_POST["ftype"] == 1 || empty($_POST["ftype"])){
            if(isset($_POST["id"]) && $_POST["id"] <> "")
                $whr .= " AND a.id = '" . $_POST["id"] . "'";
            if(isset($_POST["no_surat"]) && $_POST["no_surat"] <> "")
                $whr .= " AND a.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
            if(isset($_POST["tgl_surat_dari"]) && isset($_POST["tgl_surat_sampai"]) && $_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
                $whr .= " AND a.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
            if(isset($_POST["tgl_terima_dari"]) && isset($_POST["tgl_terima_sampai"]) && $_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
                $whr .= " AND a.tgl_kirim BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
            if(isset($_POST["perihal_surat"]) && $_POST["perihal_surat"] <> "")
                $whr .= " AND a.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
            if(isset($_POST["deskripsi_surat"]) && $_POST["deskripsi_surat"] <> "")
                $whr .= " AND a.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
            if(isset($_POST["id_skpd_pengirim"]) && $_POST["id_skpd_pengirim"] <> 0)
                $whr .= " AND a.id_skpd_tujuan = '" . $_POST["id_skpd_pengirim"] . "'";
            
            $sql = "SELECT 
                    	a.*, b.unit_kerja, 'Siap Untuk Pengiriman' AS kondisi, 'Kepala Badan' AS asal, 0 AS id_disposisi,
                        1 AS keadaan, c.kode_masalah, d.kode
                    FROM 
                    	myapp_maintable_suratkeluar a
                    	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                        LEFT JOIN myapp_reftable_masalah c ON a.id_masalah = c.id_masalah
                        LEFT JOIN myapp_reftable_jenissurat d ON a.id_jenis_surat = d.id_jenis_surat
                    WHERE
                    	a.status = 3 " . $whr . "
                    ORDER BY 
                    	id ASC";
						
						
        }else if(isset($_POST["ftype"]) && $_POST["ftype"] == 2){ 
            if(isset($_POST["id"]) && $_POST["id"] <> "")
                $whr .= " AND a.id = '" . $_POST["id"] . "'";
            if(isset($_POST["no_surat"]) && $_POST["no_surat"] <> "")
                $whr .= " AND a.no_surat LIKE '%" . $_POST["no_surat"] . "%'";
            if(isset($_POST["tgl_surat_dari"]) && isset($_POST["tgl_surat_sampai"]) && $_POST["tgl_surat_dari"] <> "" && $_POST["tgl_surat_sampai"] <> "")
                $whr .= " AND a.tgl_surat BETWEEN '" . $_POST["tgl_surat_dari"] . "' AND '" . $_POST["tgl_surat_sampai"] . "'";
            if(isset($_POST["tgl_terima_dari"]) && isset($_POST["tgl_terima_sampai"]) && $_POST["tgl_terima_dari"] <> "" && $_POST["tgl_terima_sampai"] <> "")
                $whr .= " AND a.tgl_kirim BETWEEN '" . $_POST["tgl_terima_dari"] . "' AND '" . $_POST["tgl_terima_sampai"] . "'";
            if(isset($_POST["perihal_surat"]) && $_POST["perihal_surat"] <> "")
                $whr .= " AND a.perihal_surat LIKE '%" . $_POST["perihal_surat"] . "%'";
            if(isset($_POST["deskripsi_surat"]) && $_POST["deskripsi_surat"] <> "")
                $whr .= " AND a.deskripsi_surat LIKE '%" . $_POST["deskripsi_surat"] . "%'";
            if(isset($_POST["id_skpd_pengirim"]) && $_POST["id_skpd_pengirim"] <> 0)
                $whr .= " AND a.id_skpd_tujuan = '" . $_POST["id_skpd_pengirim"] . "'";
            
            $sql = "SELECT 
                    	a.*, b.unit_kerja, 'Siap Untuk Pengiriman' AS kondisi, 'Kepala Badan' AS asal, 0 AS id_disposisi,
                    	1 AS keadaan, c.kode_masalah, d.kode, f.no_surat
                    FROM 
                    	myapp_maintable_suratkeluar a
                    	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                    	LEFT JOIN myapp_reftable_masalah c ON a.id_masalah = c.id_masalah
                    	LEFT JOIN myapp_reftable_jenissurat d ON a.id_jenis_surat = d.id_jenis_surat
                    	LEFT JOIN myapp_maintable_balasan e ON a.id = e.id_surat_keluar
                    	LEFT JOIN myapp_maintable_suratmasuk f ON e.id_surat_masuk = f.id
                    WHERE
                    	a.status = 3 " . $whr . "
                    GROUP BY
                    	a.id
                    ORDER BY
                    	f.id ASC";
        }
        //echo($sql);
        $res = $con->query($sql);
        $ctr = 0;
		$res->data_seek(0);
        while($ds = $res->fetch_assoc()){
            $nosur = explode("/", $ds["no_surat"]);
            
            $ctr++;
            echo("<tr>");
                $kondisi = "belumdibaca";
                if($ds["kondisi"] == 2)
                    $kondisi = "telahdibaca";
                echo("<td align='center'>" . $ctr . "</td>");
                echo("<td align='center'>" . no_register($ds["id"]) . "</td>");
                echo("<td>" . $ds["no_surat"] . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_surat"]) . "</td>");
                echo("<td>" . tglindonesia($ds["tgl_kirim"]) . "</td>");
                echo("<td>" . $ds["perihal_surat"] . "</td>");
                echo("<td>" . $ds["unit_kerja"] . "</td>");
                echo("<td>" . $ds["asal"] . "</td>");
                echo("<td>" . konversiKeadaanSK($ds["keadaan"]) . "</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Info-32.png' width='18px' class='linkimage' title='Detail Surat Keluar' onclick='lihat_detail_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<a href='./?mod=file_final_surat_keluar&id=". $ds["id"] ."' id='uploadBerkas_". $ds["id"] ."'>
							<img src='image/upload.png' width='18px' class='linkimage' title='Upload File Final' ></a>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sk(" . $ds["id"] . ", " . $ds["id_disposisi"] . ");'>");
                echo("</td>");
                echo("<td align='center'>");
                    echo("<img src='image/send_32.png' width='18px' class='linkimage' title='Selesai Dan Proses Surat Keluar Telah Berakhir' onclick='munculDisposisi(" . $ds["id"] . ", " . $ds["id_disposisi"] . ", \"" . $ds["no_nodin"] . "\", \"" . $ds["tgl_nodin"] . "\");'>");
                echo("</td>");
				echo("</tr>\n");
				
				echo "
					<tr id='div_if'>
						<span style='display:none;' id='load_text'></span>
						<td colspan='14'> <div id='div_cek_".$ds["id"]."'></div>
					</tr>
					";	
	?>	
			<!-- Script javascript untuk menampilkan dialog upload File -->
				<script>
					var id = '<?php echo $ds["id"];?>';
					
					$("#uploadBerkas_"+id).fancybox({
								'width'				: '80%',
								'height'			: '60%',
								'autoScale'			: false,
								'transitionIn'		: 'none',
								'transitionOut'		: 'none',
								'overlayShow'	: false,
								'type'				: 'iframe'
					});
				</script>
	<?php
			}
		
		$res->close(); // tutup koneksi ke dalam database
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
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='<?=$url_main;?>'>BERANDA UTAMA</a></li>
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
 