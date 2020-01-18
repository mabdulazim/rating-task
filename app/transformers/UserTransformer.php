<?php
namespace App\Transformers;

use League\Fractal;
use App\Models\Users;

class UserTransformer extends Fractal\TransformerAbstract
{

	public function transform( $user)
	{
	    return [
            'id'   => (int) $user->id,
            'name' => $user->name
	    ];
    }
    
}