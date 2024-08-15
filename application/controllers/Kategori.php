<?php
class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
    }

    public function index()
    {
        $data['kategori'] = $this->Kategori_model->get_all();
        $this->load->view('kategori/index', $data);
    }

    public function create()
    {
        $data = [
            'kategori' => $this->input->post('kategori'),
        ];
        $this->Kategori_model->insert($data);
        echo json_encode(['status' => true]);
    }

    public function edit($id)
    {
        $data = $this->Kategori_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $data = [
            'kategori' => $this->input->post('kategori'),
        ];
        $id = $this->input->post('id');
        $this->Kategori_model->update($id, $data);
        echo json_encode(['status' => true]);
    }

    public function delete($id)
    {
        $this->Kategori_model->delete($id);
        echo json_encode(['status' => true]);
    }
}
