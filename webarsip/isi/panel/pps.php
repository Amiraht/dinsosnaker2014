<script type="text/javascript">
function hapus(id){
    confirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
       if(r){
            //alert("HAPUS " + id);
            document.location.href="php/hapus_pps.php?id=" + id + "&tipe_pps=<?php echo($_GET["tipe_pps"]); ?>";
       } 
    });
}
function tambah(tipe_pps){
    //$.fancybox.open("indexpanel.php?mod=tambah_pps&tipe_pps=" + tipe_pps);
    document.location.href="?mod=tambah_pps&tipe_pps=" + tipe_pps;
}
function edit(id, pengaduan, tipe_pps){
    document.location.href="?mod=edit_pps&id_pengaduan=" + id + "&pengaduan=" + pengaduan + "&tipe_pps=" + tipe_pps;
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
                                <h1><a style="color:#AA9F00;" href="">PROSES PENGADUAN DAN SARAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>PROSES PENGADUAN DAN SARAN</span></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./'" 
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
		

<fieldset>
    <legend><h3>
    <?php
        $nama = "";
        switch($_GET["tipe_pps"]){
            case 1 :
                echo("DAFTAR PENGADUAN YANG PERNAH DIBUAT");
                $nama = "Pengaduan";
                break;
            case 2 :
                echo("DAFTAR PESAN DAN SARAN YANG PERNAH DIBUAT");
                $nama = "Pesan Dan Saran";
                break;
        }
    ?>
    </h3></legend>
    <input type="button" value="Tambah <?php echo($nama); ?>" onclick="tambah(<?php echo($_GET["tipe_pps"]); ?>);" /><br/><br/>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th>Isi</th>
            <th width='120px'>Status</th>
            <th width='250px'>Posisi Disposisi</th>
            <th width='100px'>Tanggal Laporan</th>
            <th width='40px'>&nbsp;</th>
            <th width='40px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query(" SELECT  
         		                     a.id_pengaduan, a.pengaduan, b.jabatan AS disposisi_sekarang, a.tgl_pengaduan, a.tipe_disposisi  
                                 FROM  
                                	 tbl_pengaduan_pesan_saran a  
                                	 LEFT JOIN ref_jabatan b ON a.id_jabatan_tujuan = b.id_jabatan  
                                 WHERE  
                                	 a.id_anggota = '" . $_SESSION["id_pengguna"] . "' AND a.tipe_pps = '" . $_GET["tipe_pps"] . "'  
                                 ORDER BY  
                                	 a.id_pengaduan ASC ") or die(mysql_error());
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
        ?>
            <tr>
                <td align='center'><?php echo($ctr); ?></td>
                <td><?php echo($ds["pengaduan"]); ?></td>
                <td align='center'>
                    <?php
                        switch($ds["tipe_disposisi"]){
                            case 1 :
                                echo("Pemrosesan");
                                break;
                            case 2 :
                                echo("Disposisi Hasil");
                                break;
                            case 3 :
                                echo("Selesai Diproses");
                                break;
                        }
                    ?>
                </td>
                <td align='center'><?php echo($ds["disposisi_sekarang"]); ?></td>
                <td align='center'><?php echo($ds["tgl_pengaduan"]); ?></td>
                <td align='center'>
                    <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit Isi <?php echo($nama); ?>' onclick='edit(<?php echo($ds["id_pengaduan"]); ?>, "<?php echo($ds["pengaduan"]); ?>", <?php echo($_GET["tipe_pps"]); ?>);' />
                </td>
                <td align='center'>
                    <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data <?php echo($nama); ?>' onclick='hapus(<?php echo($ds["id_pengaduan"]); ?>);' />
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
 

