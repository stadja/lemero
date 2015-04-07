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

		$this->load->library('grocery_CRUD');

		$crud = new grocery_CRUD();
	    $crud->where('marque', $marque);

		$crud->set_table('pieces');
		$crud->set_subject('une pièce');
		$crud->set_field_upload('image1','assets/uploads/files');
		$crud->set_field_upload('image2','assets/uploads/files');
		$crud->set_field_upload('image3','assets/uploads/files');
		$crud->order_by('annee_fin', 'ASC');
		$crud->order_by('annee_debut', 'ASC');

		$crud->columns('label', 'modele', 'annee_debut', 'annee_fin', 'etat', 'prix', 'prix_unitaire', 'port_inclus', 'image1', 'image2', 'image3');
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_read();
		$crud->unset_edit();
		$crud->unset_export();
		$crud->unset_print();

		$output = $crud->render();
		$this->_crud_output($output, 'magasin/accueil', $data);
	}

/*	public function getYears($marqueId){
		$pieces = $this->db->where('marque', $marqueId)->get('pieces')->result();
		
		usort($pieces, function ($a, $b) {
			$annee_a =  $a->annee_debut;
			$annee_b =  $b->annee_debut;
			if ($a->annee_debut == $b->annee_debut) {
				$annee_a =  $a->annee_fin;
				$annee_b =  $b->annee_fin;
			}

			return ($annee_a < $annee_b) ? -1 : 1;
		});

		$years = array();
		$noDate = 0;
		$allDates = 0;
		foreach($pieces as $piece) {
			$allDates++;

			if (!$piece->annee_fin) {
				$piece->annee_fin = $piece->annee_debut;
			} elseif (!$piece->annee_debut) {
				$piece->annee_debut = $piece->annee_fin;
			}

			if (!$piece->annee_debut) {
				$noDate++;
				continue;
			}

			for ($i=$piece->annee_debut; $i <= $piece->annee_fin; $i++) { 
				if (!isset($years[$i])) {
					$years[$i] = 0;
				}
				$years[$i]++;
			}
		}

		foreach ($years as $year => $count) {
			$years[$year] += $noDate;
		}

		if ($allDates) {
			$years[0] = $allDates;
		}

		$data = array('years' => $years);
		$this->load->view('magasin/partials/yearselect', $data);
	}

	public function getModels($marqueId, $year) {
		$pieces = $this->db->where('marque', $marqueId);

		if ($year) {
			$pieces->where("((annee_debut IS NULL AND annee_fin IS NULL) 
				OR ((annee_fin IS NULL OR annee_fin < 1) AND annee_debut = $year) 
				OR (annee_debut <= $year AND annee_fin >= $year))");
		}

		$pieces = $pieces->get('pieces')->result();

		$modeles = array();

		foreach ($pieces as $piece) {
			$modele = $piece->modele;
			$modele = underscore(strtolower($modele));
			if (!isset($modeles[$modele])) {
				$modeles[$modele] = 0;
			}
			$modeles[$modele]++;
		}
		ksort($modeles);
		$data = array('modeles' => $modeles);
		$this->load->view('magasin/partials/modeleselect', $data);
	}

	public function getPieces($marqueId, $year, $modele) {
		$pieces = $this->db->where('marque', $marqueId);

		if ($year) {
			$pieces->where("((annee_debut IS NULL AND annee_fin IS NULL) 
				OR ((annee_fin IS NULL OR annee_fin < 1) AND annee_debut = $year) 
				OR (annee_debut <= $year AND annee_fin >= $year))");
		}

		$modeleSql = str_replace('_', '%', $modele);
		$pieces = $pieces->where("modele LIKE '$modeleSql'")
		->order_by('annee_debut', 'ASC')
		->get('pieces')->result();
		
		$data = array('pieces' => $pieces);
		$this->load->view('magasin/partials/listing', $data);
		
	}*/

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
