<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Garage extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public $css_files;
	public $js_files;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('cookie');

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');

		$this->css_files = array();
		$this->js_files = array();
	}

	public function security() {
		return $this->_render('security');
	}

	public function disconnect() {
		$cookie = array(
		    'name'   => 'lmpa',
		    'value'  => '',
		    'expire' => '86500',
		    'domain' => $this->config->item('domain'),
		    'path'   => '/',
		    'secure' => false
		);
		$this->input->set_cookie($cookie);

		return redirect('/');
	}

	public function testSecurity() {
		$input = $this->input->get('password');
		if ($input) {
			$cookie = array(
			    'name'   => 'lmpa',
			    'value'  => md5($input),
			    'expire' => '86500',
			    'domain' => $this->config->item('domain'),
			    'path'   => '/',
			    'secure' => false
			);
			$this->input->set_cookie($cookie);
			redirect(current_url());
		}
		$securityCheck = $this->config->item('security');
		$security = $this->input->cookie('lmpa');
		return md5($securityCheck) == $security;
	}

	public function marques()
	{
		if (!$this->testSecurity()) {
			return $this->security();
		}
		$crud = new grocery_CRUD();
		$crud->set_subject('une marque');
		$output = $crud->render();
		$this->_crud_output($output);
	}

	public function pieces()
	{
		if (!$this->testSecurity()) {
			return $this->security();
		}
		$crud = new grocery_CRUD();
		$crud->set_table('pieces');
		$crud->set_subject('une pièce');
		$crud->set_relation('marque','marques','label');
		$crud->set_field_upload('image1','assets/uploads/files');
		$crud->set_field_upload('image2','assets/uploads/files');
		$crud->set_field_upload('image3','assets/uploads/files');
		$crud->order_by('annee_fin', 'ASC');
		$crud->order_by('annee_debut', 'ASC');
		
		$crud->callback_after_upload(function($uploader_response,$field_info, $files_to_upload) {

			//Is only one file uploaded so it ok to use it with $uploader_response[0].
			$fileUploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
			$thumbnail 	  = $field_info->upload_path.'/thumbnails/'.$uploader_response[0]->name; 

			$config['image_library'] = 'gd2';
			$config['source_image'] = $fileUploaded;
			$config['maintain_ratio'] = TRUE;
			$config['width']         = 800;
			$config['height']       = 600;
			// $config['new_image'] = $thumbnail;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			return true;
		});

		$output = $crud->render();

		$this->_crud_output($output);
	}

/*	function example_callback_after_upload($uploader_response,$field_info, $files_to_upload)
{
    $this->load->library('image_moo');
 
    //Is only one file uploaded so it ok to use it with $uploader_response[0].
    $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
 
    $this->image_moo->load($file_uploaded)->resize(800,600)->save($file_uploaded,true);
 
    return true;
}*/

	protected function _crud_output($crud, $view = 'crud.php')
	{
		$this->css_files = array_merge($this->css_files, $crud->css_files);
		$this->js_files  = array_merge($this->js_files, $crud->js_files);

		$data = array(
			'css_files' => $this->css_files,
			'js_files'  => $this->js_files,
			'crud_view' => $crud->output,
			'title' => false
		);

		$this->load->view('header', $data);
		$this->load->view($view, $data);
		$this->load->view('footer', $data);
	}

	protected function _render($view, $data = array())
	{
		$data = array_merge($data, array(
			'css_files' => $this->css_files,
			'js_files'  => $this->js_files,
			'title' => false
		));

		$this->load->view('header', $data);
		$this->load->view($view, $data);
		$this->load->view('footer', $data);

	}

	public function index()
	{
		if (!$this->testSecurity()) {
			return $this->security();
		}
		$this->pieces();
		// $this->load->view('welcome_message');
	}
}
