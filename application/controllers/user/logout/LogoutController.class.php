<?php 


class LogoutController
{
	public function httpGetMethod(Http $http)
	{
		$userSession =new UserSession();
		$userSession -> destroy();

		$http->redirectTo('/');
	}
}