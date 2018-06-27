<?php


class HomeController
{
	public function httpGetMethod()
	{
		$mealModel = new MealModel();
		$meals     = $mealModel->listAll();

		return [
			'meals' => $meals,
			'flashbag' => new Flashbag()
		];
	}
}