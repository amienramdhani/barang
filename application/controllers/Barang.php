<?php
class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->model('Kategori_model');
    }

    public function index()
    {
        $data['barang'] = $this->Barang_model->get_all();
        $data['kategori'] = $this->Kategori_model->get_all();
        $this->load->view('barang/index', $data);
    }

    public function create()
    {
        $data = [
            'kategori_id' => $this->input->post('kategori_id'),
            'barang' => $this->input->post('barang'),
            'stok' => $this->input->post('stok'),
        ];
        $this->Barang_model->insert($data);
        echo json_encode(['status' => true]);
    }

    public function edit($id)
    {
        $data = $this->Barang_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $data = [
            'kategori_id' => $this->input->post('kategori_id'),
            'barang' => $this->input->post('barang'),
            'stok' => $this->input->post('stok'),
        ];
        $id = $this->input->post('id');
        $this->Barang_model->update($id, $data);
        echo json_encode(['status' => true]);
    }

    public function delete($id)
    {
        $this->Barang_model->delete($id);
        echo json_encode(['status' => true]);
    }
}
