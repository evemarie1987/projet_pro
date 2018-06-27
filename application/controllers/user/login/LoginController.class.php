<?php 


class LoginController
{
	public function httpGetMethod()
	{
		return [ '_form' => new LoginForm() ];
	}

	public function httpPostMethod(Http $http, array $formFields)
	{
		try 
		{
			$userModel = new UserModel();

			$user = $userModel->checkEmailandPassword(
				$formFields['email'], 
				$formFields['password']
			);

			$userSession = new UserSession();
			$userSession -> create(
				$user['Id'], 
				$user['FirstName'], 
				$user['LastName'], 
				$user['Email']
			);

			$http->redirectTo('/');
		}
		
		catch ( DomainException $e) 
		{
			$form = new LoginForm();
			$form->bind($formFields);
			$form->setErrorMessage($e->getMessage());

			return [ '_form' => $form ];
		}
	}	
}