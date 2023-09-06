<?php

namespace App\Services;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;

class FaqService
{
    /**
     * @return Collection
     */
    public function getFaqs(): Collection
    {
        return Faq::all();
    }

    /**
     * @param string|null $query
     * @return Collection
     */
    public function getSearchedFaqs(?string $query): Collection
    {
        return Faq::query()
            ->where('question', 'LIKE', '%'.strtolower($query).'%')
            ->orWhere('answer', 'LIKE', '%'.strtolower($query).'%')
            ->get();
    }
}
