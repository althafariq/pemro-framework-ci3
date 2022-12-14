<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {
    public function getAllMahasiswa() {
        $sql = "SELECT * FROM mahasiswa ORDER BY npm ASC";

        return $this->db->query($sql)->result();
        //return $this->db->get('mahasiswa')->result();   
    }

    public function insertDataMahasiswa() {
        $data = [
            "npm" => $this->input->post('npm', true),
            "nama" => capitalizeFirst($this->input->post('nama', true)),
            "jurusan" => capitalizeFirst($this->input->post('jurusan', true)),
            "fakultas" => capitalizeFirst($this->input->post('fakultas', true)),
            "hp" => $this->input->post('hp', true),
            "email" => $this->input->post('npm') . "@student.upnjatim.ac.id"
        ];

        $this->db->insert('mahasiswa', $data);
    }

    public function deleteMahasiswa($npm) {
        $this->db->where('npm', $npm);
        $this->db->delete('mahasiswa');
    }

    public function getMahasiswabyNPM($npm) {
        $sql = "SELECT * FROM mahasiswa WHERE npm = '$npm'";

        return $this->db->query($sql)->row();
    }

    // public function getMahasiswabyNPMtoEdit($npm) {
    //     return $this->db->get_where('mahasiswa', ['npm' => $npm])->row();
    // }

    public function getMahasiswabyNama($nama) { 
        $sql = "SELECT * FROM mahasiswa WHERE nama = '$nama'";

        return $this->db->query($sql)->result();
    }

    public function getMahasiswabyJurusan($jurusan) {
        $sql = "SELECT * FROM mahasiswa WHERE jurusan = '$jurusan'";

        return $this->db->query($sql)->result();
    }

    public function editDataMahasiswa($npm) {
        $data = [
            "npm" => $this->input->post('npm', true),
            "nama" => capitalizeFirst($this->input->post('nama', true)),
            "jurusan" => capitalizeFirst($this->input->post('jurusan', true)),
            "fakultas" => capitalizeFirst($this->input->post('fakultas', true)),
            "hp" => $this->input->post('hp', true),
            "email" => $this->input->post('npm') . "@student.upnjatim.ac.id"
        ];

        $this->db->where('npm', $npm);
        $this->db->update('mahasiswa', $data);
    }

    public function findMahasiswa() {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('npm', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('fakultas', $keyword);
        $this->db->or_like('hp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result();
    }
}

?>