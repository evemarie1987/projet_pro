<?php 


class BookingModel
{
	public function	create($user_Id, $bookingDate, $bookingTime, $numberOfSeats)
	{
		$db = new Database();
		$sql = '
			INSERT INTO 
				`Booking`
				(`BookingDate`, 
				 `BookingTime`, 
				 `NumberOfSeats`, 
				 `User_Id`, 
				 `CreationTimestamp`) 
			VALUES 
				( ? , ? , ? , ? , NOW() )
		';

		$db -> executeSql( 
			$sql, 
			[	$bookingDate, 
				$bookingTime, 
				$numberOfSeats, 
				$user_Id
			]
		);

		$flashBag = new FlashBag();
		$flashBag->add( 'Votre réservation est bien enregistrée, nous vous en remercions.' );

	}
}