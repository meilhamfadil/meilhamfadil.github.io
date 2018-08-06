<?php 

class Privileges{
	
	public $privileges =  array(
		"hrd" => array("Home", "My404"),
		"users" => array("Home", "My404"),
		"all" => array(),
		"hrd_user" => array("9508061", "7301018")
	);
	private $key = "";
	private $session_cheker = false;
	private $CI;

	function __construct(){
		$this->CI = &get_instance();
		$this->key = $this->CI->config->item("user_index");
		$this->privileges['all'] = scandir(MODULESPATH);

		switch ($this->CI->uri->segment(1)) {
			case '':
				redirect(base_url("home"));
				break;
			case 'login':
			case 'register':
				if (empty($this->CI->uri->segment(2))){
					if (isset($_SESSION[$this->key])) {
						redirect(base_url("home"));
					}
				}
				break;
			default:
				if ($this->session_cheker and empty($_SESSION[$this->key])) {
		            redirect(base_url("login"));
		        } else {
					$this->checkModules("users");
		        }
				break;
		}
	}

	private function checkModules($priv){
		if (!in_array(ucfirst($this->CI->uri->segment(1)), $this->privileges[$priv])) {
			if (in_array(ucfirst($this->CI->uri->segment(1)), $this->privileges['all'])) {
				exit(modules::run("My404"));
			}
		}
	}

}