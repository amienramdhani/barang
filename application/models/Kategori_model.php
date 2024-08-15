<?php
class Kategori_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all()
    {
        $query = $this->db->get('tb_kategori');
        return $query->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('tb_kategori', ['id' => $id]);
        return $query->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('tb_kategori', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_kategori', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tb_kategori');
    }
}
