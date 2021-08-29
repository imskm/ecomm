<?php 

namespace App\EComm\Validators;
use Fantom\Validation\Validator;

/**
 * 
 */
class ColorValidator extends Validator
{
	
	public function validateCreate()
	{
		$this->validate("POST",[
			"color" => "required|alpha_num|max:64|unique:colors,color",
			"code" => "required|alpha_num|max:6|unique:colors,code",
		]);

	}
}