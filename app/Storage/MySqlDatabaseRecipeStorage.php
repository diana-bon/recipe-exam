<?php

namespace App\Storage;

use App\Storage\Contracts\RecipeStorageInterface;
use App\Models\Recipe;
use PDO;
use DateTime;

class MySqlDatabaseRecipeStorage implements RecipeStorageInterface
{
    protected $id;
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function store(Recipe $recipe)
    {
        $insert = $this->pdo->prepare('INSERT INTO recipe (created_at, name, description, preparation, persons) VALUES (:created_at, :name, :description, :preparation, :persons);');
        $insert->execute(array(
            ':created_at' => $recipe->getCreateAt(),
            ':name' => $recipe->getName(),
            ':description' => $recipe->getDescription(),
            ':preparation' => $recipe->getPreparationTime(),
            ':persons' => $recipe->getPersons()
        ));

        return $this->pdo->lastInsertId();
    }

    public function update(Recipe $recipe)
    {
        $update = $this->pdo->prepare('UPDATE recipe SET
			created_at = :created_at,
			name = :name,
			description = :description,
			preparation = :preparation, 
			persons = :persons
			WHERE id = :id;'
        );

        $update->execute(array(
            ':id' => $recipe->getId(),
            ':created_at' => $recipe->getCreatedAt(),
            ':name' => $recipe->getName(),
            ':description' => $recipe->getDescription(),
            ':preparation' => $recipe->getPreparationTime(),
            ':persons' => $recipe->getPersons()
        ));
    }

    public function get($id)
    {
        $query = $this->pdo->query('SELECT * FROM recipes WHERE id = ' . $id);
        $query->setFetchMode(PDO::FETCH_CLASS, Task::class);
        $recipe = $query->fetch();
        return $recipe;
    }

    public function all()
    {
        $query = $this->pdo->query('SELECT * FROM recipes');
        $recipes = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($recipes as $t) {
            $query = $this->pdo->query('SELECT * FROM recipes WHERE id = ' . $t->id);
            $query->setFetchMode(PDO::FETCH_CLASS, Recipe::class);
            $recipes = $query->fetch();
            print_r($recipes);
        }
    }
}