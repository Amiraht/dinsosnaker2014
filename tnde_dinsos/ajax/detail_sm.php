
<fieldset>
	<legend><h3>DETAIL SURAT MASUK</h3></legend>
    <form name="frm" action="../php/edit_surat_masuk.php" method="post">
            <?php
                include("../php/koneksi.php");
                include("../php/fungsi.php");
                bacaDisp($_GET["id_disposisi"]);
                $res_sm = mysql_query("SELECT 
                                        	a.*, b.unit_kerja, CONCAT('(', c.kode_masalah, ') ', c.masalah) AS masalah,
                                        	CONCAT('(', d.kode, ') ', d.jenis_surat) AS jenis_surat
                                        FROM 
                                        	myapp_maintable_suratmasuk a
                                        	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                                        	LEFT JOIN myapp_reftable_masalah c ON a.id_masalah = c.id_masalah
                                        	LEFT JOIN myapp_reftable_jenissurat d ON a.id_jenis_surat = d.id_jenis_surat
                                        WHERE 
                                        	a.id='" . $_GET["id"] . "'");
                $ds_sm = mysql_fetch_array($res_sm);
            ?>
            <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["no_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["tgl_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Terima</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["tgl_terima"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["perihal_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Pengirim</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["pengirim_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Alamat Pengirim</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["alamat_pengirim"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Judul Surat</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["judul_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["deskripsi_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Catatan Tambahan</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["catatan"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>SKPD / Unit Pengirim</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["unit_kerja"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["masalah"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Sub Masalah</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["jenis_surat"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Harus Selesai Pada<br /><span class="footnote">*) Kosongkan jika tidak perlu ditindak lanjuti</span></td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["harus_selesai"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Indeks</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["indeks"]); ?></b></td>
                </tr>
                <tr>
                    <td width='20%'>Kode</td>
                    <td width='10px'>:</td>
                    <td><b><?php echo($ds_sm["kode"]); ?></b></td>
                </tr>
            </table>
            <br />
   
     </form>