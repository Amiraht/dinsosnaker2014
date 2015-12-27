<?php
    $ds_pengguna = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pengguna WHERE id_user='" . $_SESSION["simpeg_id_pengguna"] . "'"));
?>
<form method="post" name="frm" action="php/pengguna/mod_1_2.php" enctype="multipart/form-data" id="frm">
<div class="row">
    <div class="col-sm-4" style="width: 100%;">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Pengaturan Akun</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-warning" role="alert">
                <strong>Perhatian!</strong> Khusus untuk pegawai PNS dan CPNS, username harus berupa NIP
                dan tidak boleh diubah.
            </div>
          <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Username :</label>
                    <div class="label_caption"><?php echo($ds_pengguna["username"]); ?></div><br />
                </td>
            </tr>
          </table>
          <br />
          <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Password Lama :</label>
                    <input type="password" name="password" id="password" placeholder=":: Password Lama ::" />
                </td>
            </tr>
          </table>
          <br />
          <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Masukkan Password Baru :</label>
                    <input type="password" name="password_baru_1" id="password_baru_1" placeholder=":: Masukkan Password Baru ::" />
                </td>
            </tr>
          </table>
          <br />
          <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Masukkan Password Baru Sekali Lagi :</label>
                    <input type="password" name="password_baru_2" id="password_baru_2" placeholder=":: Masukkan Password Baru Sekali Lagi ::" />
                </td>
            </tr>
          </table>
          <br />
          <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <button type="submit" class="btn btn-lg btn-success">Simpan</button>
                    <button type="reset" class="btn btn-lg btn-default">Reset</button>
                </td>
            </tr>
          </table>
          <br />
          <?php
                if(isset($_GET["err_msg"])){
          ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Perhatian!</strong> <?php echo($_GET["err_msg"]); ?>
                </div>
          <?php
                }
                if(isset($_GET["success_msg"])){
          ?>
                <div class="alert alert-success" role="alert">
                    <strong>Berhasil!</strong> <?php echo($_GET["success_msg"]); ?>
                </div>
          <?php
                }
          ?>
        </div>
      </div>
    </div>
</div>
</form>