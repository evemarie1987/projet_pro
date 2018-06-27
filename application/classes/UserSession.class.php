<?php 


class UserSession
{
	function __construct() 
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	public function create($id, $firstName, $lastName, $email)
	{
		$_SESSION['user'] = [
			'id' => $id,
			'firstName' => $firstName,
			'lastName' => $lastName,
			'email' => $email
		];

		$flashBag = new FlashBag();
		$flashBag->add( 'Vous êtes maintenant connecté.' );
	}

	public function isConnected() 
	{
		if (array_key_exists('user', $_SESSION)) {
			if(!empty($_SESSION['user'])) {
				return true;
			}
		}
		return false;
	}

	public function destroy() 
	{
		$_SESSION = array();
		session_destroy();

		$flashBag = new FlashBag();
		$flashBag->add( 'Vous êtes déconnecté, à bientôt.' );
	}

	public function getEmail() 
	{
		if (!$this->isConnected()) {
			return null;
		}
		return $_SESSION['user']['email'];
	}

	public function getFirstName() 
	{
		if (!$this->isConnected()) {
			return null;
		}

		return $_SESSION['user']['firstName'];
	}

	public function getFullName() 
	{
		if (!$this->isConnected()) {
			return null;
		}
		return $_SESSION['user']['firstName'].' '.$_SESSION['user']['lastName'];
	}

	public function getLastName() 
	{
		if (!$this->isConnected()) {
			return null;
		}
		return $_SESSION['user']['lastName'];
	}

	public function getUserId() 
	{
		if (!$this->isConnected()) {
			return null;
		}
		return $_SESSION['user']['id'];
	}
}