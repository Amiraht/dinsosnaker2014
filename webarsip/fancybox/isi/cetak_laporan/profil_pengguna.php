<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("../../php/dompdf_config.inc.php"); ?>
<?php require_once("../../php/koneksi.php"); ?>
<?php require_once("../../php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT
                                        	a.*, b.jenis_kelamin, c.level, d.unit_kerja
                                        FROM
                                        	tbl_anggota_arsip a
                                        	LEFT JOIN ref_jenis_kelamin b ON a.id_jenis_kelamin = b.id_jenis_kelamin
                                        	LEFT JOIN ref_level_pengguna c ON a.id_level_pengguna = c.id_level
                                        	LEFT JOIN ref_unit_kerja d ON a.id_unit_kerja = d.id_unit_kerja
                                        WHERE
                                        	a.id_anggota = '" . $_SESSION["id_pengguna"] . "'"));
    // buat foto nya
    $file = fopen("../../uploaded/foto_" . $_SESSION["id_pengguna"] . ".png", "w");
    fwrite($file, $ds["foto"]);
    fclose($file);
    $html = "
    <table width='100%' border='0px' cellspacing='0' cellpadding='3'>
        <tr>
            <td width='30%'><h3>FOTO</h3></td>
            <td><h3>PROFIL ANGGOTA</h3></td>
        </tr>
        <tr>
            <td width='30%' valign='top'><img src='../../uploaded/foto_" . $_SESSION["id_pengguna"] . ".png'></td>
            <td>
                <table width='100%' border='0px' cellspacing='0' cellpadding='3' style='font-family: verdana; font-size: 9pt;'>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Nomor ID</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["no_id"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Username</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["username"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Nama Lengkap</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["nama_lengkap"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Jenis Kelamin</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["jenis_kelamin"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Tanggal Lahir</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["tgl_lahir"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Alamat</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["alamat"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>No. Kontak</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["no_kontak"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Email</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["email"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Level Pengguna</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["level"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Pekerjaan</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["pekerjaan"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Instansi Bekerja</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["unit_kerja"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Alamat Instansi</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["alamat_unit_kerja"] . "</td>
                    </tr>
                    <tr>
                        <td width='40%' style='border-bottom: solid 0px #CCC; text-transform: uppercase; font-weight: bold'>Jabatan</td>
                        <td width='5px' style='border-bottom: solid 0px #CCC;'>:</td>
                        <td style='border-bottom: solid 1px #CCC; text-transform: capitalize; font-style: italic;'>" . $ds["jabatan"] . "</td>
                    </tr>
                </table>
            </td>
        </tr>
    ";
    
    $html .= "</table>";
         
?>

<?php
    $dompdf = new DOMPDF();
      $dompdf->load_html($html);
      $dompdf->set_paper("a4", "portrait");
      $dompdf->render();
    
      $dompdf->stream("output.pdf", array("Attachment" => false));
      unlink("../../uploaded/foto_" . $_SESSION["id_pengguna"] . ".png");
      exit(0);
      //echo($html);
?>