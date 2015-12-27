<script type="text/javascript">
$(document).ready(function(){
   ambil_tanggal("tanggal_lahir");
   
   $("#frm").submit(function(){
        if(frm.nip.value == "" || frm.nama_pegawai.value == ""){
            jAlert("Maaf, NIP dan NAMA harus diisi.", "PERHATIAN");
            return false;
        }
        
   }); 
});
</script>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pegawai WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'"));
?>
<form name="frm" id="frm" action="php/edit_pegawai.php" method="post">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">LIHAT PROFIL DAN EDIT DATA PEGAWAI</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <input type="text" name="nip" placeholder=":: NIP Pegawai ::" title="NIP Pegawai" value="<?php echo($ds["nip"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='150px'>
                    <input type="text" name="gelar_depan" placeholder=":: Gelar Depan ::" title="Gelar Depan" value="<?php echo($ds["gelar_depan"]); ?>" />
                </td>
                <td>
                    <input type="text" name="nama_pegawai" placeholder=":: Nama Pegawai ::" title="Nama Pegawai" value="<?php echo($ds["nama_pegawai"]); ?>" />
                </td>
                <td width='150px'>
                    <input type="text" name="gelar_belakang" placeholder=":: Gelar Belakang ::" title="Gelar Belakang" value="<?php echo($ds["gelar_belakang"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <select name="id_status_kepegawaian">
                        <option value="0">:: Status Kepegawaian ::</option>
                        <option value="4" <?php if($ds["id_status_kepegawaian"] == 4){echo("selected='selected'");} ?> >PNS</option>
                        <option value="1" <?php if($ds["id_status_kepegawaian"] == 1){echo("selected='selected'");} ?> >CPNS</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="id_jenis_kepegawaian">
                        <option value="0">:: Jenis Kepegawaian ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_jenis_kepegawaian");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_jenis_kepegawaian"] == $ds_cb["id_jenis_kepegawaian"])
                                    echo("<option selected='selected' value='$ds_cb[id_jenis_kepegawaian]'>$ds_cb[jenis_kepegawaian]</option>");
                                else
                                    echo("<option value='$ds_cb[id_jenis_kepegawaian]'>$ds_cb[jenis_kepegawaian]</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="id_kedudukan_kepegawaian">
                        <option value="0">:: Kedudukan Kepegawaian ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_kedudukan_kepegawaian");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_kedudukan_kepegawaian"] == $ds_cb["id_kedudukan_kepegawaian"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_kedudukan_kepegawaian"] . "'>" . $ds_cb["kedudukan_kepegawaian"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_kedudukan_kepegawaian"] . "'>" . $ds_cb["kedudukan_kepegawaian"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="id_golongan_darah">
                        <option value="0">:: Golongan Darah ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_golongan_darah");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_golongan_darah"] == $ds_cb["id_golongan_darah"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_golongan_darah"] . "'>" . $ds_cb["golongan_darah"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_golongan_darah"] . "'>" . $ds_cb["golongan_darah"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="id_jenis_kelamin">
                        <option value="0">:: Jenis Kelamin ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_jenis_kelamin");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_jenis_kelamin"] == $ds_cb["id_jenis_kelamin"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_jenis_kelamin"] . "'>" . $ds_cb["jenis_kelamin"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_jenis_kelamin"] . "'>" . $ds_cb["jenis_kelamin"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <input type="text" name="tempat_lahir" placeholder=":: Tempat Lahir ::" title="Tempat Lahir" value="<?php echo($ds["tempat_lahir"]); ?>" />
                </td>
                <td width='250px'>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder=":: Tanggal Lahir ::" title="Tanggal Lahir" value="<?php echo($ds["tanggal_lahir"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <input type="text" name="alamat" placeholder=":: Alamat ::" title="Alamat" value="<?php echo($ds["alamat"]); ?>" />
                </td>
                <td width='200px'>
                    <input type="text" name="rt" placeholder=":: RT ::" title="RT" value="<?php echo($ds["rt"]); ?>" />
                </td>
                <td width='200px'>
                    <input type="text" name="rw" placeholder=":: RW ::" title="RW" value="<?php echo($ds["rw"]); ?>" />
                </td>
                <td width='200px'>
                    <input type="text" name="kode_pos" placeholder=":: Kode Pos ::" title="Kode Pos" value="<?php echo($ds["kode_pos"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <input type="text" name="marga" placeholder=":: Marga ::" title="Marga" value="<?php echo($ds["marga"]); ?>" />
                </td>
                <td width='300px'>
                    <select name="id_suku">
                        <option value="0">:: Suku ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_suku ORDER BY suku ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_suku"] == $ds_cb["id_suku"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_suku"] ."'>" . $ds_cb["suku"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_suku"] ."'>" . $ds_cb["suku"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='300px'>
                    <select name="id_agama">
                        <option value="0">:: Agama ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_agama");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_agama"] == $ds_cb["id_agama"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_agama"] ."'>" . $ds_cb["agama"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_agama"] ."'>" . $ds_cb["agama"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='25%'>
                    <select name="id_provinsi" onchange="get_kabupaten(this.value);">
                        <option value="0">:: Provinsi ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_provinsi ORDER BY provinsi ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_provinsi"] == $ds_cb["id_provinsi"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_provinsi"] . "'>" . $ds_cb["provinsi"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_provinsi"] . "'>" . $ds_cb["provinsi"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='25%'>
                    <select name="id_kabupaten" id="id_kabupaten" onchange="get_kecamatan(this.value);">
                        <option value="0">:: Kabupaten ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_kabupaten WHERE id_provinsi='" . $ds["id_provinsi"] . "' ORDER BY kabupaten ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_kabupaten"] == $ds_cb["id_kabupaten"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_kabupaten"] . "'>" . $ds_cb["kabupaten"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_kabupaten"] . "'>" . $ds_cb["kabupaten"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='25%'>
                    <select name="id_kecamatan" id="id_kecamatan" onchange="get_kelurahan(this.value);">
                        <option value="0">:: Kecamatan ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_kecamatan WHERE id_kabupaten='" . $ds["id_kabupaten"] . "' ORDER BY kecamatan ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_kecamatan"] == $ds_cb["id_kecamatan"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_kecamatan"] . "'>" . $ds_cb["kecamatan"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_kecamatan"] . "'>" . $ds_cb["kecamatan"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='25%'>
                    <select name="id_kelurahan" id="id_kelurahan">
                        <option value="0">:: Kelurahan ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_kelurahan WHERE id_kecamatan='" . $ds["id_kecamatan"] . "' ORDER BY kelurahan ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_kelurahan"] == $ds_cb["id_kelurahan"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_kelurahan"] . "'>" . $ds_cb["kelurahan"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_kelurahan"] . "'>" . $ds_cb["kelurahan"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <input type="text" name="no_telp" placeholder=":: Nomor Telepon ::" title="Nomor Telepon" value="<?php echo($ds["no_telp"]); ?>" />
                </td>
                <td width='50%'>
                    <input type="text" name="no_hp" placeholder=":: Nomor HP ::" title="Nomor HP" value="<?php echo($ds["no_hp"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='20%'>
                    <input type="text" name="tinggi" placeholder=":: Tinggi ::" title="Tinggi" value="<?php echo($ds["tinggi"]); ?>" />
                </td>
                <td width='20%'>
                    <input type="text" name="berat" placeholder=":: Berat ::" title="Berat" value="<?php echo($ds["berat"]); ?>" />
                </td>
                <td width='20%'>
                    <select name="id_rambut">
                        <option value="0">:: Bentuk Rambut ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_rambut ORDER BY rambut ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_rambut"] == $ds_cb["id_rambut"])
                                    echo("<option selected value='" . $ds_cb["id_rambut"] . "'>" . $ds_cb["rambut"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_rambut"] . "'>" . $ds_cb["rambut"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='20%'>
                    <select name="id_bentuk_muka">
                        <option value="0">:: Bentuk Muka ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_bentuk_muka ORDER BY bentuk_muka ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_bentuk_muka"] == $ds_cb["id_bentuk_muka"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_bentuk_muka"] . "'>" . $ds_cb["bentuk_muka"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_bentuk_muka"] . "'>" . $ds_cb["bentuk_muka"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
                <td width='20%'>
                    <select name="id_warna_kulit">
                        <option value="0">:: Warna Kulit ::</option>
                        <?php
                            $res_cb = mysql_query("SELECT * FROM ref_warna_kulit ORDER BY warna_kulit ASC");
                            while($ds_cb = mysql_fetch_array($res_cb)){
                                if($ds["id_warna_kulit"] == $ds_cb["id_warna_kulit"])
                                    echo("<option selected='selected' value='" . $ds_cb["id_warna_kulit"] . "'>" . $ds_cb["warna_kulit"] . "</option>");
                                else
                                    echo("<option value='" . $ds_cb["id_warna_kulit"] . "'>" . $ds_cb["warna_kulit"] . "</option>");
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='34%'>
                    <input type="text" name="ciri_khas" placeholder=":: Ciri Khas ::" title="Ciri Khas" value="<?php echo($ds["ciri_khas"]); ?>" />
                </td>
                <td width='33%'>
                    <input type="text" name="cacat_tubuh" placeholder=":: Cacat Tubuh ::" title="Cacat Tubuh" value="<?php echo($ds["cacat_tubuh"]); ?>" />
                </td>
                <td width='33%'>
                    <input type="text" name="hobi" placeholder=":: Hobi ::" title="Hobi" value="<?php echo($ds["hobi"]); ?>" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" value="SIMPAN" style="width: 150px; height: 40px;" />
                    <input type="reset" value="RESET" style="width: 150px; height: 40px;" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>