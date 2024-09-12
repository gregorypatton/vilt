<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Orion\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * The model associated with the resource.
     *
     * @var string
     */
    protected $model = User::class;
}
