<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionAssignRequest;
use App\Http\Requests\PromotionGetRequest;
use App\Http\Requests\PromotionPostRequest;
use App\Http\Resources\PromotionResource;
use App\Repositories\PromotionRepository;
use Illuminate\Http\JsonResponse;
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
        // Get all promotions
        $promotions = $this->promotionRepository->getAll();

        // Return response
        return $this->successResponse(PromotionResource::collection($promotions));
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
        // Create/store new promotion
        $newPromotion = $this->promotionRepository->store($request);

        // Return response
        return $this->successResponse(PromotionResource::make($newPromotion));
    }

    /**
     * Display the specified resource.
     */
    public function show(PromotionGetRequest $request, string $id)
    {
        // Find a promotion
        $promotion = $this->promotionRepository->find($id);

        // Return response
        return $this->successResponse(PromotionResource::make($promotion));
    }

    /**
     * Assign the specified promotion.
     */
    public function assign(PromotionAssignRequest $request)
    {
        try {
            // Assign promotion to a user
            $this->promotionRepository->assignToUser($request);

            // Return response
            return $this->successResponse(null, 200);
        }
        catch (\Exception $e) {

            // Return error
            return $this->errorResponse($e->getMessage(), 422);
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
