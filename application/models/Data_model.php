<?php

class Data_model extends CI_model{

	public function getDataLapor(){
		return $this->db->get('keluhan')->result_array();
	}
	// public function getDataLaporUser(){
	// 	return $this->db->get_where('keluhan',['username'=>])->result_array();
	// }
	public function tambahDataLapor(){

		$gambar=$this->Data_model->upload();
		if(!$gambar){
			return false;
		}

		$data = [
			"username"=>$this->input->post('username'),
			"lapor"=>$this->input->post('lapor',true),
			"aspek"=>$this->input->post('aspek',true),
			"gambar"=>$gambar
		];
		
		$this->db->insert('keluhan',$data);
	}

	public function getDataByUsername($username){
		return $this->db->get_where('keluhan',['username'=>$username])->row_array();
	}

	public function getDataById($id){
		return $this->db->get_where('keluhan',['id'=>$id])->row_array();
	}

	public function cariDataKeluhan(){
		$keyword=$this->input->post('keyword');
		$this->db->like('lapor',$keyword);
		$this->db->or_like('aspek',$keyword);
		return $this->db->get('keluhan')->result_array();
	}
	public function upload(){
		$namaFile=$_FILES['gambar']['name'];
		$ukuranFIle=$_FILES['gambar']['size'];
		$error=$_FILES['gambar']['error'];
		$tmpName=$_FILES['gambar']['tmp_name'];

		// $ekstensiGambarValid=['jpg','jpeg','png','gif'];
		// $ekstensiGambar=explode('.', $namaFile);
		// $ekstensiGambar=strtolower(end($ekstensiGambar));

		return $namaFile;

	}

	public function hapusDataLapor($id){
		$this->db->where('id',$id);
		$this->db->delete('keluhan');
	}

	public function ubahDataLapor($id){

		$gambar=$this->Data_model->upload();
		if(!$gambar){
			return false;
		}
		//$this->Data_model->getDataById($id);
		$data = [
			"username"=>$this->input->post('username'),
			"lapor"=>$this->input->post('lapor',true),
			"aspek"=>$this->input->post('aspek',true), 
			"gambar"=>$gambar
		];
		$this->db->where('id',$id);
		$this->db->update('keluhan',$data);
	}

	public function limitKata($string,$word_limit){
		$words=explode(" ", $string);
		return implode(" ", array_splice($words,0,$word_limit));
	}
}