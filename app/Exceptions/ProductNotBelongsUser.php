<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductNotBelongsUser extends Exception
{
    public function render(){
        return ['errors' => 'Product not belong to this user'];
    }
}
