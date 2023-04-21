<?php

namespace App\Repositories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Collection;

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
}
