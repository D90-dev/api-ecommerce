<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostcodeRequest;
use App\Models\PostCode;
use Illuminate\Http\JsonResponse;

class PostcodeController extends Controller
{
    /**
     * @param PostcodeRequest $request
     * @return JsonResponse
     */
    public function checkPostcodeExist(PostcodeRequest $request): JsonResponse
    {
        $exists = Postcode::query()
            ->where('code', $request->input('postcode'))
            ->exists();

        return response()->json(['exists' => $exists]);
    }
}
