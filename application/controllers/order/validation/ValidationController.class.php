<?php


class ValidationController
{
	public function httpPostMethod(Http $http, Array $formFields)
	{
		$userSession = new UserSession();
		if (!$userSession->isConnected()) {
			$http->redirectTo('/user/login');
		}
		
		$userId = $userSession->getUserId();

		if (array_key_exists('basketItems', $formFields)) {
			$basketItems = $formFields['basketItems'];
		}
		else {
			$basketItems = [];
		}

		$orderModel = new OrderModel();
		$orderNumber = $orderModel->validate($userId, $basketItems);

		$http->sendJsonResponse($orderNumber);
	}
}