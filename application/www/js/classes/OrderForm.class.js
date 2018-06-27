'use strict';


var OrderForm = function()
{
	this.basketSession = new BasketSession();
};

OrderForm.prototype.onChangeMeal = function() 
{
	var mealId = $('#meal').val();
	$.getJSON
	(
		getRequestUrl() + '/meal?id=' + mealId, 
		this.onAjaxChangeMeal.bind(this)        
	);
}

OrderForm.prototype.onAjaxChangeMeal = function(meal)
{
	$('#meal-details img').attr('src',getWwwUrl() + '/images/meals/' + meal.Photo);
	$('#meal-details p').text(meal.Description);
	$('#meal-details span strong').text(formatMoneyAmount(meal.SalePrice));

	$('#order-form input[name=salePrice]').val(meal.SalePrice);
}

OrderForm.prototype.onSubmitForm = function(event) 
{
	var mealId = $('#meal').val();
	var quantity = $('#quantity').val();
	var salePrice = $('input[name="salePrice"]').val();
	var name = $('#meal option:selected').text();

	this.basketSession.add(
		mealId,
		name, 
		quantity, 
		salePrice
	);
	this.refresh();
	
	$('#order-form').trigger('reset');
	$('#meal').trigger('change');

	event.preventDefault();
	return false;
}

OrderForm.prototype.refresh = function()
{
	var formFields = 
	{
		basket : this.basketSession.items
	};

	$.post(
		getRequestUrl() + '/basket',
		formFields,
		this.onAjaxRefresh.bind(this)
	);
}

OrderForm.prototype.onAjaxRefresh = function(basketViewHtml)
{
	$('#order-summary').html(basketViewHtml);

	$('#validate-order').prop(
		'disabled', 
		this.basketSession.isEmpty()
	);
}

OrderForm.prototype.onClickRemoveBasketItem = function(event) 
{
	var $button = $(event.currentTarget);
	this.basketSession.remove($button.data('meal-id'));
	this.refresh();

	event.preventDefault();
	return false;
}

OrderForm.prototype.onValidate = function() 
{
	var formFields = 
	{ 
		basketItems : this.basketSession.items 
	};

	$.post
	(
		getRequestUrl() + '/order/validation',
		formFields,
		this.onAjaxValidate.bind(this)
	);
};

OrderForm.prototype.onAjaxValidate = function(result) {
    // Désérialisation du résulat en JSON contenant le numéro de commande.

    // Redirection HTTP vers la page de demande de paiement de la commande.
};

OrderForm.prototype.run = function()
{
	$('#meal').on(
		'change', 
		this.onChangeMeal.bind(this)
	);

	$('#order-form').on(
		'submit', 
		this.onSubmitForm.bind(this)
	);

	$(document).on(
		'click', 
		'#order-summary button', 
		this.onClickRemoveBasketItem.bind(this)
	);

	$('#validate-order').on('click', this.onValidate.bind(this));

	$('#meal').trigger('change');
	this.refresh();
	$('#order-form').show();
};