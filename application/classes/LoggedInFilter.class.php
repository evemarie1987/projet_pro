<?php 


class LoggedInFilter implements InterceptingFilter
{
	public function run(Http $http, array $queryFields, array $formFields) 
	{
		$userSession = new UserSession();
		return [
			'isConnected' => $userSession->isConnected(),
			'fullName' => $userSession->getFullName()
		];
	}
}

