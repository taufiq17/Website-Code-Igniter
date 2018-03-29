<?php if (!defined('BASEPATH')) exit('No direct script allowed');



/**
 * Description of Adminoc
 *
 * @author USER
 * file admin class Adminoc ini dipakai untuk mengatur halaman admin
 * 
 * cara penggunaan controllers :
 * 1. load terlebih dahulu pada function construct
 * 2. untuk pemanggilan function pada model
 *      $this->nama_model->nama_function();
 */
class Adminoc extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Mkategori_artikel');
        $this->load->model('Martikel');
        if ($this->session->userdata('id_admin') =="" ) {
            redirect('adminlogin');
        }    
    }
    
    function index(){
        $data['title'] = ".: Admin-OC v.1";
        $data['content'] = "dashboard";
        $this->load->view('view_admin/adminoc', $data);
    }
    
    function kategoriartikel(){
        $data['title'] = "Data Kategori Artikel";
        $data['content'] = "tabel-kategori-artikel";
        $data['datakategoriartikel'] = $this->Mkategori_artikel->read();
        $this->load->view('view_admin/adminoc', $data);
    }
    
    function addkategori(){
        $data['title'] = "Tambah Kategori Artikel";
        $data['content'] = "add-kategori-artikel";
        $this->load->view('view_admin/adminoc', $data);
    }
    
    function editkategori($id){
        $data['title'] = "Ubah Kategori Artikel";
        $data['content'] = "edit-kategori-artikel";
        $data['getkategori'] = $this->Mkategori_artikel->get_id($id);
        $this->load->view('view_admin/adminoc', $data);
    }
    
    function create_kategori(){
        $this->Mkategori_artikel->create();
        $this->kategoriartikel();
    }
    
    function update_kategori(){
        $id = $this->input->post('id_katpost');
        $this->Mkategori_artikel->update($id);
        $this->kategoriartikel();
    }
    
    function delete_kategori($id){
        $this->Mkategori_artikel->delete($id);
        $this->kategoriartikel();
    }
    
    function artikel(){
        $data['title'] = "Data Artikel";
        $data['content'] = "tabel-artikel";
        $data['dataartikel'] = $this->Martikel->read();
        $this->load->view('view_admin/adminoc', $data);
    }
    
    function addartikel(){
        $data['title'] = "Tambah Artikel";
        $data['content'] = "add-artikel";
        $data['listkategori'] = $this->Martikel->list_kategori_post();
        $this->load->view('view_admin/adminoc', $data);
    }
    
    function editartikel($id){
        $data['title'] = "Ubah Artikel";
        $data['content'] = "edit-artikel";
        $data['getartikel'] = $this->Martikel->get_id($id);
        $this->load->view('view_admin/adminoc', $data);
    }
    
    function create_artikel(){
        $nmfile = "file_".time(); //nama file + fungsi item
        $config['upload_path'] = './flat-admin/img/foto-header/source/'; //folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['max_width'] = '5000'; //lebar maksimum 5000 px
        $config['max_height'] = '5000'; //tinggi maksimum 5000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);
        if($_FILES['foto_header']['name']){
            if ($this->upload->do_upload('foto_header')){
                $data_upload = $this->upload->data();
                $this->image_lib->initialize(array(
                    'image_library' => 'gd2',
                    'source_image' => './flat-admin/img/foto-header/source/'.$data_upload['file_name'],
                    'new_image' => './flat-admin/img/foto-header/thumbs/'.$data_upload['file_name'],
                    'maintain_ratio' => false,
                    'create_thumb' => true,
                    'quality' => '20%',
                    'width' => 240,
                    'height' => 172
                ));
                $this->image_lib->resize();
                $tgl = $this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl');
                $data = array(
                    'judul' => $this->input->post('judul'),
                    'slug_post' => url_title($this->input->post('judul')),
                    'foto_header' => $data_upload['file_name'],
                    'thumbs' => $nmfile.'_thumb'.$data_upload['file_ext'],
                    'headline' => $this->input->post('headline'),
                    'isi_post' => $this->input->post('isi_post'),
                    'tgl_post' => $tgl,
                    'id_katpost' => $this->input->post('id_katpost'),
                    'id_admin' => '',
                    'jml_like' => '0',
                    'post_aktif' => '0'
                );
                $this->Martikel->create($data);
                redirect('adminoc/artikel');
            }else{
                redirect('adminoc/addartikel');
            }
        }
    }
    
    function create_artikel2(){
        $tgl = $this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl');
                $data = array(
                    'judul' => $this->input->post('judul'),
                    'slug_post' => '',
                    'foto_header' => '',
                    'thumbs' => '',
                    'headline' => $this->input->post('headline'),
                    'isi_post' => $this->input->post('isi_post'),
                    'tgl_post' => $tgl,
                    'id_katpost' => $this->input->post('id_katpost'),
                    'id_admin' => '',
                    'jml_like' => '0',
                    'post_aktif' => '0'
                );
                $this->Martikel->create($data);
                redirect('adminoc/artikel');
    }
    
    
    function update_artikel(){
        $id = $this->input->post('id_post');
        $this->Martikel->update($id);
        $this->artikel(); // mirip dengan redirect('adminoc/artikel')
    }
     
    function delete_artikel($id){
        $this->Martikel->delete($id);
        $this->artikel(); // mirip dengan redirect('adminoc/artikel')
    }
    
    function artikel_set_aktif($id){
        $this->Martikel->post_aktif($id);
        $this->artikel(); // mirip dengan redirect('adminoc/artikel')
    }
    
    function artikel_set_nonaktif($id){
        $this->Martikel->post_nonaktif($id);
        $this->artikel(); // mirip dengan redirect('adminoc/artikel')
    }
    
    function logout(){
        $this->session->unset_userdata('id_admin');
        $this->session->unset_userdata('nama_admin');
        $this->session->unset_userdata('level');
        session_destroy();
        redirect('adminlogin');
    }
    
  }
    
