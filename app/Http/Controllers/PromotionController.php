<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionAssignRequest;
use App\Http\Requests\PromotionGetRequest;
use App\Http\Requests\PromotionPostRequest;
use App\Http\Resources\PromotionResource;
use App\Repositories\PromotionRepository;

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
        $promotions = $this->promotionRepository->allWith(['users','users.wallet']);
        
        // Return response
        return $this->successResponse(PromotionResource::collection($promotions));
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
        // Find a promotion, include relationships
        $promotion = $this->promotionRepository->findWith($id, ['users','users.wallet']);

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
}
