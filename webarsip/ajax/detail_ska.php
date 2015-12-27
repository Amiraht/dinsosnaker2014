<form name="frm" action="php/edit_surat_keluar.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <div class="bodypanel">
            <?php
                include("../php/koneksi.php");
                include("../php/fungsi.php");
                bacaDispSK($_GET["id_disposisi"]);
                $ds = mysql_fetch_array(mysql_query("SELECT 
                                                    	a.*, b.unit_kerja, CONCAT('(', c.kode_masalah, ') ', c.masalah) AS masalah,
                                                    	CONCAT('(', d.kode, ') ', d.jenis_surat) AS jenis_surat,
                                                        e.kotak, e.sampul, e.rak
                                                    FROM 
                                                    	myapp_maintable_suratkeluar a
                                                    	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_tujuan = b.id_unit_kerja
                                                    	LEFT JOIN myapp_reftable_masalah c ON a.id_masalah = c.id_masalah
                                                    	LEFT JOIN myapp_reftable_jenissurat d ON a.id_jenis_surat = d.id_jenis_surat
                                                        LEFT JOIN myapp_archivetable_suratkeluar e ON a.id = e.id_surat_keluar
                                                    WHERE 
                                                    	a.id='" . $_GET["id"] . "'"));
            ?>
            <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["no_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["tgl_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Nomor Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["no_nodin"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Nota Dinas</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["tgl_nodin"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Pengiriman</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["tgl_kirim"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["perihal_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Tujuan</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["tujuan_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Alamat Tujuan</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["alamat_tujuan"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Judul Surat</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["judul_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["deskripsi_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Catatan Tambahan</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["catatan"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>SKPD / Unit Tujuan</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["unit_kerja"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["masalah"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Sub Masalah</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["jenis_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Nomor Sampul</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["sampul"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Nomor Kotak</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["kotak"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Nomor Rak</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds["rak"]); ?></b></td>
                </tr>
                
            </table>
        </div>
    </div>
</form>