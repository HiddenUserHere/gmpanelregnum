<?php

class Controller
{
	protected $view = null;
	
	//Constructor of Class
	public function __construct() {
        $this->view = new view();
    }
		
	//Model
	public function setModel($name) 
	{
        if (file_exists("model/{$name}.php")) {
            include_once "model/{$name}.php";
        }
        else {
            die("ERROR: Model {$name} not found!");
        }
 
        $this->$name = new $name();
    }
	
	public function index()
	{
		die( 'ERROR: Index not defined in Controller!' );
	}
}

?>