'use strict';

var BasketSession = function()
{
	this.items = null;
	this.load();
};

BasketSession.prototype.load = function()
{
	this.items = loadDataFromDomStorage('panier');

	if(this.items === null) {
		this.items = new Array();
	}
};

BasketSession.prototype.save = function()
{
	saveDataToDomStorage('panier', this.items);
};

BasketSession.prototype.clear = function()
{
	saveDataToDomStorage('panier', null );
};

BasketSession.prototype.isEmpty = function()
{
	return ( this.items.length == 0 );
};


BasketSession.prototype.remove = function(mealId)
{
	for (var i = 0; i < this.items.length; i++) {
		if(this.items[i].mealId == mealId)
		{
			this.items.splice(i,1);
			this.save();
			return true;
		}
	}

	return false;
};

BasketSession.prototype.add = function(mealId, name, quantity, salePrice)
{
	mealId 		= parseInt(mealId);
	quantity 	= parseInt(quantity);
	salePrice 	= parseFloat(salePrice);

	if (quantity <= 0) {
		return false;
	}

	for (var i = 0; i < this.items.length; i++) {
		if (this.items[i].mealId == mealId)
		{
			this.items[i].quantity += quantity;
			this.save();
			return;
		}
	}

	this.items.push(
	{
		mealId		: mealId,
		name		: name,
		quantity	: quantity,
		salePrice	: salePrice
	});

	this.save();
};