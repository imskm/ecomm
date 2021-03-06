<?php

namespace App\EComm\Validators;

use App\Support\Validations\ImageValidationRuleTrait;
use Fantom\Validation\Validator;

/**
 * ProductValidtor
 */
class ProductValidtor extends Validator
{
	use ImageValidationRuleTrait;

	private $create_update_rules = [
		"title" 		=> "required|alpha_space|max:256",
		"description" 	=> "optional|max:512",
		"price_mp" 		=> "required|numeric",
		"price_sp" 		=> "required|numeric",
		"category_id" 	=> "required|numeric|exist:product_categories,id",
		"material_id" 	=> "required|numeric|exist:materials,id",
		"is_returnable" => "optional",
	];

	public function validateCreate()
	{
		$this->validate("POST", [
			"code" 			=> "required|alpha_num|max:8|unique:products,code",
			"title" 		=> "required|alpha_space|max:256",
			"description" 	=> "optional|max:512",
			"price_mp" 		=> "required|numeric",
			"price_sp" 		=> "required|numeric",
			"category_id" 	=> "required|numeric|exist:product_categories,id",
			"material_id" 	=> "required|numeric|exist:materials,id",
			"is_returnable" => "optional",
		]);
	}

	public function validateUpdate()
	{
		$id = (int) post_or_empty("id");
		$code_rule = "required|alpha_num|max:8|unique_xself:products,code,id,".$id;

		$this->validate("POST", [
			"id" 			=> "required|numeric|exist:products,id",
			"code" 			=> $code_rule,
			"title" 		=> "required|alpha_space|max:256",
			"description" 	=> "optional|max:512",
			"price_mp" 		=> "required|numeric",
			"price_sp" 		=> "required|numeric",
			"category_id" 	=> "required|numeric|exist:product_categories,id",
			"material_id" 	=> "required|numeric|exist:materials,id",
			"is_returnable" => "optional",
		]);
	}

	public function validateSizeCreate()
	{
		$this->validate("POST", [
			"product_id" 		=> "required|numeric|exist:products,id",
			"size_ids"			=> "required_array|numeric_array"
		]);
	}

	public function validateColorCreate()
	{
		$this->validate("POST", [
			"product_id" 	=> "required|numeric|exist:products,id",
			"color_ids" 	=> "required_array|numeric_array",
		]);
	}

	public function validateStockCreate()
	{
		$this->validate("POST",[
			"product_id" 	=> "required|numeric|exist:products,id",
			"size_ids" 		=> "required_array|numeric_array",
			"stock" 		=> "required_array|numeric_array",
		]);
	}

	public function validateImageCreate()
	{
		$this->validate("POST", [
			"product_id" 	=> "required|numeric|exist:products,id",
			"photo"			=> "xrequired_file|xfile:image,204800"
		]);
	}

	public function validateImageUpdate()
	{
		$this->validate("POST", [
			"id" 			=> "required|numeric|exist:product_images,id",
			"photo"			=> "xrequired_file|xfile:image,204800"
		]);
	}

	protected function required_array_rule($field, $data)
	{
		if (is_array($data) === false) {
			$this->setError($field, __FUNCTION__, "product size must be array");
			return false;
		}

		return true;
	}

	protected function numeric_array_rule($field, $data)
	{
		if (is_array($data) === false) {
			$this->setError($field, __FUNCTION__, "product size must be array");
			return false;
		}

		foreach ($data as $d) {
			if (is_numeric($d) === false) {
				$this->setError($field, __FUNCTION__, "one of the product size in not number");
				return false;
			}
		}

		return true;
	}
}