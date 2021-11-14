<?php

namespace App\EComm\Traits;

trait ModelOperationTrait
{
	public function thisId()
	{
		if ($this->lastId()) {
			return $this->lastId();
			// echo "<pre>";
			// print_r($this->lastId());
			// echo "</pre>";
			// exit;
		}


		return $this->id;

	}
	public static function find($id)
	{
		if (is_null($model = parent::find((int) $id))) {
			return $model;
		}

		return $model->first();
	}

	public static function recent($page=1, $items = 20)
	{
		$table = self::$_table;
		$offset = calc_page_offset($page , $items);
		$sql = "
				SELECT *
				FROM $table
				ORDER BY id DESC
				LIMIT {$items} OFFSET {$offset} 
		";
		return static::raw($sql);
	}
}