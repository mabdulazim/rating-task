<?php

namespace App\Services;

use App\Models\Users;

class UserService {

    public function isUserExist($userId)
    {
        $user = Users::findFirst([
            "conditions" => "id = $userId"
        ]);

        return $user ? true : false;
    }
    

}

