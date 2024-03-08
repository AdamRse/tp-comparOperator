<?php 
class Destination {
    private int $_id;
    private string $_location;
    private int $_price;

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
        $this->_id = $id;
    }

    public function setLocation (string $location)
    {
        $this->_location = $location;
    }

    public function setPrice (int $price)
    {
        $this->_price = $price;
    }

// GETTER
    public function getId() 
    {
        return $this->_id;
    }

    public function getLocation() 
    {
        return $this->_location;
    }

    public function getPrice() 
    {
        return $this->_price;
    }

}