<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	 function __construct(){
		parent::__construct();
		$this->load->database();
		 
		
		if($this->session->userdata('auth')!=true){
				redirect('Biblioteca');
				dic("");
		};
	}

	public function index()
	{
		$this->load->view('biblioteca/header');
		$this->load->view('biblioteca/menu');
		$this->load->view('biblioteca/welcome_message');
		$this->load->view('biblioteca/footer');
		
	}
	public function infopersonal(){
		
		if($this->session->userdata('auth')!=true) die("ascesso denegado");{
			$idp=$this->session->userdata('id');
			
			$data['usuario'] = $this->db->query("SELECT * FROM usuario WHERE usua_id='{$idp}'")->row();
		
			$this->load->view('biblioteca/header');
		    $this->load->view('biblioteca/menu');
			$this->load->view('biblioteca/infopersonal',$data);
		    $this->load->view('biblioteca/footer');
	   }
	}

	

	public function usuario()
	{
		

		$this->load->view('biblioteca/formUsuario');
		
	}
	public function tabusuarios()
	{ 
		$this->load->model('model_usuario');
        $result = $this->model_usuario->consultar();
		$datos = array('registros'=>$result);
		
		
		$this->load->view('biblioteca/tabusuarios',$datos);
		
	}
	public function ejemplar()
	{

		$this->load->helper('form');


		
		$this->load->model('model_categoria');
        $result = $this->model_categoria->consultar();
		$datos = array('registros'=>$result);
		$error = array('error'=>'');

		$todo = $datos + $error;

		$this->load->helper("formularioEjem");

		$this->load->view('biblioteca/formEjemplar',$todo);


		
	}
	public function tabejemplar()
	{
	

		/*$this->load->model('model_categoria');
		$opciones = $this->model_categoria->obtener();
		$datos['registros']=$opciones;*/
		
		$this->load->view('biblioteca/tabEjemplar');//,$datos);
		
	}
	public function categoria()
	{
		$this->load->helper('form');


		
		$this->load->helper("formularioCat");


		$this->load->view('biblioteca/formCategoria1');
	}
	
	public function buscar(){

		$this->load->helper('form');
		$this->load->model('model_categoria');
		$opciones = $this->model_categoria->getCategoria();
	

		$data['opciones']=$opciones;

		$this->load->view('biblioteca/formBuscar',$data);
	}
	public function ver(){
		$this->load->view('biblioteca/pruebas');
	}


	public function tablacategoria(){
		$this->load->view('biblioteca/tabCategoria2');
	}

	//aqui la funcion del datatable:


}

