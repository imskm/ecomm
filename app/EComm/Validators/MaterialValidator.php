<?php 

namespace App\EComm\Validators;
use Fantom\Validation\Validator;
/**
 * 
 */
class MaterialValidator extends Validator
{
	
	public function validateMaterialCreate()
	{
		$this->validate("POST",[
			"material" => "required|max:16|alpha_space|unique:materials,material",
		]);
	}

}