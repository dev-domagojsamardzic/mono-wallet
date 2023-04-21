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
     * Configure the Model
     * ------------------------------
     * @return Collection
    */

    public function getAll(): Collection
    {
        $promotions = Promotion::all();
        return $promotions;
    }
}
