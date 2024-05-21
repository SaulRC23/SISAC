<?php  
/**
 * 
 */
class Sesion
{
	private $login = false;
	private $usuario;
	private $admon;
	
	function __construct()
	{
		session_start();
		if (isset($_SESSION['usuario'])) {
			$this->usuario = $_SESSION['usuario'];
			$this->admon = "admon"; //$this->usuario["tipoUsuario"];
			$this->login = true;
		} else {
			unset($this->usuario);
			$this->login = false;
		}
	}

	public function iniciarLogin($usuario='')
	{
		if ($usuario) {
			$this->usuario = $_SESSION["usuario"] = $usuario;
			$this->login = true;
		}
	}

	public function fializarLogin()
	{
		if (isset($_SESSION['usuario'])) {
			unset($_SESSION['usuario']);
		}
		if (isset($this->usuario)) {
			unset($this->usuario);
		}
		$this->login = false;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function getUsuario()
	{
		return $this->usuario;
	}

	public function getAdmon()
	{
		return $this->usuario["tipo"];
	}

	public function setUsuario($data)
	{
		$this->usuario=$_SESSION['usuario']=$data;
	}
}


?>