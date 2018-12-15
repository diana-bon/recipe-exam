<?php

namespace App\Storage\Contracts;

use App\Models\Recipe;

interface RecipeStorageInterface
{
    public function store(Recipe $recipe);
    public function update(Recipe $recipe);
    public function get($id);
    public function all();
}