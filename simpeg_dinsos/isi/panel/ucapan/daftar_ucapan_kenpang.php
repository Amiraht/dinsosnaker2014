<script type="text/javascript">
function edit(id_data){
    document.location.href='?mod=ucapan_kenpang_edit&id_pesan=' + id_data;
}

function hapus(id_data){
    jConfirm("Hapus data pesan dengan ID "+id_data+" ?", "PERHATIAN", function(r){
       if(r){
            //document.location.href="php/ucapan/ucapan_kenpang_hapus.php?id_pesan=" + id_data;
			$.get("php/ucapan/ucapan_kenpang_hapus.php", {id_pesan : id_data},
						function(data){
							$('#notifikasi').show();
							$('#notifikasi').html(data);
						}
			);
        } 
    });
}
function kembali(){
	document.location.href = "?mod=ucapan_kenaikan_pangkat";
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PESAN TERKIRIM UCAPAN SELAMAT KENAIKAN PANGKAT PEGAWAI</h3>
	<div id='notifikasi' style='display:none;'>
	</div><br/>
    <div class="bodypanel">
        <input type="button" value="KEMBALI" onclick="kembali();"/>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
				<th width='200px'>Dikirim Ke</th>
                <th>Teks Pesan</th>
                <th width='150px'>Tgl. Kirim</th>
				<th width='120px'>Status</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$sql = "SELECT 
						a.*, b.nama as 'tujuan', b.username
					FROM tbl_ucapan_naik_pangkat a
							 LEFT JOIN tbl_pengguna b ON a.tujuan = b.username
					WHERE 
						a.dari = '".$_SESSION['simpeg_id_pegawai']."'
					ORDER BY
						a.id_pesan DESC
			";
            $res = mysql_query($sql) or die(mysql_error());
            $no = 0;
				while($ds = mysql_fetch_array($res)){
					$no++;
					echo("<tr>");
						echo("<td align='center'>" . $no . "</td>");
						echo("<td align='center'>" .$ds['tujuan']." (".$ds['username'].")</td>");
						echo("<td  align='justify'>" . ($ds["pesan_teks"] == "" ? "&nbsp;&nbsp;" : $ds["pesan_teks"]) . "</td>");
						echo("<td  align='center'>" .($ds["tgl_pos"]) . "</td>");
						if($ds["lihat"] == 1){	
							echo "<td  align='center' style='color:red;'>Terkirim</td>";
						}else{
							echo "<td  align='center' style='color:green;'>Sudah Dibaca</td>";
						}	
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