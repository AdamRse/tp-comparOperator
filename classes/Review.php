<?php 

class Review {
    private int $id;
    private string $message;
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

    public function setMessage (string $message)
    {
        $this->message = $message;
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

    public function getMessage() 
    {
        return $this->message;
    }

    public function getAuthor() 
    {
        return $this->author;
    }

}