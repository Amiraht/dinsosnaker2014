<script type="text/javascript">
$(document).ready(function(){
    $("#tgl_surat").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#tgl_terima").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    $("#harus_selesai").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
    
});

function loadsubmasalah(id_masalah){
    //alert(id_masalah);
    $("#id_jenis_surat").html("<option value='0'>[.. Pilih Sub Masalah ..]</option>");
    $.ajax({
        type: "GET",
        url: "ajax/submasalah.php",
        data: "id_masalah=" + id_masalah,
        success: function(r){
            //alert(r);
            $("#id_jenis_surat").append(r);
        }
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3>DATA SURAT MASUK YANG DIBALAS DENGAN SURAT INI</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='200px'>No. Surat</th>
            <th width='100px'>Tgl. Surat</th>
            <th width='100px'>Tgl. Terima</th>
            <th>Perihal</th>
            <th width='250px'>Unit Pengirim</th>
            <th width='100px'>Harus Selesai</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
            <th width='20px'>&nbsp;</th>
        </tr>
        <?php
            $res = mysql_query("SELECT 
                                	a.*, b.unit_kerja, c.id AS id_temp
                                FROM 
                                	myapp_maintable_suratmasuk a
                                	LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
                                	LEFT JOIN myapp_sessiontable_balasan c ON (a.id = c.id_surat_masuk AND c.session_id='" . session_id() . "')
                                WHERE
                                	1 AND c.id_surat_masuk IS NOT NULL
                                ORDER BY 
                                	id ASC");
            $ctr = 0;
            while($ds = mysql_fetch_array($res)){
                $ctr++;
                echo("<tr>");
                    echo("<td align='center'>" . $ctr . "</td>");
                    echo("<td>" . $ds["no_surat"] . "</td>");
                    echo("<td>" . tglindonesia($ds["tgl_surat"]) . "</td>");
                    echo("<td>" . tglindonesia($ds["tgl_terima"]) . "</td>");
                    echo("<td>" . $ds["perihal_surat"] . "</td>");
                    echo("<td>" . $ds["unit_kerja"] . "</td>");
                    if($ds["harus_selesai"] == "0000-00-00")
                        echo("<td>[.:: === ::.]</td>");
                    else
                        echo("<td>" . $ds["harus_selesai"] . "</td>");
                    echo("<td align='center'>");
                        echo("<img src='image/information_32.png' width='18px' class='linkimage' title='Detail Surat Masuk' onclick='lihat_detail_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                    echo("<td align='center'>");
                        echo("<img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Daftar catatan disposisi' onclick='lihat_cadis_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                    echo("<td align='center'>");
                        echo("<img src='image/Attachment-32.png' width='18px' class='linkimage' title='File yang dilampirkan' onclick='lihat_file_sm(" . $ds["id"] . ", 0);'>");
                    echo("</td>");
                    echo("<td align='center'>");
                        echo("<img src='image/Delete-32.png' width='18px' class='linkimage' title='Batal balas surat ini' onclick='document.location.href=\"php/batal_temp_balas_surat.php?id=" . $ds["id_temp"] . "\"'>");
                    echo("</td>");
                echo("</tr>");
            }
        ?>
        </table>
        <div class="kelang"></div>
        <input type="button" value="Tambah" onclick="document.location.href='?mod=cari_surat_untuk_dibalas';" />
    </div>
</div>
<div class="kelang"></div>
<form name="frm" action="php/input_surat_keluar.php" method="post" id="frm_sk">
    <div class="panelcontainer" style="width: 100%;">
        <h3>INPUT DATA SURAT KELUAR</h3>
        <div class="bodypanel">
            <input type="hidden" name="id_surat_masuk" value="<?php echo($_GET["id"]); ?>" />
            <input type="hidden" name="id_disposisi" value="<?php echo($_GET["id_disposisi"]); ?>" />
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <?php
                if(isset($_GET["err"])){
            ?>
                <tr>
                    <td colspan="3"><span class="err_msg"><?php echo($_GET["err"]) ?></span></td>
                </tr>
            <?php
                }
            ?>
                <tr>
                    <td width='20%'>Nomor Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail">Diisi oleh Loket Pada Proses Pengiriman Surat Keluar</span></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td><span class="detail">Diisi oleh Loket Pada Proses Pengiriman Surat Keluar</span></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Pengiriman</td>
                    <td width='10px'>:</td>
                    <td><span class="detail">Diisi oleh Loket Pada Proses Pengiriman Surat Keluar</span></td>
                </tr>
                <tr>
                    <td width='20%'>Perihal</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="perihal_surat" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tujuan</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="tujuan_surat" /></td>
                </tr>
                <tr>
                    <td width='20%'>Alamat Tujuan</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="alamat_tujuan" /></td>
                </tr>
                <tr>
                    <td width='20%'>Judul Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="judul_surat" /></td>
                </tr>
                <tr>
                    <td width='20%'>Deskripsi Surat</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="deskripsi_surat" /></td>
                </tr>
                <tr>
                    <td width='20%'>Catatan Tambahan</td>
                    <td width='10px'>:</td>
                    <td><textarea name="catatan"></textarea></td>
                </tr>
                <tr>
                    <td width='20%'>SKPD / Unit Tujuan</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_skpd_tujuan">
                            <option value="0">[.. Pilih SKPD Tujuan ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM myapp_reftable_unitkerja ORDER BY unit_kerja ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                echo("<option value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_masalah" onchange="loadsubmasalah(this.value);" id="id_masalah">
                            <option value="0">[.. Pilih Masalah ..]</option>
                        <?php
                            $res_masalah= mysql_query("SELECT * FROM myapp_reftable_masalah ORDER BY kode_masalah ASC");
                            while($ds_masalah = mysql_fetch_array($res_masalah)){
                                echo("<option value='" . $ds_masalah["id_masalah"] . "'>(" . $ds_masalah["kode_masalah"] . ") " . $ds_masalah["masalah"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='20%'>Sub Masalah</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_jenis_surat" id="id_jenis_surat">
                            <option value="0">[.. Pilih Sub Masalah ..]</option>
                        </select>
                    </td>
                </tr>
                <?php
                    if($_SESSION["id_level"] == 20 || $_SESSION["id_level"] == 21 || $_SESSION["id_level"] == 22 || $_SESSION["id_level"] == 23 || $_SESSION["id_level"] == 25){
                ?>
                <tr>
                    <td width='20%'>Disposisi ke Kasubbid</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="kasubbid">
                            <option value="0">[.. Pilih Kasubbid ..]</option>
                        <?php
                            $res_kasubbid= mysql_query("SELECT
                                                        	*
                                                        FROM
                                                        	myapp_reftable_levelpengguna
                                                        WHERE
                                                        	atasan = '" . $_SESSION["atasan"] . "' AND urutan = 3");
                            while($ds_kasubbid = mysql_fetch_array($res_kasubbid)){
                                echo("<option value='" . $ds_kasubbid["id"] . "'>" . $ds_kasubbid["level"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td width='20%'>Penanda Tangan Surat</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_ttd">
                            <option value="0">[.. Pilih Penandatangan ..]</option>
                        <?php
                            $res_ttd= mysql_query("SELECT
                                                        	*
                                                        FROM
                                                        	myapp_reftable_ttd ORDER BY urut ASC");
                            while($ds_ttd = mysql_fetch_array($res_ttd)){
                                echo("<option value='" . $ds_ttd["id"] . "'>" . $ds_ttd["ttd"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
            <br />
            
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>