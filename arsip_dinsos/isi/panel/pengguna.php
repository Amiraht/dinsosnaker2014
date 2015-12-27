<script type="text/javascript">
$(document).ready(function(){
   $("#tgl_lahir").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    }); 
});
</script>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_anggota_arsip WHERE id_anggota='" . $_SESSION["id_pengguna"] . "'"));
?>
<input type="button" value="Cetak Profil" style="padding: 3px 10px;" onclick="window.open('isi/cetak_laporan/profil_pengguna.php');" />
<div class="kelang"></div>
<form name="frm" action="php/ubah_foto_pengguna.php" method="post" enctype="multipart/form-data">
    <div class="panelcontainer" style="width: 100%;">
        <h3>UBAH FOTO</h3>
        <div class="bodypanel" id="bodyfilter">
            <img src="php/buat_foto_anggota.php" width="200px" />
            <br />
            <input type="file" placeholder="Upload File Foto Jika Ingin Diubah" name="foto" style="width: 190px;" />
            <br />
            <input type="submit" value="UPLOAD" style="width: 200px;" />
        </div>
    </div>
</form>
<div class="kelang"></div>
<form name="frm" action="php/pengguna.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>PROFIL ANGGOTA</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <?php
                    if($_GET["scs_msg_pengguna"] != ""){
                ?>
                <tr>
                    <td width='10%'></td>
                    <td width='10px'></td>
                    <td style="color:  green; font-size: 12pt; font-style: italic; font-weight: bold;">
                        <?php echo($_GET["scs_msg_pengguna"]); ?>
                    </td>
                </tr>  
                <?php
                    }
                ?>
                <tr>
                    <td width='10%'>Nama Lengkap</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="nama_lengkap" value="<?php echo($ds["nama_lengkap"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Jenis Kelamin</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_jenis_kelamin">
                            <option value="0">[.. Pilih Jenis Kelamin ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_jenis_kelamin");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds["id_jenis_kelamin"] == $ds_skpd["id_jenis_kelamin"])
                                    echo("<option selected='selected' value='" . $ds_skpd["id_jenis_kelamin"] . "'>" . $ds_skpd["jenis_kelamin"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_jenis_kelamin"] . "'>" . $ds_skpd["jenis_kelamin"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Tanggal Lahir</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_lahir" id="tgl_lahir" value="<?php echo($ds["tgl_lahir"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Alamat</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="alamat" value="<?php echo($ds["alamat"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>No. Kontak</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="no_kontak" value="<?php echo($ds["no_kontak"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Email</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="email" value="<?php echo($ds["email"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Level Pengguna</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_level_pengguna">
                            <option value="0">[.. Pilih Level Pengguna ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_level_pengguna WHERE id_level = 2 OR id_level = 9");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds["id_level_pengguna"] == $ds_skpd["id_level"])
                                    echo("<option selected='selected' value='" . $ds_skpd["id_level"] . "'>" . $ds_skpd["level"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_level"] . "'>" . $ds_skpd["level"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Pekerjaan</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="pekerjaan" value="<?php echo($ds["pekerjaan"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Instansi Bekerja</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="id_unit_kerja">
                            <option value="0">[.. Pilih Instansi Bekerja ..]</option>
                        <?php
                            $res_skpd = mysql_query("SELECT * FROM ref_unit_kerja ORDER BY unit_kerja ASC");
                            while($ds_skpd = mysql_fetch_array($res_skpd)){
                                if($ds["id_unit_kerja"] == $ds_skpd["id_unit_kerja"])
                                    echo("<option selected='selected' value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                                else
                                    echo("<option value='" . $ds_skpd["id_unit_kerja"] . "'>" . $ds_skpd["unit_kerja"] . "</option>");
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Alamat Instansi</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="alamat_unit_kerja" value="<?php echo($ds["alamat_unit_kerja"]); ?>" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Jabatan</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="jabatan" value="<?php echo($ds["jabatan"]); ?>" />
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<!-- KELANG ------------------------------------------------------------- -->
<div class="kelang"></div>
<!-- KELANG ------------------------------------------------------------- -->
<form name="frm" action="php/ganti_username.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>UBAH USERNAME</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <?php
                    if($_GET["scs_msg_ubah_usr"] != ""){
                ?>
                <tr>
                    <td width='10%'></td>
                    <td width='10px'></td>
                    <td style="color:  green; font-size: 12pt; font-style: italic; font-weight: bold;">
                        <?php echo($_GET["scs_msg_ubah_usr"]); ?>
                    </td>
                </tr>  
                <?php
                    }
                ?>
                <?php
                    if($_GET["err_msg_ubah_usr"] != ""){
                ?>
                <tr>
                    <td width='10%'></td>
                    <td width='10px'></td>
                    <td style="color: red; font-size: 12pt; font-style: italic; font-weight: bold;">
                        <?php echo($_GET["err_msg_ubah_usr"]); ?>
                    </td>
                </tr>  
                <?php
                    }
                ?>
                <tr>
                    <td width='10%'>Username</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo($ds["username"]); ?>" />
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<!-- KELANG ------------------------------------------------------------- -->
<div class="kelang"></div>
<!-- KELANG ------------------------------------------------------------- -->
<form name="frm" action="php/ganti_password.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>UBAH PASSWORD</h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <?php
                    if($_GET["scs_msg_ubah_pwd"] != ""){
                ?>
                <tr>
                    <td width='10%'></td>
                    <td width='10px'></td>
                    <td style="color:  green; font-size: 12pt; font-style: italic; font-weight: bold;">
                        <?php echo($_GET["scs_msg_ubah_pwd"]); ?>
                    </td>
                </tr>  
                <?php
                    }
                ?>
                <?php
                    if($_GET["err_msg_ubah_pwd"] != ""){
                ?>
                <tr>
                    <td width='10%'></td>
                    <td width='10px'></td>
                    <td style="color: red; font-size: 12pt; font-style: italic; font-weight: bold;">
                        <?php echo($_GET["err_msg_ubah_pwd"]); ?>
                    </td>
                </tr>  
                <?php
                    }
                ?>
                <tr>
                    <td width='10%'>Password Saat Ini</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="password" name="pwd_now" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Password Baru</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="password" name="pwd_new_1" value="" />
                    </td>
                </tr>
                <tr>
                    <td width='10%'>Konfirmasi Password Baru</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="password" name="pwd_new_2" value="" />
                    </td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>