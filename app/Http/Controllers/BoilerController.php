<?php

namespace App\Http\Controllers;

use App\Http\Resources\Boilers\BoilerResource;
use App\Http\Resources\Boilers\BoilersCollection;
use App\Services\BoilerService;
use Illuminate\Http\Request;

class BoilerController extends Controller
{
    public function __construct(
        private readonly BoilerService $boilerService,
    ){ }

    /**
     * @return BoilersCollection
     */
    public function index(): BoilersCollection
    {
        $boilers = $this->boilerService->getBoilersPaginated();

        return new BoilersCollection($boilers);
    }

    /**
     * @param int $id
     * @return BoilerResource
     */
    public function show(int $id): BoilerResource
    {
        $boiler = $this->boilerService->getBoilerById($id);

        return new BoilerResource($boiler);
    }

    /**
     * @param Request $request
     * @return BoilersCollection
     */
    public function surveyResultBoilers(Request $request): BoilersCollection
    {
        $bathtubsCount = $request->input('bathtubsCount');
        $separateShowersCount = $request->input('separateShowersCount');
        $boilerType = $request->input('boilerType');

        $surveyResultBoilers = $this->boilerService->getSurveyResultBoilersPaginated($boilerType, $bathtubsCount, $separateShowersCount);

        return new BoilersCollection($surveyResultBoilers);
    }
}
