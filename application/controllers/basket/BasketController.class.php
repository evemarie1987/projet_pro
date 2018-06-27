<?php


class BasketController
{
	public function httpPostMethod(Http $http, Array $formFields)
	{
		$userSession = new UserSession();
		if ($userSession->isConnected() == false) {
			$http->redirectTo('/user/login');
		}
		
		if (array_key_exists('basket', $formFields)) {
			$basket = $formFields['basket'];
		}
		else {
			$basket = [];
		}
		
		return [
			'basketItems' => $basket,
			'_raw_template' => true
		];
	}
}