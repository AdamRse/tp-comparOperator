<?php 

class Author {
    private string $_id;
    private string $_name;
    private $_reviews = [];

// CONSTRUCT
    public function __construct ($data = []) 
    {
        if(!empty($data) && is_array($data))
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
    public function setId ($id)
    {
        $this->_id = $id;
    }
    public function setName ($name)
    {
        $this->_name = $name;
    }
    public function setReviews (array $reviews)
    {
        $this->_reviews = $reviews;
    }

// GETTER
    public function getId() 
    {
        return $this->_id;
    }
    public function getName() 
    {
        return $this->_name;
    }
    public function getReviews() 
    {
        return $this->_reviews;
    }


}