<?php

namespace App\Http\Controllers\Api;

use App\Models\PurchaseOrder;
use Orion\Http\Controllers\Controller;

class PurchaseOrderController extends Controller
{
    /**
     * The model associated with the resource.
     *
     * @var string
     */
    protected $model = PurchaseOrder::class;
}
