<?php

    class UsulanSatyaLancana_Model{
        public $id_usulan;
        public $no_usulan;
        public $tgl_usulan;
        public $jabatan_ttd_usulan;
        public $nama_ttd_usulan;
        public $nip_ttd_usulan;
        public $id_pangkat_ttd_usulan;
        public $kode_skpd;
        public $status;
        
        public function __construct(){
            $this->id_usulan = 0;
            $this->no_usulan = "";
            $this->tgl_usulan = "0000-00-00";
            $this->jabatan_ttd_usulan = "";
            $this->nama_ttd_usulan = "";
            $this->nip_ttd_usulan = "";
            $this->id_pangkat_ttd_usulan = 0;
            $this->kode_skpd = "";
            $this->status = 0;
        }
        
        public function Record($id_usulan){
            $sql = "SELECT * FROM tbl_usulan_satya_lancana WHERE id_usulan='" . $id_usulan . "'";
            $res = mysql_query($sql);
            while($ds = mysql_fetch_array($res)){
                $this->id_usulan = $ds["id_usulan"];
                $this->no_usulan = $ds["no_usulan"];
                $this->tgl_usulan = $ds["tgl_usulan"];
                $this->jabatan_ttd_usulan = $ds["jabatan_ttd_usulan"];
                $this->nama_ttd_usulan = $ds["nama_ttd_usulan"];
                $this->nip_ttd_usulan = $ds["nip_ttd_usulan"];
                $this->id_pangkat_ttd_usulan = $ds["id_pangkat_ttd_usulan"];
                $this->kode_skpd = $ds["kode_skpd"];
                $this->status = $ds["status"];
            }
        }
        
        public function Insert(){
            $sql = "INSERT INTO tbl_usulan_satya_lancana(
                    	no_usulan,
                    	tgl_usulan,
                    	jabatan_ttd_usulan,
                    	nama_ttd_usulan,
                    	nip_ttd_usulan,
                    	id_pangkat_ttd_usulan,
                        kode_skpd,
                    	status
                    )VALUES(
                    	'$this->no_usulan',
                    	'$this->tgl_usulan',
                    	'$this->jabatan_ttd_usulan',
                    	'$this->nama_ttd_usulan',
                    	'$this->nip_ttd_usulan',
                    	'$this->id_pangkat_ttd_usulan',
                        '$this->kode_skpd',
                    	'$this->status'
                    )";
            $res = mysql_query($sql) or die(mysql_error());
        }
        
        public function Update(){
            $sql = "UPDATE tbl_usulan_satya_lancana SET
                    	no_usulan='$this->no_usulan',
                    	tgl_usulan='$this->tgl_usulan',
                    	jabatan_ttd_usulan='$this->jabatan_ttd_usulan',
                    	nama_ttd_usulan='$this->nama_ttd_usulan',
                    	nip_ttd_usulan='$this->nip_ttd_usulan',
                    	id_pangkat_ttd_usulan='$this->id_pangkat_ttd_usulan',
                        kode_skpd='$this->kode_skpd',
                    	status='$this->status'
                    WHERE
                    	id_usulan = '$this->id_usulan'";
            $res = mysql_query($sql);
        }
        
        public function Delete(){
            $sql = "DELETE FROM tbl_usulan_satya_lancana
                    WHERE id_usulan = '$this->id_usulan'";
            $res = mysql_query($sql);
        }
        
        public function Validation(){
            $validation_result = "";
            if($this->no_usulan == "" || $this->tgl_usulan == "0000-00-00" || $this->nama_ttd_usulan == "" ||
                $this->nip_ttd_usulan == "" || $this->jabatan_ttd_usulan == "" || $this->id_pangkat_ttd_usulan == 0)
                $validation_result = "Maaf, input anda masih belum lengkap";
                
            return $validation_result;
        }
    }

?>