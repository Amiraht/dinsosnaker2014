<script type="text/javascript">
function gocari(){
    frmcari.submit();
}
function gostep2(id_anggota){
    jConfirm("Dengan klik OK/YES, artinya anda akan mencetak " +
                "dan menyerahkan kartu anggota ini kepada anggota yang bersangkutan. " +
                "jika anda ingin mencetak kartu anggota ini lagi, silahkan melalui menu cetak ulang kartu anggota. " +
                "anda yakin akan mencetak dan menyerahkan kartu anggota?", "PERHATIAN", function(r){
                    if(r)
                        window.open("php/kartu_anggota.php?id_anggota=" + id_anggota);
                });
}

</script>
<div class="judulnav">PILIH ANGGOTA YANG AKAN DICETAK ULANG KARTU ANGGOTA</div>
<div class="kelang"></div>
<form method="POST" action="?mod=pemesanan_1" name="frmcari">
    <div class="caption"><label>NAMA ANGGOTA</label></div>
	<div class="control"><input type="text" name="nama" /></div>
    <div class="caption"><label>ALAMAT</label></div>
	<div class="control"><input type="text" name="alamat" /></div>
    <div class="kelang"></div>
    <div class="control"><input type="button" value="CARI" class="tombol" onclick="gocari();"></div>
</form>
<div class="tabledata">
    <table width="100%" border="0px" cellspacing="0" cellpadding="0">
        <tr class="header">
            <td width="50px">No.</td>
            <td>Nama Anggota</td>
            <td>Alamat</td>
            <td>No. Telp</td>
            <td>&nbsp;</td>
        </tr>
        <?php
            $nama = "";
            $alamat = "";
            if(isset($_POST["nama"]) && isset($_POST["alamat"])){
                $nama = $_POST["nama"];
                $alamat = $_POST["alamat"];
            }
            $sql = "SELECT * FROM tbl_anggota WHERE nama LIKE '%" . $nama . "%' AND alamat LIKE '%" . $alamat . "%' AND dicetak>0 ORDER BY nama ASC";
            $res = mysql_query($sql);
            $i = 0;
            while($ds = mysql_fetch_array($res)){
                $i++;
                echo("<tr class='data'>");
                    echo("<td align='center'>" . $i . "</td>");
                    echo("<td>" . $ds["nama"] . "</td>");
                    echo("<td>" . $ds["alamat"] . "</td>");
                    echo("<td>" . $ds["telp"] . "</td>");
                    echo("<td align='center'><img alt='Lanjut' src='image/Button Next_32.png' width='18px' class='icondata' onclick='gostep2(" . $ds["id_anggota"] . ")'></td>");
                echo("</tr>");
            }
        ?>
    </table>
</div>
<ul class="nav">
	<li><a href="?mod=">MENU UTAMA</a></li>
</ul>