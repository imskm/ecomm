<?php 

namespace App\EComm\Validators;

use Fantom\Validation\Validator;

/**
 * 
 */
class CategoryValidator extends Validator
{
	
	public function validateCreate()
	{
		$this->validate("POST",[
			"category" => "required|alpha_space|max:64|unique:product_categories,category"
		]);
	}
}