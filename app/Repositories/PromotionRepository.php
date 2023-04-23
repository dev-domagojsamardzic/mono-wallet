<?php

namespace App\Repositories;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
}
