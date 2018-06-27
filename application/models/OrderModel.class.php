<?php 


class OrderModel
{
	public function validate($user_Id, $meals)
	{
		$db = new Database();

		$sql = '
			INSERT INTO 
				`Order`
				(`User_Id`, 
				 `TaxRate`, 
				 `CreationTimestamp`, 
				 `CompleteTimestamp`
				) 
			VALUES 
				( ? , 20 , NOW() ,  NOW() )
		';

		$orderNumber = $db->executeSql($sql, [ $user_Id ]);
		
		$sql = '
			INSERT INTO 
				`OrderLine`
				(`QuantityOrdered`, 
				 `Meal_Id`, 
				 `Order_Id`, 
				 `PriceEach`
				) 
			VALUES 
				( ? , ? , ? , ?)
		';

		$montantHT = 0;

		foreach ($meals as $meal) 
		{
			$mealPriceHT = $meal['quantity'] * $meal['salePrice'];
			$montantHT += $mealPriceHT;

			$values = [
				$meal['quantity'],
				$meal['mealId'],
				$orderNumber,
				$mealPriceHT
			];
			$db -> executeSql($sql, $values);
		}

		$sql = '
			UPDATE `Order` 
			SET `TotalAmount` 	= ? ,
				`TaxAmount`		= ? 
			WHERE Id = ?
		';

		$taxAmount = $montantHT * 0.2;

		$db->executeSql(
			$sql,
			[
				$montantHT + $taxAmount,
				$taxAmount,
				$orderNumber
			]
		);

		return $orderNumber;
	}
}