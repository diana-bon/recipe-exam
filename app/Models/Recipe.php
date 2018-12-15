<?php

namespace App\Models;

class Recipe
{
    protected $id;
    protected $created_at;
    protected $name;
    protected $description;
    protected $persons;
    protected $preparation_time;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPersons()
    {
        return $this->persons;
    }
    public function setPersons($persons)
    {
        $this->persons = $persons;
    }

    public function getPreparationTime()
    {
        $datetime = new \DateTime($this->preparation_time);
        return $datetime->format('Y-m-d H:i:s');
    }
    public function setPreparationTime($preparation_time)
    {
        $this->preparation_time = $preparation_time;
    }
}
