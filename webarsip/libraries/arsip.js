$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyFilter").slideToggle(500);
    });
});	

function disposisi(id_surat, id_disposisi){
	 var t = document.getElementById("div_cek_"+id_surat);
	 if(t.innerHTML != ''){
		 t.innerHTML = '';
	  }else
		t.innerHTML='<iframe src="./isi/panel/dialog/dialog_frm_dsp.php?id_surat_masuk='+id_surat+'&id_disposisi='+id_disposisi+'" width="100%" style="height:1300px" frameborder="0" scrolling="yes"' + 
		'scrolling="no" id="iframe_detail"></iframe>';	
	}

function lihat_detail_sm(id_surat, id_disposisi){
	 var t = document.getElementById("div_cek_"+id_surat);
	 if(t.innerHTML != ''){
		 t.innerHTML = '';
	  }else
		t.innerHTML='<iframe src="./ajax/detail_sm.php?id='+id_surat+'&id_disposisi='+id_disposisi+'" width="100%" style="height:1300px" frameborder="0" scrolling="yes"' + 
		'scrolling="no" id="iframe_detail"></iframe>';	
		
}	

function lihat_cadis_sm(id_surat, id_disposisi){
	 var t = document.getElementById("div_cek_"+id_surat);
	 if(t.innerHTML != ''){
		 t.innerHTML = '';
	  }else
		t.innerHTML='<iframe src="./ajax/cadis_sm_feed.php?id='+id_surat+'&id_disposisi='+id_disposisi+'" width="100%" style="height:1300px" frameborder="0" scrolling="yes"' + 
		'scrolling="no" id="iframe_detail"></iframe>';	
		
}

function lihat_file_sm(id_surat, id_disposisi){
	 var t = document.getElementById("div_cek_"+id_surat);
	 if(t.innerHTML != ''){
		 t.innerHTML = '';
	  }else
		t.innerHTML='<iframe src="./ajax/file_sm_feed.php?id='+id_surat+'&id_disposisi='+id_disposisi+'" width="100%" style="height:1300px" frameborder="0" scrolling="yes" ' + 
		'scrolling="no" id="iframe_detail"></iframe>';	
		
}		
	
function kestaff(id_bidang){
    //$("#staff").html(id_bidang);
    $("#staff").html("Loading . . .");
    $.ajax({
        type: "GET",
        url: "ajax/disposisi_kasubbid.php",
        data: "id=" + id_bidang,
        success: function(r){
            //alert(r);
            $("#staff").html(r);
        }
    });
	

}