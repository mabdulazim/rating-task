<?php
namespace App\Transformers;

use League\Fractal;
use App\Models\Rates;

class RateTransformer extends Fractal\TransformerAbstract
{
	protected $defaultIncludes = ['user'];

	public function transform( $rate)
	{
	    return [
            'rate' => (int) $rate->rate,
	    ];
	}

	public function includeUser($rate)
    {
        return $this->item($rate->users, new UserTransformer());
    }
}