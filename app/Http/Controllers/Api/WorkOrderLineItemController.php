<?php

namespace App\Http\Controllers\Api;

use App\Models\WorkOrderLineItem;
use Orion\Http\Controllers\Controller;

class WorkOrderLineItemController extends Controller
{
    /**
     * The model associated with the resource.
     *
     * @var string
     */
    protected $model = WorkOrderLineItem::class;
}
