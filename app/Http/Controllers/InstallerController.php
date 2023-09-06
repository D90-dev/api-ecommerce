<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallerStoreRequest;
use App\Services\InstallerService;
use Illuminate\Http\JsonResponse;

class InstallerController extends Controller
{
    public function __construct(
        private readonly InstallerService $installerService
    ){ }

    /**
     * @param InstallerStoreRequest $request
     * @return JsonResponse
     */
    public function store(InstallerStoreRequest $request): JsonResponse
    {
        $this->installerService->createInstaller($request->validated(), $request->allFiles());

        return response()->json(['message' => 'Stored successfully']);
    }
}
