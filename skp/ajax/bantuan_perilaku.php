<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    $res = mysql_query("SELECT * FROM ref_bantuan_perilaku WHERE urut='" . $_GET["urut"] . "' ORDER BY id_bantuan_perilaku ASC");
    echo("<table cellspacing='0' cellpadding='5' width='100%' border='1' style='border-collapse:collapse; font-family: sans-serif; font-size: 10pt;'>");
    $no=0;
    while($ds = mysql_fetch_array($res)){
        $no++;
        echo("<tr>");
            echo("<td width='40px' align='center'>" . $no . "</td>");
            echo("<td>" . $ds["keterangan"] . "</td>");
            echo("<td width='50px' align='center'>");
                echo("<select id='cbh_" . $ds["id_bantuan_perilaku"] . "'>");
                for($i=$ds["dari"]; $i<=$ds["sampai"]; $i++)
                    echo("<option value='" . $i . "'>" . $i . "</option>");
                echo("</select>");
            echo("</td>");
            echo("<td width='50px' align='center'>");
                echo("<input type='button' value='Pilih' style='width: 100%;' onclick='pilihbp(" . $ds["id_bantuan_perilaku"] . ", " . $_GET["urut"] . ");' />");
            echo("</td>");
        echo("</tr>");
    }
    echo("</table>");
?>