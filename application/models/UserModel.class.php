<?php 


class UserModel
{
	public function signUp(	$formFields )
	{
		$sql = 'SELECT Email FROM User WHERE Email = ?';
		$db = new Database();

		if ($db->queryOne($sql, [ $formFields['email'] ])) {
			throw new DomainException
			(
				"Cet e-mail est déjà pris"
			);
		}
		
		$formFields['password'] = $this->hashPassword($formFields['password']);
		
		if (!isset($formFields['country'])) {
			$formFields['country'] = 'France';
		}

		$sql = '
			INSERT INTO 
				`User`
				( `FirstName`, 
				`LastName`, 
				`Email`, 
				`Password`, 
				`BirthDate`, 
				`Address`, 
				`City`, 
				`ZipCode`, 
				`Country`, 
				`Phone`, 
				`CreationTimestamp` ) 
			VALUES 
			( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , NOW() )
		';

		$values = 
		[
			$formFields['firstName'], 
			$formFields['lastName'], 
			$formFields['email'], 
			$formFields['password'], 
			$formFields['birthDate'], 
			$formFields['address'], 
			$formFields['city'], 
			$formFields['zipCode'], 
			$formFields['country'], 
			$formFields['phone']  
		];

		$db->executeSql($sql, $values);

		$flashBag = new FlashBag();
		$flashBag->add( 'Votre compte utilisateur a bien été créé.' );
	}

	private function hashPassword($password)
	{
		/*
		* Génération du sel, nécessite l'extension PHP OpenSSL pour fonctionner.
		*
		* openssl_random_pseudo_bytes() va renvoyer n'importe quel type de caractères.
		* Or le chiffrement en blowfish nécessite un sel avec uniquement les caractères
		* a-z, A-Z ou 0-9.
		*
		* On utilise donc bin2hex() pour convertir en une chaîne hexadécimale le résultat,
		* qu'on tronque ensuite à 22 caractères pour être sûr d'obtenir la taille
		* nécessaire pour construire le sel du chiffrement en blowfish.
		*/
		$salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);

		return crypt($password, $salt);
	}

	private function verifyPassword($password, $hashpassword)
	{
		return crypt($password, $hashpassword) == $hashpassword;
	}

	public function checkEmailAndPassword($email, $password) 
	{
		$db = new Database();

		$sql= '
			SELECT 
				Id, 
				FirstName,
				LastName,
				Email,
				Password
			FROM User
			WHERE Email = ?
		';

		$user = $db->queryOne($sql, [$email] );

		if (empty($user)) {
			throw new DomainException
			(
				"Il n'y a pas de compte utilisateur associé à cette adresse email"
			);
		}

		if (!$this->verifyPassword($password, $user['Password'] )) {
			throw new DomainException
			(
				"Mauvais mot de passe"
			);
		}

		return $user;
	}
}