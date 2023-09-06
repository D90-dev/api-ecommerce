<?php

namespace App\Http\Controllers;

use App\Http\Resources\Faqs\FaqsCollection;
use App\Services\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct(
        private readonly FaqService $faqService,
    )
    { }

    /**
     * @return FaqsCollection
     */
    public function index(): FaqsCollection
    {
        $faqs = $this->faqService->getFaqs();

        return new FaqsCollection($faqs);
    }

    /**
     * @param Request $request
     * @return FaqsCollection
     */
    public function search(Request $request): FaqsCollection
    {
        $faqs = $this->faqService->getSearchedFaqs($request->input('query'));

        return new FaqsCollection($faqs);
    }
}
