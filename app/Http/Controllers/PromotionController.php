<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionAssignRequest;
use App\Http\Requests\PromotionGetRequest;
use App\Http\Requests\PromotionPostRequest;
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
    public function store(PromotionPostRequest $request)
    {
        // Create new promotion
        $newPromotion = $this->promotionRepository->store($request);

        // return result
        return response()->json([
            'success' => 'true',
            'data' => PromotionResource::make($newPromotion)
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
     * Assign the specified promotion.
     */
    public function assign(PromotionAssignRequest $request)
    {
        try {

            $success = $this->promotionRepository->assignToUser($request);

            return response()->json([
                'success' => $success
            ]);
        }
        catch (\Exception $e) {

            return response()->json([
                'success' => 'false',
                'message' => $e->getMessage()
            ]);
        }


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
