<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Services\BagCalculatorService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(ApiRequest $request,BagCalculatorService $service)
    {

        $service->set_dimensions($request->input('length'),$request->input('width'),$request->input('depth'));
        $service->set_units($request->input('unit'),$request->input('depth_unit'));
        $result = $service->calculate_bags_count();
        $price  = $service->calculate_prices();

        return [
            'status'    => 1,
            'bag_count' => $result,
            'price'     => $price,
        ];
    }
}
