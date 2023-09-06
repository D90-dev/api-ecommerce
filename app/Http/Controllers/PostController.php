<?php

namespace App\Http\Controllers;

use App\Http\Resources\Posts\PostsCollection;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService,
    ){ }

    /**
     * @return PostsCollection
     */
    public function index(): PostsCollection
    {
        $posts = $this->postService->getPostsPaginated();

        return new PostsCollection($posts);
    }
}
