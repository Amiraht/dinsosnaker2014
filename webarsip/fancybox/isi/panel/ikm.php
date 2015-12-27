<input type="button" style="padding: 2px 10px;" value="Kembali" onclick='document.location.href="?mod=mnu_ikm";' />
<div class="kelang"></div>
<?php
    $res = mysql_query("SELECT * FROM tbl_jawaban_ikm WHERE id_anggota = " . $_SESSION["id_pengguna"] . " AND YEAR(tanggal) = YEAR(CURDATE())");
    if(mysql_num_rows($res) == 0){
?>
<form name="frm" action="php/ikm.php" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3>PENGISIAN INDEKS KEPUASAN MASYARAKAT</h3>
        <div class="bodypanel" id="bodyfilter">
            <ol>
                <li class="ikm">
                    Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di Unit Ini?
                    <div><input type="radio" name="a" value="1" /> Tidak Mudah</div>
                    <div><input type="radio" name="a" value="2" /> Kurang Mudah</div>
                    <div><input type="radio" name="a" value="3" /> Mudah</div>
                    <div><input type="radio" name="a" value="4" /> Sangat Mudah</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kesamaan persyaratan pelayanan dengan jenis pelayanannya?
                    <div><input type="radio" name="b" value="1" /> Tidak Sesuai</div>
                    <div><input type="radio" name="b" value="2" /> Kurang Sesuai</div>
                    <div><input type="radio" name="b" value="3" /> Sesuai</div>
                    <div><input type="radio" name="b" value="4" /> Sangat Sesuai</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kejelasan dan kepastian petugas yang melayani?
                    <div><input type="radio" name="c" value="1" /> Tidak Jelas</div>
                    <div><input type="radio" name="c" value="2" /> Kurang Jelas</div>
                    <div><input type="radio" name="c" value="3" /> Jelas</div>
                    <div><input type="radio" name="c" value="4" /> Sangat Jelas</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kedisiplinan petugas dalam memberikan pelayanan?
                    <div><input type="radio" name="d" value="1" /> Tidak Disiplin</div>
                    <div><input type="radio" name="d" value="2" /> Kurang Disiplin</div>
                    <div><input type="radio" name="d" value="3" /> Disiplin</div>
                    <div><input type="radio" name="d" value="4" /> Sangat Disiplin</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang tanggung jawab petugas dalam memberikan pelayanan?
                    <div><input type="radio" name="e" value="1" /> Tidak Bertanggung Jawab</div>
                    <div><input type="radio" name="e" value="2" /> Kurang Bertanggung Jawab</div>
                    <div><input type="radio" name="e" value="3" /> Bertanggung Jawab</div>
                    <div><input type="radio" name="e" value="4" /> Sangat Bertanggung Jawab</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kemampuan petugas dalam memberikan pelayanan?
                    <div><input type="radio" name="f" value="1" /> Tidak Mampu</div>
                    <div><input type="radio" name="f" value="2" /> Kurang Mampu</div>
                    <div><input type="radio" name="f" value="3" /> Mampu</div>
                    <div><input type="radio" name="f" value="4" /> Sangat Mampu</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kecepatan Pelayanan di unit Ini?
                    <div><input type="radio" name="g" value="1" /> Tidak Cepat</div>
                    <div><input type="radio" name="g" value="2" /> Kurang Cepat</div>
                    <div><input type="radio" name="g" value="3" /> Cepat</div>
                    <div><input type="radio" name="g" value="4" /> Sangat Cepat</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang keadilan untuk mendapatkan pelayanan disini?
                    <div><input type="radio" name="h" value="1" /> Tidak Adil</div>
                    <div><input type="radio" name="h" value="2" /> Kurang Adil</div>
                    <div><input type="radio" name="h" value="3" /> Adil</div>
                    <div><input type="radio" name="h" value="4" /> Sangat Adil</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kesopanan dan keramahan petugas dalam memberikan pelayanan?
                    <div><input type="radio" name="i" value="1" /> Tidak Sopan dan Ramah</div>
                    <div><input type="radio" name="i" value="2" /> Kurang Sopan dan Ramah</div>
                    <div><input type="radio" name="i" value="3" /> Sopan dan Ramah</div>
                    <div><input type="radio" name="i" value="4" /> Sangat Sopan dan Ramah</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kewajaran biaya untuk mendapatkan pelayanan?
                    <div><input type="radio" name="j" value="1" /> Tidak Wajar</div>
                    <div><input type="radio" name="j" value="2" /> Kurang Wajar</div>
                    <div><input type="radio" name="j" value="3" /> Wajar</div>
                    <div><input type="radio" name="j" value="4" /> Sangat Wajar</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kesesuaian antara biaya yang dibayarkan dengan biaya yang telah ditetapkan?
                    <div><input type="radio" name="k" value="1" /> Selalu Tidak Sesuai</div>
                    <div><input type="radio" name="k" value="2" /> Kadang-Kadang Sesuai</div>
                    <div><input type="radio" name="k" value="3" /> Banyak Sesuai</div>
                    <div><input type="radio" name="k" value="4" /> Selalu Sesuai</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang ketepatan pelaksanaan terhadap jadwal waktu pelayanan?
                    <div><input type="radio" name="l" value="1" /> Selalu Tidak Tepat</div>
                    <div><input type="radio" name="l" value="2" /> Kadang-Kadang Tepat</div>
                    <div><input type="radio" name="l" value="3" /> Banyak Tepatnya</div>
                    <div><input type="radio" name="l" value="4" /> Selalu Tepat</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang kenyamanan di lingkungan unit pelayanan?
                    <div><input type="radio" name="m" value="1" /> Tidak Nyaman</div>
                    <div><input type="radio" name="m" value="2" /> Kurang Nyaman</div>
                    <div><input type="radio" name="m" value="3" /> Nyaman</div>
                    <div><input type="radio" name="m" value="4" /> Sangat Nyaman</div>
                </li>
                <li class="ikm">
                    Bagaimana pendapat Saudara tentang keamanan pelayanan di unit ini?
                    <div><input type="radio" name="n" value="1" /> Tidak Aman</div>
                    <div><input type="radio" name="n" value="2" /> Kurang Aman</div>
                    <div><input type="radio" name="n" value="3" /> Aman</div>
                    <div><input type="radio" name="n" value="4" /> Sangat Aman</div>
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
        <div style="font-family:  sans-serif; font-size: 10pt; text-align: center;">Anda telah mengisi survey Indeks Kepuasan Masyarakat Untuk Tahun Ini. Survey Indeks Kepuasan Masyarakat
        hanya bisa diisi 1 kali dalam setahun.<br />Atau jika anda ingin mengedit hasil pengisian survey Indeks Kepuasan Masyarakat
        anda tahun ini, silahkan klik Edit pada menu sebelumnya</div>
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

