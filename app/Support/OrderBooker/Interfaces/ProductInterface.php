<?php

namespace App\Support\OrderBooker\Interfaces;

interface ProductInterface
{
	public function markedPrice();
	public function sellingPrice();
	public function discount();
}