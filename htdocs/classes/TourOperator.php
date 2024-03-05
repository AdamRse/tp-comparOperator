<?php 

class TourOperator {
    private int $id;
    private string $name;
    private string $link;
    private Certificate $certificate; 
    private array $destinations = [];
    private array $reviews = [];
    private array $scores = [];

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

    public function setName (string $name)
    {
        $this->name = $name;
    }

    public function setLink (string $link)
    {
        $this->link = $link;
    }

    public function setCertificate (Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    public function setDestinations (array $destinations)
    {
        $this->destinations = $destinations;
    }

    public function setReviews (array $reviews)
    {
        $this->reviews = $reviews;
    }

    public function setScores (array $scores)
    {
        $this->scores = $scores;
    }

// GETTER
    public function getId() 
    {
        return $this->id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getLink() 
    {
        return $this->link;
    }

    public function getCertificate() 
    {
        return $this->certificate;
    }

    public function getDestinations() 
    {
        return $this->destinations;
    }

    public function getReviews() 
    {
        return $this->reviews;
    }

    public function getScores() 
    {
        return $this->scores;
    }
        

}