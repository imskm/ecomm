<?php

namespace App\Support\OrderBooker\Interfaces;

use App\Support\OrderBooker\Interfaces\ProductInterface;

interface OrderItemInterface
{
	public function addProduct(ProductInterface $product);
	public function getProduct();

	public function setVariation($size, $color);

	public function getVariation($key);

	public function quantity(int $qty = null);

	public function markedPrice();
	public function sellingPrice();
	public function discount();

}