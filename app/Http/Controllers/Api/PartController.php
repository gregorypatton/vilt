<?php

namespace App\Http\Controllers\Api;

use App\Models\Part;
use Orion\Http\Controllers\Controller;

class PartController extends Controller
{
    /**
     * The model associated with the resource.
     *
     * @var string
     */
    protected $model = Part::class;
}
