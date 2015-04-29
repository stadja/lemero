<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magasin extends CI_Controller {

	public $css_files;
	public $js_files;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('inflector');

		$this->css_files = array();
		$this->js_files = array();
	}

	public function index()
	{
		$this->accueil();
	}

	public function accueil($marque = false)
	{
		$data = array();

		$marques = $this->db->select('marques.*, count(pieces.id) as count')
		->join('pieces', 'pieces.marque = marques.id', 'right')
		->group_by('marques.label')
		->get('marques')->result();
		$data['marques'] = $marques;
		$data['marque_selected'] = $marque;

		$this->js_files[] = site_url('assets/js/accueil.js');

		$data['crud_view'] = false;
		if (!$marque) {
			return $this->_render('magasin/accueil', $data);
		}

		$marqueLabel = $this->db->get_where('marques', array('id' => $marque))->row();

		if (!$marqueLabel) {
			redirect('/', 'location', 301);
		}
		$marqueLabel = $marqueLabel->label;
		$data['marque_label'] = $marqueLabel;
		$data['title'] = 'Stock '.$marqueLabel;

		$this->load->library('grocery_CRUD');

		$crud = new grocery_CRUD();
	    $crud->where('marque', $marque);

		$crud->set_table('pieces');
		$crud->set_subject('une pièce');

		$crud->columns('annee_debut', 'annee_fin', 'modele', 'label', 'etat', 'prix', 'image1');
	 	$crud->display_as('label','Type de pièce');

		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_read();
		$crud->unset_edit();
		$crud->unset_export();
		$crud->unset_print();

		$crud->callback_column('prix',array($this,'_callback_prix'));

		$crud->callback_column('image1',array($this,'_callback_image'));
	 	$crud->display_as('image1','Photos');

		$crud->order_by('annee_debut', 'asc');

		$crud->add_action('Contacter le vendeur', '', '', 'ui-icon-pencil contact-action', array($this,'_callback_url_contact'));

		$output = $crud->render();
		$this->_crud_output($output, 'magasin/accueil', $data);
	}

	public function _callback_url_contact($id, $row)
	{
		return '#'.$row->id.'-'.urlencode($row->label);
	}

	public function _callback_prix($value, $row)
	{
		$prix = "<strong>".$row->prix."€</strong>";
		$prix .= $row->prix_unitaire ? ' (prix unitaire)' : '';
		$prix .= $row->port_inclus ? ' - frais de port inclus' : ' + frais de port à ajouter';
  		return $prix;
	}

	public function _callback_image($value, $row)
	{
		$images = '';
		$fancybox = '';
		if ($row->image1) {
			$url = site_url("/assets/uploads/files/".$row->image1);
			$fancybox .= '<a class="fancybox" rel="group-'.$row->id.'" href="'.$url.'"><img height="50" class="thumbnailImage" src="'.$url.'" alt="" data-holder-rendered="true" style="display: inline-block;"/></a>';
		}
		if ($row->image2) {
			$url = site_url("/assets/uploads/files/".$row->image2);
			$fancybox .= '<a class="fancybox" rel="group-'.$row->id.'" href="'.$url.'"><img height="50" class="thumbnailImage" src="'.$url.'" alt="" data-holder-rendered="true" style="display: inline-block;"/></a>';
		}
		if ($row->image3) {
			$url = site_url("/assets/uploads/files/".$row->image3);
			$fancybox .= '<a class="fancybox" rel="group-'.$row->id.'" href="'.$url.'"><img height="50" class="thumbnailImage" src="'.$url.'" alt="" data-holder-rendered="true" style="display: inline-block;"/></a>';
		}

  		return $fancybox;
	}

	public function ask() {
		$this->load->helper('email');

		$email = $this->input->get('email');
		if (!valid_email($email)) {
		    $this->sendError('email is not valid');
		}
		
		$name = $this->input->get('name');
		$tel = $this->input->get('tel');
		$msg = $this->input->get('msg');
		$msg = preg_replace( "/\n/", '<br/>', $msg);
		$id = $this->input->get('id');
		$piece  = $this->db->get_where('pieces', array('id' => $id))->result();
		$piece  = $piece[0];
		$marque = $this->db->get_where('marques', array('id' => $piece->marque))->result();
		$marque  = $marque[0];

		$this->load->library('email');

		$config = array();
		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$this->email->from('garage@lemero.fr', 'Client du Garage');
		$this->email->to('contact@lemero.fr');
		$this->email->bcc('stadja@gmail.com');

		$this->email->subject("Une demande de contact a été faite");

		$message = 'Bonjour, <br/><br/>';
		$message .= 'une commande a été faite pour:<br/>';
		$message .= "<strong>".$piece->label."</strong>".' de '.$marque->label.'<br/>';
		$message .= "annee: ".$piece->annee_debut.'<br/>';
		$message .= "prix: ".$piece->prix.'<br/>';
		$message .= "prix unitaire: ".($piece->prix_unitaire ? 'oui': 'non').'<br/>';
		$message .= "ports inclus: ".($piece->port_inclus ? 'oui': 'non').'<br/>';
		$message .= "<br/>";
		$message .= "Par:<br/>";
		$message .= "- name: $name<br/>";
		$message .= "- email: $email<br/>";
		$message .= "- tel: $tel<br/>";
		$message .= "- msg:<br/>'$msg<br/>'";

		$this->email->message($message);

		$this->email->send();

		$data = array('status' => 'success');
		echo json_encode($data);
		die();
	}

	protected function sendError($msg) {
		$data = array('status' => 'error', 'msg' => $msg);
		echo json_encode($data);
		die();
	}

	protected function _render($view, $data = array())
	{
		$data = array_merge($data, array(
			'css_files' => $this->css_files,
			'js_files'  => $this->js_files
		));

		$this->load->view('header', $data);
		$this->load->view($view, $data);
		$this->load->view('footer', $data);

	}

	protected function _crud_output($crud, $view = 'crud.php', $data = array())
	{
		$this->css_files = array_merge($this->css_files, $crud->css_files);
		$this->js_files  = array_merge($this->js_files, $crud->js_files);

		$data['css_files'] = $this->css_files;
		$data['js_files'] = $this->js_files;
		$data['crud_view'] = $crud->output;

		$this->load->view('header', $data);
		$this->load->view($view, $data);
		$this->load->view('footer', $data);

	}
}
