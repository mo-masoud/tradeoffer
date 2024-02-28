<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentIndexRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function index(CommentIndexRequest $request): JsonResponse
    {
        $comments = $request->buildQuery()
            ->paginate($request->input('per_page', 15))
            ->withQueryString();
        return api_response(new CommentCollection($comments));
    }

    public function store(StoreCommentRequest $request): JsonResponse
    {
        return api_response(new CommentResource($request->placeComment()));
    }
}
