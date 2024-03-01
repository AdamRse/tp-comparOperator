<?php 

class Destination {
    private int $id;
    private string $location;
    private int $price;

// CONSTRUCT
    public function __construct (array $data) 
    {
        $this->hydrate($data);
    }

// METHOD 
    public function hydrate(array $data){
        foreach ($data as $key => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


// SETTER 
    public function setId (int $id)
    {
        $this->id = $id;
    }

    public function setLocation (string $location)
    {
        $this->location = $location;
    }

    public function setPrice (int $price)
    {
        $this->price = $price;
    }

// GETTER
    public function getId() 
    {
        return $this->id;
    }

    public function getLocation() 
    {
        return $this->location;
    }

    public function getPrice() 
    {
        return $this->price;
    }

}