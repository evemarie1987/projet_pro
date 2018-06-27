<?php 


class UserForm extends Form
{
	public function build() 
	{
		$this->addFormField('firstName');
		$this->addFormField('lastName');
		$this->addFormField('email');
		$this->addFormField('birthDate');
		$this->addFormField('address');
		$this->addFormField('city');
		$this->addFormField('zipCode');
		$this->addFormField('phone');
	}
}