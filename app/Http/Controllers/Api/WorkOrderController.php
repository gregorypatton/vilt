<?php

namespace App\Http\Controllers\Api;

use App\Models\WorkOrder;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;

class WorkOrderController extends Controller
{
    use DisableAuthorization;
    /**
     * The model associated with the resource.
     *
     * @var string
     */
    protected $model = WorkOrder::class;
}
