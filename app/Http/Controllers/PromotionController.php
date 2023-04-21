<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionGetRequest;
use App\Http\Resources\PromotionResource;
use App\Repositories\PromotionRepository;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    /**
     * Promotion repository instance.
     *
     * @var App\Repositories\PromotionRepository
     */

    private PromotionRepository $promotionRepository;

    /**
     * Create a new controller instance.
     */
    public function __construct(PromotionRepository $promotionRepository) {

        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = $this->promotionRepository->getAll();

        return response()->json([
            'success' => true,
            'data' => PromotionResource::collection($promotions)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            'function' => 'store'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show( PromotionGetRequest $request, string $id )
    {
        $promotion = $this->promotionRepository->find($id);

        return response()->json([
            'success' => true,
            'data' => PromotionResource::make($promotion)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
