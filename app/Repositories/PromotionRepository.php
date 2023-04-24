<?php

namespace App\Repositories;

use App\Exceptions\Promotions\PromotionAlreadyAssignedException;
use App\Exceptions\Promotions\PromotionNotValidException;
use App\Exceptions\Promotions\PromotionQuotaExceededException;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

class PromotionRepository extends ModelRepository
{
    /**
     * Configure the Model
     * ------------------------------
     * @return string
    */

    public function setModelName():string
    {
        return Promotion::class;
    }

    /**
     * Get Model collection (all)
     * ------------------------------
     * @return Collection
    */

    public function getAll(): Collection
    {
        $promotions = Promotion::all();
        return $promotions;
    }

    /**
     * Get Model (single)
     * ------------------------------
     * @param string $id
     *
     * @return Promotion
    */

    public function find(string $id): Promotion
    {
        $promotions = Promotion::find($id);
        return $promotions;
    }

    /**
     * Create new Promotion
     * ------------------------------
     * @param Illuminate\Http\Request $request
     * @return App\Models\Promotion
     *
     * @return Promotion
    */

    public function store(Request $request): Promotion
    {
        // Set request params as array
        $input = $request->all();
        // Create Promotion
        return Promotion::create($input);
    }

    /**
     * Assign a promotion to a user
     * ------------------------------
     * @param Illuminate\Http\Request $request
     * @return bool
     *
     * @throws Exception
    */

    public function assignToUser(Request $request): bool
    {
        // retrieve token
        $token = PersonalAccessToken::findToken($request->bearerToken());
        // Retrieve user
        $user = $token->tokenable;

        // Retrieve a promotion
        $promotion = Promotion::where('code', $request->code)->first();

        // Check if promotion is still valid
        if( $promotion->start_date->gt( now() ) || $promotion->end_date->lt( now() ))
        {
            throw new PromotionNotValidException;
        }

        // Check if promotion quota is exceeded
        if( $promotion->users->count() === $promotion->quota )
        {
            throw new PromotionQuotaExceededException;
        }

        // Check if the user has already used the promotion
        if ($promotion->users()->where('user_id', $user->id)->exists())
        {
            throw new PromotionAlreadyAssignedException;
        }

        // Attach user to promotion
        $promotion->users()->attach($user);

        // Increase user's wallet balance
        $user->wallet->increaseBalance($promotion->amount);

        return true;
    }
}
