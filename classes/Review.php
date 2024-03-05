<?php 

class Review {
    private int $_id;
    private string $_message;
    private string $_author;

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

    public function setMessage (string $message)
    {
        $this->_message = $message;
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

    public function getMessage() 
    {
        return $this->_message;
    }

    public function getAuthor() 
    {
        return $this->_author;
    }

}