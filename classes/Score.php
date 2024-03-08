<?php 

class Score {
    private int $_id;
    private int $_value;
    private string $_author;

// CONSTRUCT
    public function __construct (array $data) 
    {
        $this->hydrate($data);
    }

// METHOD 
    public function hydrate(array $data){
        foreach ($data as $key => $_value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (method_exists($this, $method)) {
                $this->$method($_value);
            }
        }
    }


// SETTER 
    public function setId (int $id)
    {
        $this->_id = $id;
    }

    public function setValue (int $value)
    {
        $this->_value = $value;
    }

    public function setAuthor (string $author)
    {
        $this->_author = $author;
    }

// GETTER
    public function getId() 
    {
        return $this->_id;
    }

    public function getValue() 
    {
        return $this->_value;
    }

    public function getAuthor() 
    {
        return $this->_author;
    }

}