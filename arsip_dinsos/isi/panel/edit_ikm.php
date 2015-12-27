<input type="button" style="padding: 2px 10px;" value="Kembali" onclick='document.location.href="?mod=mnu_ikm";' />
<div class="kelang"></div>
<?php
    $res = mysql_query("SELECT * FROM tbl_jawaban_ikm WHERE id_anggota = " . $_SESSION["id_pengguna"] . " AND YEAR(tanggal) = YEAR(CURDATE())");
    if(mysql_num_rows($res) > 0){
        $ds = mysql_fetch_array($res);
?>
<form name="frm" action="php/edit_ikm.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>EDIT HASIL SURVEY INDEKS KEPUASAN MASYARAKAT</h3>
        <div class="bodypanel" id="bodyfilter">
            <ol>
                <li class="ikm">
                    Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di Unit Ini?
                    <div><input type="radio" name="a" value="1" <?php if($ds["a"]==1){echo("checked='checked'");} ?> /> Tidak Mudah</div>
                    <div><input type="radio" name="a" value="2" <?php if($ds["a"]==2){echo("checked='checked'");} ?> /> Kurang Mudah</div>
                    <div><input type="radio" name="a" value="3" <?php if($ds["a"]==3){echo("checked='checked'");} ?> /> Mudah</div>
                    <div><input type="radio" name="a" value="4" <?php if($ds["a"]==4){echo("checked='checked'");} ?> /> Sangat Mudah</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kesamaan persyaratan pelayanan dengan jenis pelayanannya?
                    <div><input type="radio" name="b" value="1" <?php if($ds["b"]==1){echo("checked='checked'");} ?> /> Tidak Sesuai</div>
                    <div><input type="radio" name="b" value="2" <?php if($ds["b"]==2){echo("checked='checked'");} ?> /> Kurang Sesuai</div>
                    <div><input type="radio" name="b" value="3" <?php if($ds["b"]==3){echo("checked='checked'");} ?> /> Sesuai</div>
                    <div><input type="radio" name="b" value="4" <?php if($ds["b"]==4){echo("checked='checked'");} ?> /> Sangat Sesuai</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kejelasan dan kepastian petugas yang melayani?
                    <div><input type="radio" name="c" value="1" <?php if($ds["c"]==1){echo("checked='checked'");} ?> /> Tidak Jelas</div>
                    <div><input type="radio" name="c" value="2" <?php if($ds["c"]==2){echo("checked='checked'");} ?> /> Kurang Jelas</div>
                    <div><input type="radio" name="c" value="3" <?php if($ds["c"]==3){echo("checked='checked'");} ?> /> Jelas</div>
                    <div><input type="radio" name="c" value="4" <?php if($ds["c"]==4){echo("checked='checked'");} ?> /> Sangat Jelas</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kedisiplinan petugas dalam memberikan pelayanan?
                    <div><input type="radio" name="d" value="1" <?php if($ds["d"]==1){echo("checked='checked'");} ?> /> Tidak Disiplin</div>
                    <div><input type="radio" name="d" value="2" <?php if($ds["d"]==2){echo("checked='checked'");} ?> /> Kurang Disiplin</div>
                    <div><input type="radio" name="d" value="3" <?php if($ds["d"]==3){echo("checked='checked'");} ?> /> Disiplin</div>
                    <div><input type="radio" name="d" value="4" <?php if($ds["d"]==4){echo("checked='checked'");} ?> /> Sangat Disiplin</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang tanggung jawab petugas dalam memberikan pelayanan?
                    <div><input type="radio" name="e" value="1" <?php if($ds["e"]==1){echo("checked='checked'");} ?> /> Tidak Bertanggung Jawab</div>
                    <div><input type="radio" name="e" value="2" <?php if($ds["e"]==2){echo("checked='checked'");} ?> /> Kurang Bertanggung Jawab</div>
                    <div><input type="radio" name="e" value="3" <?php if($ds["e"]==3){echo("checked='checked'");} ?> /> Bertanggung Jawab</div>
                    <div><input type="radio" name="e" value="4" <?php if($ds["e"]==4){echo("checked='checked'");} ?> /> Sangat Bertanggung Jawab</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kemampuan petugas dalam memberikan pelayanan?
                    <div><input type="radio" name="f" value="1" <?php if($ds["f"]==1){echo("checked='checked'");} ?> /> Tidak Mampu</div>
                    <div><input type="radio" name="f" value="2" <?php if($ds["f"]==2){echo("checked='checked'");} ?> /> Kurang Mampu</div>
                    <div><input type="radio" name="f" value="3" <?php if($ds["f"]==3){echo("checked='checked'");} ?> /> Mampu</div>
                    <div><input type="radio" name="f" value="4" <?php if($ds["f"]==4){echo("checked='checked'");} ?> /> Sangat Mampu</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kecepatan Pelayanan di unit Ini?
                    <div><input type="radio" name="g" value="1" <?php if($ds["g"]==1){echo("checked='checked'");} ?> /> Tidak Cepat</div>
                    <div><input type="radio" name="g" value="2" <?php if($ds["g"]==2){echo("checked='checked'");} ?> /> Kurang Cepat</div>
                    <div><input type="radio" name="g" value="3" <?php if($ds["g"]==3){echo("checked='checked'");} ?> /> Cepat</div>
                    <div><input type="radio" name="g" value="4" <?php if($ds["g"]==4){echo("checked='checked'");} ?> /> Sangat Cepat</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang keadilan untuk mendapatkan pelayanan disini?
                    <div><input type="radio" name="h" value="1" <?php if($ds["h"]==1){echo("checked='checked'");} ?> /> Tidak Adil</div>
                    <div><input type="radio" name="h" value="2" <?php if($ds["h"]==2){echo("checked='checked'");} ?> /> Kurang Adil</div>
                    <div><input type="radio" name="h" value="3" <?php if($ds["h"]==3){echo("checked='checked'");} ?> /> Adil</div>
                    <div><input type="radio" name="h" value="4" <?php if($ds["h"]==4){echo("checked='checked'");} ?> /> Sangat Adil</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kesopanan dan keramahan petugas dalam memberikan pelayanan?
                    <div><input type="radio" name="i" value="1" <?php if($ds["i"]==1){echo("checked='checked'");} ?> /> Tidak Sopan dan Ramah</div>
                    <div><input type="radio" name="i" value="2" <?php if($ds["i"]==2){echo("checked='checked'");} ?> /> Kurang Sopan dan Ramah</div>
                    <div><input type="radio" name="i" value="3" <?php if($ds["i"]==3){echo("checked='checked'");} ?> /> Sopan dan Ramah</div>
                    <div><input type="radio" name="i" value="4" <?php if($ds["i"]==4){echo("checked='checked'");} ?> /> Sangat Sopan dan Ramah</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kewajaran biaya untuk mendapatkan pelayanan?
                    <div><input type="radio" name="j" value="1" <?php if($ds["j"]==1){echo("checked='checked'");} ?> /> Tidak Wajar</div>
                    <div><input type="radio" name="j" value="2" <?php if($ds["j"]==2){echo("checked='checked'");} ?> /> Kurang Wajar</div>
                    <div><input type="radio" name="j" value="3" <?php if($ds["j"]==3){echo("checked='checked'");} ?> /> Wajar</div>
                    <div><input type="radio" name="j" value="4" <?php if($ds["j"]==4){echo("checked='checked'");} ?> /> Sangat Wajar</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kesesuaian antara biaya yang dibayarkan dengan biaya yang telah ditetapkan?
                    <div><input type="radio" name="k" value="1" <?php if($ds["k"]==1){echo("checked='checked'");} ?> /> Selalu Tidak Sesuai</div>
                    <div><input type="radio" name="k" value="2" <?php if($ds["k"]==2){echo("checked='checked'");} ?> /> Kadang-Kadang Sesuai</div>
                    <div><input type="radio" name="k" value="3" <?php if($ds["k"]==3){echo("checked='checked'");} ?> /> Banyak Sesuai</div>
                    <div><input type="radio" name="k" value="4" <?php if($ds["k"]==4){echo("checked='checked'");} ?> /> Selalu Sesuai</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang ketepatan pelaksanaan terhadap jadwal waktu pelayanan?
                    <div><input type="radio" name="l" value="1" <?php if($ds["l"]==1){echo("checked='checked'");} ?> /> Selalu Tidak Tepat</div>
                    <div><input type="radio" name="l" value="2" <?php if($ds["l"]==2){echo("checked='checked'");} ?> /> Kadang-Kadang Tepat</div>
                    <div><input type="radio" name="l" value="3" <?php if($ds["l"]==3){echo("checked='checked'");} ?> /> Banyak Tepatnya</div>
                    <div><input type="radio" name="l" value="4" <?php if($ds["l"]==4){echo("checked='checked'");} ?> /> Selalu Tepat</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kenyamanan di lingkungan unit pelayanan?
                    <div><input type="radio" name="m" value="1" <?php if($ds["m"]==1){echo("checked='checked'");} ?> /> Tidak Nyaman</div>
                    <div><input type="radio" name="m" value="2" <?php if($ds["m"]==2){echo("checked='checked'");} ?> /> Kurang Nyaman</div>
                    <div><input type="radio" name="m" value="3" <?php if($ds["m"]==3){echo("checked='checked'");} ?> /> Nyaman</div>
                    <div><input type="radio" name="m" value="4" <?php if($ds["m"]==4){echo("checked='checked'");} ?> /> Sangat Nyaman</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang keamanan pelayanan di unit ini?
                    <div><input type="radio" name="n" value="1" <?php if($ds["n"]==1){echo("checked='checked'");} ?> /> Tidak Aman</div>
                    <div><input type="radio" name="n" value="2" <?php if($ds["n"]==2){echo("checked='checked'");} ?> /> Kurang Aman</div>
                    <div><input type="radio" name="n" value="3" <?php if($ds["n"]==3){echo("checked='checked'");} ?> /> Aman</div>
                    <div><input type="radio" name="n" value="4" <?php if($ds["n"]==4){echo("checked='checked'");} ?> /> Sangat Aman</div>
                </li>
            </ol>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='50%'>
                <tr>
                    <td width='33%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='33%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<?php
    }else{
?>
<form name="frm" action="php/ikm.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>PENGISIAN INDEKS KEPUASAN MASYARAKAT</h3>
        <div class="bodypanel" id="bodyfilter">
        <div style="font-family:  sans-serif; font-size: 10pt; text-align: center;">Anda belum mengisi survey Indeks Kepuasan Masyarakat untuk tahun ini. Silahkan klik menu Input pada menu sebelumnya</div>
        <!--<div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
                <tr>
                    <td width='33%'><input type="button" value='Lihat Hasil Survey IKM' style="width: 100%;" onclick="document.location.href='?mod=hasil_ikm';" /></td>
                </tr>
            </table>
        </div>-->
    </div>
</form>
<?php
    }
?>

