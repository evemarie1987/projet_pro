<?php


class MealModel
{
	public function listAll() 
	{
		$db = new Database();
		$sql = 'SELECT * FROM Meal';
	
		return $db->query($sql);
	}

	public function getDetails($mealId)
	{
		$db = new Database();
		$sql = 'SELECT * FROM Meal WHERE Id = ?';
		
		return $db -> queryOne(
			$sql, 
			[ $mealId ]
		);
	}
}