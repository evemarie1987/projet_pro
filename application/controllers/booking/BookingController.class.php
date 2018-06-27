<?php 


class BookingController
{
	public function httpGetMethod(Http $http)
	{
		$this->verifyConnected($http);
	}

	public function httpPostMethod(Http $http, array $formFields)
	{
		$this->verifyConnected($http);
		
		$userSession = new UserSession();
		$bookingModel = new BookingModel();

		$bookingModel->create(
			$userSession->getUserId(),
			$formFields['bookingDate'], 
			$formFields['bookingTime'], 
			$formFields['numberOfSeats']
		);

		$http->redirectTo('/');

	}

	private function verifyConnected(Http $http)
	{
		$userSession = new UserSession();
		if (!$userSession->isConnected()) {
			$http->redirectTo('/user/login');
		}
	}
}