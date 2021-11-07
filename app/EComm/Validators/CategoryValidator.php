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

	public function validateUpdate()
	{
		$id = (int) post_or_empty("id");

		$this->validate("POST",[
			"category" => "required|alpha_space|max:64|unique_xself:product_categories,category,id,".$id,
		]);
	}
}