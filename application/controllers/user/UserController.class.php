<?php 


class UserController
{
	public function httpGetMethod()
	{
		return [ '_form' => new UserForm() ];
	}

	public function httpPostMethod(Http $http, array $formFields)
	{
		try 
		{
			$userModel = new UserModel();
			$userModel->signUp($formFields);

			$http->redirectTo('/');
		}
		
		catch ( DomainException $e ) 
		{
			$form = new UserForm();
			$form->bind($formFields);
			$form->setErrorMessage($e->getMessage());

			return [ '_form' => $form ];
		};
	}
}