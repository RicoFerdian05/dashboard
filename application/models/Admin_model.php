<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getRoleById($id)
	{
		return $this->db->get_where('user_role', ['id' => $id])->row_array();
	}
	public function getUserById($id)
	{
		return $this->db->get_where('user', ['id' => $id])->row_array();
	}

	public function getInfoMahasiswa( $keyword = null){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('name, ipk, tak, SUM(sks) AS sum_sks, status_pa');
		$this->db->from('nilai_mata_kuliah');
		$this->db->join('nilai_mahasiswa', 'nilai_mahasiswa.id_mahasiswa = nilai_mata_kuliah.id_nilai_mahasiswa');
		$this->db->join('mahasiswa', 'mahasiswa.id = nilai_mahasiswa.id_mahasiswa');
		$this->db->join('user', 'user.id = mahasiswa.id_user');
		$this->db->join('kelas', 'kelas.id=mahasiswa.id_kelas'); 
		$this->db->join('pengampu', 'pengampu.id = nilai_mata_kuliah.id_pengampu');
		$this->db->join('mata_kuliah', 'mata_kuliah.id = pengampu.id_mata_kuliah');
		$this->db->like('name', $keyword);
		$this->db->group_by('nilai_mata_kuliah.id_nilai_mahasiswa');

		return $this->db->get()->result_array();
	}

	public function getAsalDaerah(){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->db->select('kode, COUNT("kode_prov") AS jml_prov');
		$this->db->from('daerah');
		$this->db->join('mahasiswa', 'daerah.kode = mahasiswa.kode_prov');
		$this->db->join('kelas', 'kelas.id=mahasiswa.id_kelas');
		$this->db->group_by('kode');
		
		return $this->db->get()->result_array();
		
	}
}