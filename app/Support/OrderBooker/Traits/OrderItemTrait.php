<?php

namespace App\Support\OrderBooker\Traits;

use App\Support\OrderBooker\Interfaces\ProductInterface;

trait OrderItemTrait
{
	private $_product;
	private $_size;
	private $_color;
	private $_qty = 0;
	private $_variation = [];

	public function addProduct(ProductInterface $product)
	{
		$this->_product = $product;
	}

	public function getProduct()
	{
		return $this->_product;
	}

	public function setVariation($key, $variation)
	{
		$this->_variation[$key] = $variation;
	}

	public function getVariation($key)
	{
		return array_key_exists($key, $this->_variation)
			? $this->_variation[$key]
			: null;
	}

	public function quantity(int $qty = null)
	{
		if ($qty) {
			$this->_qty = $qty;
		} else {
			return $this->_qty;
		}
	}

	public function markedPrice()
	{
		return $this->_product->markedPrice();
	}

	public function sellingPrice()
	{
		return $this->_product->sellingPrice();
	}

	public function discount()
	{
		return $this->_product->discount();
	}


}