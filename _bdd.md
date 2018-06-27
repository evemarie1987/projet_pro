		### base de donnees pour e-commerce

#### User
* Id (vers order et booking)
* FirstName
* LastName
* BirthDay
* Email
* Password
* Address
* ZipCode
* Phone
* City
* Country
* CreationTimestamp
* LastLoginTimestamp

#### Meal/Dish
* Id (vers orderLine)
* Name
* Description
* BuyPrice
* SellPrice
* QuantityInStock
* Photo

#### Order
* Id (vers OrderLine)
* User_Id
* TotalAmount
* TaxRate
* TaxAmount
* CreationTimestamp
* CompletedTimestamp

#### Booking
* Id (vers OrderLine)
* User_Id
* NumberOfSeats
* BookingDate
* BookingTime
* CreationTimestamp

#### OrderLine
* Id
* Order_Id
* Meal_Id
* QuantityOrdered
* PriceEach (mealprice*quantity)
