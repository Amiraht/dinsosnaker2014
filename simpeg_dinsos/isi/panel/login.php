<form name="frmlogin" action="php/login.php" method="post">
<center>
    <div class="panelcontainer" style="width: 600px; margin: 50px 0px;">
        <h3 style="text-align: left; background-color: green; color:white;">LOGIN SISTEM PEGAWAI</h3>
        <div class="bodypanel">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <?php
                    if(isset($_GET["err_code"])){
                ?>
						<tr>
							<td colspan="3"><span class="err_msg"><?php echo($_GET["err_code"]) ?></span></td>
						</tr>
                <?php
                    }else if(isset($_GET['galog']) && $_GET['galog'] == 1){
				?>		
						<div class="alert alert-info" role="alert">
							<strong>Maaf !!!</strong> Username dan password tidak ditemukan
						</div>
				<?php	
					}
                ?>
                 <tr>
                    <td width='20%'><b>Username</b></td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="username" /></td>
                </tr>
                <tr>
                    <td><b>Password</b></td>
                    <td>:</td>
                    <td><input type="password" name="password" /></td>
                </tr><br/>
				 <tr>
                    <td>&nbsp;</td>
					<td>&nbsp;</td>
                    <td><input type="checkbox" name="remember">&nbsp;Ingat Saya</td>
                </tr><br/>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                    <td><button type="submit" class="btn btn-success btn-default">Proses Login</button>&nbsp;
						<button type="reset" class="btn btn-info btn-default" width='180px'>Reset</button>
					</td>
                </tr>
            </table>
          
        </div>
    </div>
</center>
</form>