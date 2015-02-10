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

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
		$this->css_files = array();
		$this->js_files = array();
	}

	public function marques()
	{
		$crud = new grocery_CRUD();
		$crud->set_subject('une marque');
		$output = $crud->render();
		$this->_crud_output($output);
	}

	public function pieces()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('pieces');
		$crud->set_subject('une pièce');
		$crud->set_relation('marque','marques','label');
		$crud->set_field_upload('image','assets/uploads/files');
		$output = $crud->render();

		$this->_crud_output($output);
	}

	public function _crud_output($crud, $view = 'example.php')
	{
		$this->css_files = array_merge($this->css_files, $crud->css_files);
		$this->js_files  = array_merge($this->js_files, $crud->js_files);

		$data = array(
			'css_files' => $this->css_files,
			'js_files'  => $this->js_files,
			'crud_view' => $crud->output
		);

		$this->load->view('header', $data);
		$this->load->view($view, $data);
		$this->load->view('footer', $data);

	}

	public function index()
	{
		$this->pieces();
		// $this->load->view('welcome_message');
	}
}
