<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
		$this->load->model('User_model');
		$this->load->model('Dosen_model');
		$this->load->model('Mahasiswa_model');
		$this->load->model('DataMaster_model');
		$this->load->model('Kaprodi_model');
		$this->load->model('Menu_model');
	}

	public function index($tahun_ajaran = '', $semester = '', $angkatan = '')
	{
		$data['title'] = "Dashboard Admin";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get('dashboard')->row_array();

		$data['tahun_kuliah'] = $tahun_ajaran;
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['konten3'] = $this->db->get_where('content', ['id' => 3])->row_array();
		$data['konten4'] = $this->db->get_where('content', ['id' => 4])->row_array();

		$data['cur_tahun_ajaran'] = str_replace('_', '/', $tahun_ajaran);
		$data['cur_semester'] = $semester;

		$this->db->select("tahun_ajaran");
		$this->db->from('nilai_mata_kuliah');
		$this->db->order_by('tahun_ajaran', 'DESC');
		$this->db->group_by('tahun_ajaran');
		$data['tahun_ajaran'] = $this->db->get()->result_array();

		// if ($tahun_ajaran == '') {
		// 	$this->db->select
		// }



		// $this->db->select("COUNT(DISTINCT(nilai_mahasiswa.id)) AS jml_mhs, AVG(tak) AS avg_tak, semester_kelas");
		// $this->db->from('nilai_mahasiswa');
		// $this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
		// $this->db->join('kelas', 'kelas.id=mahasiswa.id_kelas');
		// $this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
		// $this->db->where('semester_kelas <=', 6);
		// $this->db->group_by('kelas.semester_kelas');
		// $data['hitung_tak'] = $this->db->get()->result_array();

		$this->db->select("COUNT(DISTINCT(id_nilai_mahasiswa)) AS jml_mhs, AVG(poin) AS avg_tak, semester AS semester_kelas");
		$this->db->group_by('semester');
		$data['hitung_tak'] = $this->db->get('tak')->result_array();

		if ($angkatan != '') {
			$data['arr_angkatan'] = explode("-", $angkatan);
		} else {
			$data['arr_angkatan'] = [];
		}

		if ($tahun_ajaran != '') {

			$tahun = str_replace('_', '/', $tahun_ajaran);
			$this->db->select("COUNT(nilai_mahasiswa.id) AS jml_mhs, AVG(ipk) AS avg_ipk, AVG(tak) AS avg_tak, AVG(presensi) AS avg_presensi");
			$this->db->from('nilai_mahasiswa');
			$this->db->where('tahun_ajaran', $tahun);
			if ($semester != '' && $semester == 'Genap') {
				$this->db->where("MOD(semester, 2) =", 0);
			} elseif ($semester != '' && $semester == 'Ganjil') {
				$this->db->where("MOD(semester, 2) =", 1);
			}
			$perulangan = 1;
			$isi = array();
			foreach ($data['arr_angkatan'] as $key => $value) {
				array_push($isi, $value);
				// if ($perulangan > 1) {
				// 	$this->db->or_where("angkatan", $value);
				// } else{
				// 	$this->db->where("angkatan", $value);
				// }
				// $perulangan++;
			}
			if (!empty($isi)) {
				$this->db->where_in("angkatan", $isi);
			}

			$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
			$this->db->group_by('semester');
			$data['value_mahasiswa_semester'] = $this->db->get()->result_array();

			$this->db->distinct();
			$this->db->select("angkatan");
			$this->db->where('tahun_ajaran', $tahun);
			$this->db->join('nilai_mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
			$data['angkatan'] = $this->db->get('mahasiswa')->result_array();

			$this->db->distinct();
			$this->db->select("semester");
			$this->db->from('nilai_mahasiswa');
			$this->db->where('tahun_ajaran', $tahun);
			if ($semester != '' && $semester == 'Genap') {
				$this->db->where("MOD(semester, 2) =", 0);
			} elseif ($semester != '' && $semester == 'Ganjil') {
				$this->db->where("MOD(semester, 2) =", 1);
			}
			$perulangan = 1;
			$isi = array();
			foreach ($data['arr_angkatan'] as $key => $value) {
				array_push($isi, $value);
				// if ($perulangan > 1) {
				// 	$this->db->or_where("angkatan", $value);
				// } else{
				// 	$this->db->where("angkatan", $value);
				// }
				// $perulangan++;
			}
			if (!empty($isi)) {
				$this->db->where_in("angkatan", $isi);
			}
			$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
			$this->db->group_by('semester');
			$data['distinct_semester'] = $this->db->get()->result_array();

			// Tahun Ajaran terisi

			$data['jml_tahun'] = count($data['tahun_ajaran']);
			$rata_smt = array();

			for ($x = 0; $x < $data['jml_tahun']; $x++) {
				$this->db->select("AVG(ip_semester.ipk) AS avg_ipk, AVG(ip_semester.ip) AS avg_ip, ip_semester.semester, tahun_ajaran");
				$this->db->from("ip_semester");
				$this->db->join('nilai_mata_kuliah', 'ip_semester.id_nilai_mahasiswa=nilai_mata_kuliah.id_nilai_mahasiswa');
				$this->db->where('tahun_ajaran', $data['tahun_ajaran'][$x]['tahun_ajaran']);
				$this->db->group_by('ip_semester.semester');
				array_push($rata_smt, $this->db->get()->result_array());
			}
			$data['nilai_ipk'] = $rata_smt;

			$rata_smt = array();
			if ($data['arr_angkatan'] == null) {
				for ($x = 0; $x < count($data['angkatan']); $x++) {
					$this->db->select("AVG(ip_semester.ipk) AS avg_ipk, AVG(ip_semester.ip) AS avg_ip, ip_semester.semester, tahun_ajaran, angkatan");
					$this->db->from("ip_semester");
					$this->db->join('nilai_mata_kuliah', 'ip_semester.id_nilai_mahasiswa=nilai_mata_kuliah.id_nilai_mahasiswa');
					$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
					$this->db->where('angkatan', $data['angkatan'][$x]['angkatan']);
					$this->db->where('tahun_ajaran', $tahun);
					$this->db->group_by('ip_semester.semester');
					array_push($rata_smt, $this->db->get()->result_array());
				}
				$data['nilai_ipk'] = $rata_smt;
			} else {

				$this->db->select("AVG(ip_semester.ipk) AS avg_ipk, AVG(ip) AS avg_ip, tahun_ajaran, ip_semester.semester");
				$this->db->join('nilai_mahasiswa', 'nilai_mahasiswa.id=ip_semester.id_nilai_mahasiswa');
				$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
				$this->db->join('kelas', 'kelas.id=mahasiswa.id_kelas');
				$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');

				$this->db->where('tahun_ajaran', $tahun);
				// $this->db->where('ip !=', 0);
				$perulangan = 1;
				$isi = array();
				foreach ($data['arr_angkatan'] as $key => $value) {
					array_push($isi, $value);
					// if ($perulangan > 1) {
					// 	$this->db->or_where("angkatan", $value);
					// } else{
					// 	$this->db->where("angkatan", $value);
					// }
					// $perulangan++;
				}
				if (!empty($isi)) {
					$this->db->where_in("angkatan", $isi);
				}
				$this->db->group_by('ip_semester.semester');
				$data['ip_ipk_mahasiswa_semester'] = $this->db->get('ip_semester')->result_array();
			}

			$this->db->select("AVG(ip_semester.ipk) AS avg_ipk, AVG(ip) AS avg_ip, tahun_ajaran, ip_semester.semester");
			$this->db->join('nilai_mahasiswa', 'nilai_mahasiswa.id=ip_semester.id_nilai_mahasiswa');
			$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('kelas', 'kelas.id=mahasiswa.id_kelas');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');

			$this->db->where('tahun_ajaran', $tahun);
			// $this->db->where('ip !=', 0);
			$perulangan = 1;
			$isi = array();
			foreach ($data['arr_angkatan'] as $key => $value) {
				array_push($isi, $value);
				// if ($perulangan > 1) {
				// 	$this->db->or_where("angkatan", $value);
				// } else{
				// 	$this->db->where("angkatan", $value);
				// }
				// $perulangan++;
			}
			if (!empty($isi)) {
				$this->db->where_in("angkatan", $isi);
			}
			$this->db->group_by('ip_semester.semester');
			$data['ip_ipk_mahasiswa_semester'] = $this->db->get('ip_semester')->result_array();

			$this->db->distinct();
			$this->db->select("nilai_mata_kuliah.semester AS smt");
			$this->db->join('nilai_mahasiswa', 'nilai_mahasiswa.id=ip_semester.id_nilai_mahasiswa');
			$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('kelas', 'kelas.id=mahasiswa.id_kelas');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');

			$this->db->where('tahun_ajaran', $tahun);
			$this->db->where('ip !=', 0);
			if ($semester != '' && $semester == 'Genap') {
				$this->db->where("MOD(ip_semester.semester, 2) =", 0);
			} elseif ($semester != '' && $semester == 'Ganjil') {
				$this->db->where("MOD(ip_semester.semester, 2) =", 1);
			}
			$perulangan = 1;
			$isi = array();
			foreach ($data['arr_angkatan'] as $key => $value) {
				array_push($isi, $value);
				// if ($perulangan > 1) {
				// 	$this->db->or_where("angkatan", $value);
				// } else{
				// 	$this->db->where("angkatan", $value);
				// }
				// $perulangan++;
			}
			if (!empty($isi)) {
				$this->db->where_in("angkatan", $isi);
			}
			$this->db->group_by('nilai_mata_kuliah.semester');
			$data['distinct_semester_ip_ipk'] = $this->db->get('ip_semester')->result_array();
		} else {
			$this->db->select("COUNT(nilai_mahasiswa.id) AS jml_mhs, AVG(ipk) AS avg_ipk, AVG(tak) AS avg_tak, AVG(presensi) AS avg_presensi");
			$this->db->from('nilai_mahasiswa');
			if ($semester != '' && $semester == 'Genap') {
				$this->db->where("semester % 2", 0);
			} elseif ($semester != '' && $semester == 'Ganjil') {
				$this->db->where("semester % 2", 1);
			}
			$perulangan = 1;
			$isi = array();
			foreach ($data['arr_angkatan'] as $key => $value) {
				array_push($isi, $value);
				// if ($perulangan > 1) {
				// 	$this->db->or_where("angkatan", $value);
				// } else{
				// 	$this->db->where("angkatan", $value);
				// }
				// $perulangan++;
			}
			if (!empty($isi)) {
				$this->db->where_in("angkatan", $isi);
			}
			$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
			$this->db->group_by('semester');
			$data['value_mahasiswa_semester'] = $this->db->get()->result_array();

			// $tahun = str_replace('_', '/', $tahun_ajaran);
			$this->db->distinct();
			$this->db->select("angkatan");
			// $this->db->where('tahun_ajaran', $tahun);
			$this->db->join('nilai_mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
			$data['angkatan'] = $this->db->get('mahasiswa')->result_array();

			$this->db->distinct();
			$this->db->select("semester");
			$this->db->from('nilai_mahasiswa');
			if ($semester != '' && $semester == 'Genap') {
				$this->db->where("semester % 2", 0);
			} elseif ($semester != '' && $semester == 'Ganjil') {
				$this->db->where("semester % 2", 1);
			}
			// $perulangan = 1;
			$isi = array();
			foreach ($data['arr_angkatan'] as $key => $value) {
				array_push($isi, $value);
				// if ($perulangan > 1) {
				// 	$this->db->or_where("angkatan", $value);
				// } else{
				// 	$this->db->where("angkatan", $value);
				// }
				// $perulangan++;
			}
			if (!empty($isi)) {
				$this->db->where_in("angkatan", $isi);
			}
			$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
			$this->db->group_by('semester');
			$data['distinct_semester'] = $this->db->get()->result_array();

			// Tahun Ajaran Kosong
			$data['jml_tahun'] = count($data['tahun_ajaran']);
			$rata_smt = array();

			for ($x = 0; $x < $data['jml_tahun']; $x++) {
				$this->db->select("AVG(ip_semester.ipk) AS avg_ipk, AVG(ip_semester.ip) AS avg_ip, ip_semester.semester, tahun_ajaran");
				$this->db->from("ip_semester");
				$this->db->join('nilai_mata_kuliah', 'ip_semester.id_nilai_mahasiswa=nilai_mata_kuliah.id_nilai_mahasiswa');
				$this->db->where('tahun_ajaran', $data['tahun_ajaran'][$x]['tahun_ajaran']);
				$this->db->group_by('ip_semester.semester');
				array_push($rata_smt, $this->db->get()->result_array());
			}
			$data['nilai_ipk'] = $rata_smt;

			// Tahun Ajaran terisi
			$this->db->select("AVG(ip_semester.ipk) AS avg_ipk, AVG(ip) AS avg_ip, tahun_ajaran");
			$this->db->join('nilai_mahasiswa', 'nilai_mahasiswa.id=ip_semester.id_nilai_mahasiswa');
			$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('kelas', 'kelas.id=mahasiswa.id_kelas');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');

			// $this->db->where('tahun_ajaran', $tahun);
			$this->db->where('ip !=', 0);
			if ($semester != '' && $semester == 'Genap') {
				$this->db->where("MOD(ip_semester.semester, 2) =", 0);
			} elseif ($semester != '' && $semester == 'Ganjil') {
				$this->db->where("MOD(ip_semester.semester, 2) =", 1);
			}
			$perulangan = 1;
			$isi = array();
			foreach ($data['arr_angkatan'] as $key => $value) {
				array_push($isi, $value);
				// if ($perulangan > 1) {
				// 	$this->db->or_where("angkatan", $value);
				// } else{
				// 	$this->db->where("angkatan", $value);
				// }
				// $perulangan++;
			}
			if (!empty($isi)) {
				$this->db->where_in("angkatan", $isi);
			}
			$this->db->group_by('nilai_mata_kuliah.semester');
			$data['ip_ipk_mahasiswa_semester'] = $this->db->get('ip_semester')->result_array();

			$this->db->distinct();
			$this->db->select("nilai_mata_kuliah.semester AS smt");
			$this->db->join('nilai_mahasiswa', 'nilai_mahasiswa.id=ip_semester.id_nilai_mahasiswa');
			$this->db->join('mahasiswa', 'mahasiswa.id=nilai_mahasiswa.id_mahasiswa');
			$this->db->join('kelas', 'kelas.id=mahasiswa.id_kelas');
			$this->db->join('nilai_mata_kuliah', 'nilai_mahasiswa.id=nilai_mata_kuliah.id_nilai_mahasiswa');
			$this->db->where('ip !=', 0);
			if ($semester != '' && $semester == 'Genap') {
				$this->db->where("ip_semester.semester % 2", 0);
			} elseif ($semester != '' && $semester == 'Ganjil') {
				$this->db->where("ip_semester.semester % 2", 1);
			}
			$perulangan = 1;
			$isi = array();
			foreach ($data['arr_angkatan'] as $key => $value) {
				array_push($isi, $value);
				// if ($perulangan > 1) {
				// 	$this->db->or_where("angkatan", $value);
				// } else{
				// 	$this->db->where("angkatan", $value);
				// }
				// $perulangan++;
			}
			if (!empty($isi)) {
				$this->db->where_in("angkatan", $isi);
			}
			$this->db->group_by('nilai_mata_kuliah.semester');
			$data['distinct_semester_ip_ipk'] = $this->db->get('ip_semester')->result_array();
		}

		//Jumlah penerima beasiswa
		$this->db->select("tahun, COUNT(id_beasiswa) AS jumlah_penerima");
		$this->db->from("beasiswa");
		$this->db->group_by("tahun");
		$this->db->order_by("tahun", "ASC");
		$data['jumlah_beasiswa'] = $this->db->get()->result_array();

		// Data Beasiswa
		$this->db->select("user.name AS nama, tipe_beasiswa, jenis_beasiswa, tahun, nama_beasiswa");
		$this->db->from("beasiswa");
		$this->db->join("mahasiswa", "beasiswa.id_mahasiswa = mahasiswa.id");
		$this->db->join("user", "mahasiswa.id_user = user.id");
		$this->db->order_by("tahun", "ASC");
		$data['data_beasiswa'] = $this->db->get()->result_array();
		$data['count_beasiswa'] = $this->db->count_all("beasiswa");

		// Data Prestasi
		$this->db->select("user.name AS nama, peringkat, kategori, penyelenggara, nama_kompetisi, tahun");
		$this->db->from("prestasi");
		$this->db->join("mahasiswa", "prestasi.id_mahasiswa = mahasiswa.id");
		$this->db->join("user", "mahasiswa.id_user = user.id");
		$this->db->order_by("tahun", "DESC");
		$data['data_prestasi'] = $this->db->get()->result_array();
		$data['count_prestasi'] = $this->db->count_all("prestasi");

		// Data Kehadiran
		$this->db->select("nilai_mata_kuliah.id_nilai_mahasiswa AS id, name, SUM(presensi) AS sum_presensi, COUNT(presensi) AS count_presensi, ROUND((SUM(presensi) / COUNT(presensi))*100, 0) AS avg_presensi");
		$this->db->from("nilai_mata_kuliah");
		$this->db->join("mahasiswa", "nilai_mata_kuliah.id_nilai_mahasiswa = mahasiswa.id");
		$this->db->join("user", "mahasiswa.id_user = user.id");
		$this->db->group_by("id_nilai_mahasiswa");
		$this->db->order_by("avg_presensi", "ASC");
		$data['data_kehadiran'] = $this->db->get()->result_array();
		$data['count_kehadiran'] = count($data['data_kehadiran']);

		// Data TAK
		$this->db->select("nilai_mahasiswa.id_mahasiswa AS id, name, tak");
		$this->db->from("nilai_mahasiswa");
		$this->db->join("mahasiswa", "mahasiswa.id = nilai_mahasiswa.id_mahasiswa");
		$this->db->join("user", "user.id = mahasiswa.id_user");
		$this->db->order_by("tak", "ASC");
		$data['data_TAK'] = $this->db->get()->result_array();
		$data['count_TAK'] = count($data['data_TAK']);

		// INFO MAHASISWA
		$keyword_info = null;
		if ($this->input->get('submit-info')){
			$data['keyword-info'] = $this->input->get('keyword-info');
			$keyword_info = $this->input->get('keyword-info');
		}
		$data['info_mahasiswa'] = $this->Admin_model->getInfoMahasiswa($keyword_info);
		// JUMLAH ROWS
		$data['count_info'] = count($data['info_mahasiswa']);

		// ASAL DAERAH
		$data['asal_mhs'] = $this->Admin_model->getAsalDaerah();

		$this->db->select("COUNT(mahasiswa.id) AS jml_mhs");
		$this->db->from('mahasiswa');
		$data['value_mahasiswa'] = $this->db->get()->row_array();
		$this->db->select("AVG(ipk) AS avg_ipk, AVG(tak) AS avg_tak");
		$this->db->from('nilai_mahasiswa');
		$data['value_mahasiswa2'] = $this->db->get()->row_array();
		$this->db->select("AVG(presensi) AS avg_presensi");
		$this->db->from('nilai_mata_kuliah');
		$data['value_mahasiswa3'] = $this->db->get()->row_array();
		$this->db->select("pekerjaan_wali, COUNT(pekerjaan_wali) AS count_pekerjaan");
		$this->db->from('mahasiswa');
		$this->db->group_by('pekerjaan_wali');
		$data['pekerjaan_wali'] = $this->db->get()->result_array();
		$this->db->select("asal_daerah, COUNT(asal_daerah) AS count_asal");
		$this->db->from('mahasiswa');
		$this->db->group_by('asal_daerah');
		$data['asal_daerah'] = $this->db->get()->result_array();
		$this->db->select("pendidikan.id AS pid, pendidikan, COUNT(pendidikan_wali) AS count_pendidikan");
		$this->db->from('mahasiswa');
		$this->db->join('pendidikan', 'pendidikan.id=mahasiswa.pendidikan_wali', 'right');
		$this->db->group_by('pendidikan_wali');
		$this->db->order_by('pendidikan.id', 'ASC');
		$data['pendidikan_wali'] = $this->db->get()->result_array();
		$this->db->select("COUNT(pendidikan_wali) AS count_pendidikan");
		$this->db->from('mahasiswa');
		$data['count_pendidikan'] = $this->db->get()->row_array();
		$this->db->select("COUNT(pekerjaan_wali) AS count_pekerjaan");
		$this->db->from('mahasiswa');
		$data['count_pekerjaan'] = $this->db->get()->row_array();
		$this->db->select("COUNT(asal_daerah) AS count_asal");
		$this->db->from('mahasiswa');
		$data['count_asal'] = $this->db->get()->row_array();

		$this->db->select("COUNT(id_status) AS count_status");
		$this->db->from('mahasiswa');
		$data['count_status'] = $this->db->get()->row_array();

		$this->db->select("status_mahasiswa.id AS sid, status, COUNT(id_status) AS count_status");
		$this->db->from('mahasiswa');
		$this->db->join('status_mahasiswa', 'status_mahasiswa.id=mahasiswa.id_status');
		$this->db->group_by('id_status');
		$this->db->order_by('status_mahasiswa.id', 'ASC');
		$data['status'] = $this->db->get()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function beasiswa()
	{
		$data['title'] = "Add New Shcolarship";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get('dashboard')->row_array();

		$this->db->select("*");
		$this->db->from("user");
		$this->db->join("mahasiswa", "mahasiswa.id_user = user.id");
		$this->db->where("role_id", "3");
		$data['mahasiswa'] = $this->db->get()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/tambah-beasiswa', $data);
		$this->load->view('templates/footer');
	}

	public function tambahBeasiswa()
	{
		$this->db->insert('beasiswa', [
			'tipe_beasiswa' => $this->input->post('tipe'),
			'jenis_beasiswa' => $this->input->post('jenis'),
			'nama_beasiswa' => $this->input->post('namaBeasiswa'),
			'tahun' => $this->input->post('tahunBeasiswa'),
			'id_mahasiswa' => $this->input->post('nama')
		]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				New Scholarship Added!
				</div>');
		redirect('Admin/');
	}

	public function prestasi(){
		$data['title'] = "Add New Achievement";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get('dashboard')->row_array();

		$this->db->select("*");
		$this->db->from("user");
		$this->db->join("mahasiswa", "mahasiswa.id_user = user.id");
		$this->db->where("role_id", "3");
		$data['mahasiswa'] = $this->db->get()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/tambah-prestasi', $data);
		$this->load->view('templates/footer');
	}

	public function tambahPrestasi()
	{
		$this->db->insert('prestasi', [
			'peringkat' => $this->input->post('peringkat'),
			'kategori' => $this->input->post('kategori'),
			'penyelenggara' => $this->input->post('penyelenggara'),
			'nama_kompetisi' => $this->input->post('namaKompetisi'),
			'tahun' => $this->input->post('tahun'),
			'id_mahasiswa' => $this->input->post('nama')
		]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				New Achievement Added!
				</div>');
		redirect('Admin/');
	}

	public function about()
	{
		$data['title'] = "About";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get('dashboard')->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/about', $data);
		$this->load->view('templates/footer');
	}

	public function role()
	{
		$data['title'] = "Role Management";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				New Role Added!
				</div>');
			redirect('admin/role');
		}
	}

	public function dataUser()
	{
		$data['title'] = "Data User";
		$data['role'] = $this->db->get('user_role')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->db->select('*, user_role.id AS rid, user.id AS uid');
		$this->db->from('user');
		$this->db->join('user_role', 'user_role.id = user.role_id');
		$data['user_data'] = $this->db->get()->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/data-user', $data);
		$this->load->view('templates/footer');
	}

	public function setRole()
	{
		$this->db->set('role_id', $this->input->post('role_id'));
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user');
		// $input = array('role_id' => $this->input->post('role_id'));
		// $id = $this->input->post('id');
		// $this->User_model->update()
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Set User Role Successfull!
			</div>');
		redirect('admin/dataUser');
	}

	public function roleAccess($role_id)
	{
		$data['title'] = "Role Access";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Access Changed!
			</div>');
	}

	public function getUpdateRole()
	{
		echo json_encode($this->Admin_model->getRoleById($this->input->post('id')));
	}
	public function getUserData()
	{
		echo json_encode($this->Admin_model->getUserById($this->input->post('id')));
	}
	public function updateRole()
	{
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/role');
		} else {
			$data = array('role' => $this->input->post('role'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('user_role', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Role Updated!
				</div>');
			redirect('admin/role');
		}
	}

	public function deleteRole($id)
	{
		$this->db->where('role_id', $id);
		$this->db->delete('user');

		$this->db->where('role_id', $id);
		$this->db->delete('user_access_menu');

		$this->db->where('id', $id);
		$this->db->delete('user_role');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Role Deleted!
			</div>');
		redirect('admin/role');
	}
}
