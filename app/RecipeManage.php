<?php

namespace App\Storage;

use App\Storage\Contracts\RecipeStorageInterface;
use App\Models\Recipe;

class RecipeManager
{
    protected $client;

    public function __construct($storage)
    {
        $this->client = $storage;
    }

    public function addRecipe($recipe)
    {
        return $this->client->store($recipe);
    }

    public function getRecipe($recipe)
    {
        return $this->client->get($recipe);
    }

    public function updateRecipe($recipe)
    {
        return $this->client->update($recipe);
    }

    public function getRecipes()
    {
        return $this->client->all();
    }
}