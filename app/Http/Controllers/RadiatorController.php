<?php

namespace App\Http\Controllers;

use App\Http\Requests\RadiatorParameterRequest;
use App\Http\Resources\Radiators\RadiatorResource;
use App\Models\Radiator;
use App\Services\RadiatorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RadiatorController extends Controller
{
    public function __construct(
        private readonly RadiatorService $radiatorService,
    ) { }

    /**
     * @param RadiatorParameterRequest $request
     * @return JsonResponse
     */
    public function parameters(RadiatorParameterRequest $request): JsonResponse
    {
        $type = $request->input('type');
        $height = $request->input('height');
        $length = $request->input('length');

        $parameters = $this->radiatorService->getParametersData($type, $height, $length);

        return response()->json($parameters);
    }

    /**
     * @param Request $request
     * @return RadiatorResource
     */
    public function getRadiator(Request $request): RadiatorResource
    {
        $type = $request->input('type');
        $height = $request->input('height');
        $length = $request->input('length');

        $radiator = $this->radiatorService->getRadiatorByGivenParameters($type, $height, $length);

        return new RadiatorResource($radiator);
    }
}
