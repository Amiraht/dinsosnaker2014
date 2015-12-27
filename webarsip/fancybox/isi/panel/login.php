<form name="frmlogin" action="php/login.php" method="post">
<center>
    <div class="panelcontainer" style="width: 600px; margin: 50px 0px;">
        <h3>LOGIN PENGGUNA</h3>
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
                    <td width='20%'>Username</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="username" /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="checkbox" name="admin" /> Ceklist jika anda adalah Administrator Arsip</td>
                </tr>
            </table>
            <br />
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='50%'><input type="submit" value='Login' style="width: 100%;" /></td>
                    <td width='50%'><input type="button" value='Daftar Pengguna' style="width: 100%; display: none;" onclick="document.location.href='?mod=daftar_pengguna';" /></td>
                </tr>
            </table>
        </div>
    </div>
</center>
</form>