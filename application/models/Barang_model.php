<?php
class Barang_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select('tb_barang.*, tb_kategori.kategori');
        $this->db->from('tb_barang');
        $this->db->join(
            'tb_kategori',
            'tb_barang.kategori_id = tb_kategori.id',
            'left'
        );
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('tb_barang', ['id' => $id]);
        return $query->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('tb_barang', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_barang', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tb_barang');
    }
}
