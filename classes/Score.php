<?php 

class Score {
    private int $id;
    private int $value;
    private string $author;

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

    public function setValue (int $value)
    {
        $this->value = $value;
    }

    public function setAuthor (string $author)
    {
        $this->author = $author;
    }

// GETTER
    public function getId() 
    {
        return $this->id;
    }

    public function getValue() 
    {
        return $this->value;
    }

    public function getAuthor() 
    {
        return $this->author;
    }

}