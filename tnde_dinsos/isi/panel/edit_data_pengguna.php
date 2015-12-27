<?php
    $ds_pengguna = mysql_fetch_array(mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE id='" . $_GET["id"] . "'"));
    //echo("SELECT * FROM myapp_maintable_pengguna WHERE id='" . $_GET["id"] . "'");
    $ds_level = mysql_fetch_array(mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE id='" . $ds_pengguna["id_level"] . "'"));
?>
<form name="frm_a" id="frm_a" action="php/edit_data_pengguna.php" method="post" enctype="multipart/form-data">
    <div class="panelcontainer" style="width: 100%;">
        <h3>EDIT DATA PENGGUNA</h3>
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <?php
                    if(isset($_GET["err_code"])){
                ?>
                    <tr>
                        <td colspan="3"><span class="err_msg"><?php echo($_GET["err_code"]) ?></span></td>
                    </tr>
                <?php
                    }
                ?>
                <tr>
                    <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
                    <td width='20%'>Username</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="username" id="username" value="<?php echo($ds_pengguna["username"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Nama</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="nama" id="nama" value="<?php echo($ds_pengguna["nama"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>
                        Scan Tanda Tangan / Paraf<br /><span class="footnote">*) Kosongkan jika tidak ingin berubah</span><br />
                        <a href="ttd/<?php echo($ds_pengguna["ttd"]); ?>" target="_blank">Lihat Scan Tanda Tangan Saat Ini</a>
                    </td>
                    <td width='10px'>:</td>
                    <td><input type="file" name="ttd" /></td>
                </tr>
                <tr>
                    <td width='20%'>NIP</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="nip" id="nip" value="<?php echo($ds_pengguna["nip"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Nomor Kontak</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="kontak" id="kontak" value="<?php echo($ds_pengguna["kontak"]); ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Email</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="email" id="email" value="<?php echo($ds_pengguna["email"]); ?>" /></td>
                </tr>
                <?php
                    if($ds_level["urutan"] == 4){
                ?>
                <tr>
                    <td width='20%'>Atasan Kasubbid Langsung</td>
                    <td width='10px'>:</td>
                    <td>
                        <select name="level_kasubbid" style="text-transform: capitalize;">
                            <option value="0">:: Pilih Kasubbid Atasan Langsung ::</option>
                        <?php
                            $res_kasubbid = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE urutan=3 AND atasan='" . $ds_level["atasan"] . "'");
                            while($ds_kasubbid = mysql_fetch_array($res_kasubbid)){
                                if($ds_pengguna["level_kasubbid"] == $ds_kasubbid["id"]){
                        ?>
                                    <option value="<?php echo($ds_kasubbid["id"]); ?>" selected="selected"><?php echo($ds_kasubbid["level"]); ?></option>
                        <?php
                                }else{
                        ?>
                                    <option value="<?php echo($ds_kasubbid["id"]); ?>"><?php echo($ds_kasubbid["level"]); ?></option>
                        <?php
                                    
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <?php
                    }
                ?>
                
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='50%'>
                <tr>
                    <td width='30%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='30%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                    <td width='30%'><input type="button" value="Kembali" onclick="document.location.href='?mod=cp_pengguna';" style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<div class="kelang"></div>
<form name="frm_a" id="frm_a" action="php/edit_level_pengguna.php" method="post" enctype="multipart/form-data">
    <div class="panelcontainer" style="width: 100%;">
        <h3>UNTUK MERUBAH LEVEL PENGGUNA, LAKUKAN DARI PANEL INI</h3>
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Atasan Kasubbid Langsung</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>" />
                        <select name="id_level" style="text-transform: capitalize;">
                            <option value="0">:: Pilih Level ::</option>
                        <?php
                            $res_level = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE id <> 18 AND id <> 19 AND id <> 24");
                            while($ds_level = mysql_fetch_array($res_level)){
                                if($ds_pengguna["id_level"] == $ds_level["id"]){
                        ?>
                                    <option value="<?php echo($ds_level["id"]); ?>" selected="selected"><?php echo($ds_level["level"]); ?></option>
                        <?php
                                }else{
                        ?>
                                    <option value="<?php echo($ds_level["id"]); ?>"><?php echo($ds_level["level"]); ?></option>
                        <?php
                                    
                                }
                            }
                        ?>
                        </select>
                    </td>
                  </tr>   
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='50%'>
                <tr>
                    <td width='30%'><input type="submit" value='Simpan' style="width: 100%;" /></td>
                    <td width='30%'><input type="reset" value='Reset' style="width: 100%;" /></td>
                    <td width='30%'><input type="button" value="Kembali" onclick="document.location.href='?mod=cp_pengguna';" style="width: 100%;" /></td>
                </tr>
            </table>
        </div>
    </div>
</form>