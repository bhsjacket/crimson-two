<?php
class Animal {
    protected $name;
    protected $age;
    protected $breed;
    protected $favoriteFood;
    protected $id;
    static $totalAnimals = 0;
    protected const dataTypes = ['name', 'age', 'species', 'favoriteFood', 'id', 'totalAnimals'];

    function __construct(string $name, int $age, string $breed, string $favoriteFood) {
        $this->name = $name;
        $this->age = $age;
        $this->breed = $breed;
        $this->favoriteFood = $favoriteFood;
        $this->id = uniqid();
        $this::$totalAnimals++;
    }

    function setData($name, $value) {
        if( in_array($name, $this::dataTypes) ) {
            $tempValue = $this->$name;
            $this->$name = $value;
            return $tempValue . ' --> ' . $value;
            unset($tempValue);
        } else {
            return false;
        }
    }

    function getData($name) {
        if( in_array($name, $this::dataTypes) ) {
            return $this->$name;
        } else {
            return false;
        }
    }

    function increaseAge(int $years = 1) {
        $this->age += $years;
        return $this->age;
    }
}

class Dog extends Animal {
    function dogYears() {
        return $this->age * 7;
    }
}

$cow = new Animal('Betty', 2, 'angus', 'grass');
$dog = new Dog('Spot', 3, 'retriever', 'carrots');