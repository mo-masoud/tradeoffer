<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchIndexRequest;
use App\Http\Resources\BranchCollection;
use Illuminate\Http\JsonResponse;

class BranchController extends Controller
{
    public function index(BranchIndexRequest $request): JsonResponse
    {
        $branches = $request->buildQuery()
            ->paginate(request('per_page', 15))
            ->withQueryString();

        return api_response(new BranchCollection($branches));
    }
}
