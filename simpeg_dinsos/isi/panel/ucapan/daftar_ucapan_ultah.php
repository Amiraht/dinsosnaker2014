<script type="text/javascript">
function edit(id_data){
    document.location.href='?mod=ucapan_ultah_edit&id_data=' + id_data;
}

function hapus(id_data){
    jConfirm("Hapus data pesan dengan ID "+id_data+" ?", "PERHATIAN", function(r){
       if(r){
            document.location.href="php/ucapan/ucapan_ultah_hapus.php?id_data=" + id_data;
        } 
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PESAN-PESAN UCAPAN SELAMAT ULANG TAHUN PEGAWAI USER SIMPEG</h3>
    <div class="bodypanel">
        <input type="button" value="KEMBALI" onclick="document.location.href='?mod="/>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='200px'>Pengirim</th>
				<th width='200px'>Penerima</th>
                <th>Teks Pesan</th>
                <th width='150px'>Tgl. Kirim</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$sql = "SELECT 
						a.*, b.nama_pegawai as 'dari', c.nama_pegawai as 'tujuan'
					FROM tbl_ucapan_ultah_pegawai a
							 LEFT JOIN tbl_pegawai b ON a.dari = b.id_pegawai
							 LEFT JOIN tbl_pegawai c ON a.tujuan = c.id_pegawai
					ORDER BY
						a.id_pesan ASC
			";
            $res = mysql_query($sql) or die(mysql_error());
            $no = 0;
				while($ds = mysql_fetch_array($res)){
					$no++;
					echo("<tr>");
						echo("<td align='center'>" . $no . "</td>");
						echo("<td align='center'>" . ($ds["dari"] == "" ? "Admin" : $ds["dari"]) . "</td>");
						echo("<td align='center'>" . ($ds["tujuan"] == "" ? "Admin" : $ds["tujuan"]) . "</td>");
						echo("<td  align='justify'>" . ($ds["pesan"] == "" ? "PESAN KOSONG" : $ds["pesan"]) . "</td>");
						echo("<td  align='center'>" .($ds["tgl_post"]) . "</td>");
						echo("<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='edit(" . $ds["id_pesan"] . ");' />
							</td>");
						echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus' onclick='hapus(" . $ds["id_pesan"] . ");' />
                        </td>");
					echo("</tr>");
				}	
        ?>
        </tbody>
        </table>
    </div>
</div>