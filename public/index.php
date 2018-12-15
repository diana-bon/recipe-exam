<?php

use App\Models\Recipe;
use App\Storage\MySqlDatabaseRecipeStorage;

try {
    $pdo = new PDO('mysql:host=localhost;dbname=recipes', 'root','root');
} catch(PDOException $e) {
    die('ok');
}

$recipe = new Recipe;
$recipe->setCreatedAt(new DateTime());
$recipe->setName('Fondant au chocolat mi-cuit');
$recipe->setDescription('La recette du fameux fondant au chocolat mi-
cuit.');
$recipe->setPersons(4);
$recipe->setPreparationTime(40); // En minutes

// MYSQL
$storage = new MySqlDatabaseRecipeStorage($pdo);
print_r($storage->all());
$manager = new RecipeManager($storage);

// Create a recipe
$recipe->setCreatedAt(new DateTime())
    ->setName('Fondant au chocolat mi-cuit')
    ->setDescription('La recette du fameux fondant au chocolat mi-cuit.')
    ->setPersons(4)
    ->setPreparationTime(40);
$addedRecipe = $manager->addRecipe($recipe);

$recipeId = $storage->store($recipe);
print_r($storage->get($recipeId));

// Update a recipe
$recipe = $storage->get(1);
$recipe->setComplete();
$storage->update($recipe);

// Update (and get)
$recipe = $manager->getRecipe(5);
$recipe->setPreparationTime(60);
$manager->updateRecipe($recipe);

// Recipes
$recipes = $manager->getRecipes();
print_r($recipes);