$sekre = " (a.id_level_tujuan = 2 OR a.id_level_tujuan = 7 OR a.id_level_tujuan = 8 OR a.id_level_tujuan = 9 OR a.id_level_tujuan = 25)";
        $kenpang = " (a.id_level_tujuan = 3 OR a.id_level_tujuan = 10 OR a.id_level_tujuan = 11 OR a.id_level_tujuan = 20)";
        $kesdip = " (a.id_level_tujuan = 4 OR a.id_level_tujuan = 12 OR a.id_level_tujuan = 13 OR a.id_level_tujuan = 21)";
        $pengkar = " (a.id_level_tujuan = 5 OR a.id_level_tujuan = 14 OR a.id_level_tujuan = 15 OR a.id_level_tujuan = 22)";
        $pengpem = " (a.id_level_tujuan = 6 OR a.id_level_tujuan = 16 OR a.id_level_tujuan = 17 OR a.id_level_tujuan = 23)";
        $tmbh = "";
        if($_SESSION["id_level"] == 3 || $_SESSION["id_level"] == 4 || $_SESSION["id_level"] == 5 || $_SESSION["id_level"] == 6){
            if($_SESSION["id_level"] == 3)
                $tmbh = $kenpang;
            else if($_SESSION["id_level"] == 4)
                $tmbh = $kesdip;
            else if($_SESSION["id_level"] == 5)
                $tmbh = $pengkar;
            else if($_SESSION["id_level"] == 6)
                $tmbh = $pengpem;
        }else{
            //echo("KESINI");
            if($_SESSION["atasan"] == 2)
                $tmbh = $sekre;
            else if($_SESSION["atasan"] == 3)
                $tmbh = $kenpang;
            else if($_SESSION["atasan"] == 4)
                $tmbh = $kesdip;
            else if($_SESSION["atasan"] == 5)
                $tmbh = $pengkar;
            else if($_SESSION["atasan"] == 6)
                $tmbh = $pengpem;
        }