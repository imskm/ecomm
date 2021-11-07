<?php

namespace App\EComm\Validators;

use Fantom\Validation\Validator;

/**
 * CartValidator
 */
class CartValidator extends Validator
{
	public function validateQuantityUpdate()
	{
		$this->validate("POST", [
			"cart_item_id" 	=> "required|numeric",
			"qty" 			=> "required|numeric|depneds:cart_item_id|check_stock",
		]);
	}

	protected function check_stock_rule($field, $data)
	{
		if ((int) $data < 1) {
			$this->setError($field, __FUNCTION__, "qty can not be zero and negative");
			return false;
		}

		// @TODO check stock availability

		return true;
	}
}