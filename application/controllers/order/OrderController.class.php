<?php 


class OrderController
{
	public function httpGetMethod(Http $http, array $queryFields)
	{
		$this->verifyConnected($http);

		$mealModel = new MealModel();
		$meals = $mealModel->listAll();

		return [ 'meals' => $meals ];
	}

	public function httpPostMethod(Http $http, array $formFields)
	{
		$this->verifyConnected($http);
	}

	public function verifyConnected(Http $http)
	{
		$userSession = new UserSession();
		if (!$userSession->isConnected()) {
			$http->redirectTo('/user/login');
		}
	}
}