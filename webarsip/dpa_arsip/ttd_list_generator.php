<?php
    for($i=0; $i<$_GET["jml"]; $i++){
        echo trim("
            <tr>
                <td align='center'>" . ($i+1) . "</td>
                <td align='center'><input type='text' name='kolom_ttd_" . $i . "' /></td>
                <td align='center'><input type='text' name='nama_ttd_" . $i . "' /></td>
                <td align='center'><input type='text' name='nip_ttd_" . $i . "' /></td>
                <td align='center'><input type='text' name='jabatan_ttd_" . $i . "' /></td>
                <td align='center'><input type='text' name='pangkat_ttd_" . $i . "' /></td>
            </tr>
        ");
    }
?>