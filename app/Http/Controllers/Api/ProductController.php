<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Orion\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * The model associated with the resource.
     *
     * @var string
     */
    protected $model = Product::class;
}
