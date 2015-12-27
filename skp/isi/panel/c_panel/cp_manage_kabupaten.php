<script type="text/javascript">
$(document).ready(function(){
     $("#edit_kabupaten").dialog({
            autoOpen: false,
    		height: "400",
    		width: "800",
    		modal: true,
            show: "fade",
    		hide: "fade"
      });
	  
	  $("#add_kabupaten").dialog({
            autoOpen: false,
    		height: "400",
    		width: "800",
    		modal: true,
            show: "fade",
    		hide: "fade"
      });
	
	$("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
    
	$("#alert_add").click(function(){
			$(this).fadeOut('slow');
		});
});

function hapus(id){
    jConfirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href = "php/c_panel/cp_hapus_kabupaten.php?id=" + id;
		}	
    });
}

function editdata(id){
			$("#edit_kabupaten").dialog("open");
			$("#sh_kab").html("");
            $.ajax({
                type: "GET",
                url: "ajax/get_frm_edit_kabupaten.php",
                data: "id=" + id,
                success: function(r){
                    $("#sh_kab").html(r);
                }
            });
            return false;
}

function tambah(){
			$("#add_kabupaten").dialog("open");
			$("#sh_add_kab").html("");
            $("#sh_add_kab").load("ajax/get_frm_tambah_kabupaten.php");
            return false;
}
</script>

<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR DATA KABUPATEN</h3>
	<?php
		if(isset($_GET['msg'])){
			if($_GET['msg'] ==  1){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data Kabupaten Berhasil Ditambahkan.</center>";
				echo "</div><br/>";
			}else if($_GET['msg'] ==  2){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data Kabupaten Berhasil Diedit.</center>";
				echo "</div><br/>";
			}else if($_GET['msg'] ==  3){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data Kabupaten Berhasil Dihapus.</center>";
				echo "</div><br/>";
			}else{
				echo "<div class='alert alert-danger' role='alert' id='alert_add'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Maaf, Proses error, terjadi kesalahan dalam pemrosesan.</center>";
				echo "</div><br/>";
			}
		}
	?>
    <div class="bodypanel">
        <input type="button" value="Tambah Data Kabupaten" onclick="tambah();" style="height:45px; width:180px;" class="btn btn-success" />&nbsp;&nbsp;
		<input type="button" value="Kembali" onclick="document.location.href='?mod=c_panel';" style="height:45px; width:160px;" class="btn btn-info" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='250'>Nama Kabupaten</th>
            <th width='100'>Provinsi</th>
            <th width='25px'>&nbsp;</th>
            <th width='25px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
		
				$res = mysql_query("SELECT 
										a.*, b.provinsi 
										FROM ref_kabupaten a
										LEFT JOIN 
											ref_provinsi b ON  b.id_provinsi = a.id_provinsi 
										ORDER BY 
											a.kabupaten ASC ") or die(mysql_error());
            
				$ctr = 0;
				while($ds = mysql_fetch_array($res)){
					$ctr++;
        ?>
				<tr>
					<td align='center'><?php echo($ctr); ?></td>
					<td align='center'><?php echo($ds["kabupaten"]); ?></td>
					<td align='center'><?php echo($ds["provinsi"]); ?></td>
					<td align='center'>
						<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='editdata(<?php echo($ds["id_kabupaten"]); ?>);' />
					</td>
					<td>
						<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Data' onclick='hapus(<?php echo($ds["id_kabupaten"]); ?>);' />
					</td>
				</tr>
        <?php
				}		
        ?>
        </tbody>
        </table>
    </div>
</div>

<!-- DIALOG JQUERY ---------------------------------------------------------------------------------------------- -->
<div id="edit_kabupaten" title="EDIT DATA KABUPATEN" style="display: none;">
<div id="sh_kab"></div>
<div class="kelang"></div>
</div>

<!-- DIALOG JQUERY ---------------------------------------------------------------------------------------------- -->
<div id="add_kabupaten" title="TAMBAH DATA KABUPATEN" style="display: none;">
<div id="sh_add_kab"></div>
<div class="kelang"></div>
</div>