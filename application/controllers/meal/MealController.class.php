<?php


class MealController
{
	public function httpGetMethod(Http $http, array $queryFields)
	{
		if(array_key_exists('id', $queryFields) == true) {
			if(ctype_digit($queryFields['id']) == true) 
			{
				$mealModel = new MealModel();
				$details = $mealModel -> getDetails($queryFields['id']);
				$http -> sendJsonResponse($details);
			}
		}
		
		$http->redirectTo('/');
	}
}