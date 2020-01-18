<?php
namespace App\Transformers;

use League\Fractal;
use App\Models\Products;
use Phalcon\Http\Request;

class ProductTransformer extends Fractal\TransformerAbstract
{
	private $userId;
	protected $availableIncludes = ['rates'];

	public function __construct($userId = null)
	{
		$this->userId = $userId;
	}

	public function transform(Products $product)
	{
	    return [
			'id'          => (int) $product->id,
			'code' 	 	  => (int) $product->code,
			'name'   	  => $product->name,
			'description' => $product->description,
			'price'		  => (float) $product->price,
			'rate'		  => $this->rateAvg($product->rates->toArray()),
			'editable'    => $product->user_id == $this->userId ? true : false,
	    ];
	}

	public function rateAvg($productRates)
	{
		if(is_array($productRates) && count($productRates) > 0) {

			$rates = array_map(function($rate) { 
				return $rate['rate'];
			}, $productRates);
	
			$avg = array_sum($rates) / count($rates);
			return round($avg);
		}

		return 0;
	}

	public function includeRates(Products $product)
    {
        return $this->collection($product->rates, new RateTransformer(), false);
    }
}