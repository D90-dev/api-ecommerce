<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService
{
    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPostsPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Post::query()->with('file')->paginate($perPage);
    }
}
