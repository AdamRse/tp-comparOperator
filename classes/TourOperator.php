<?php 

class TourOperator {
    private int $_id;
    private string $_name;
    private string $_link;
    private Certificate $_certificate; 
    private array $_destinations = [];
    private array $_reviews = [];
    private array $_scores = [];

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

    public function setName (string $name)
    {
        $this->_name = $name;
    }

    public function setLink (string $link)
    {
        $this->_link = $link;
    }

    public function setCertificate (Certificate $certificate)
    {
        $this->_certificate = $certificate;
    }

    public function setDestinations (array $destinations)
    {
        $this->_destinations = $destinations;
    }

    public function setReviews (array $reviews)
    {
        $this->_reviews = $reviews;
    }

    public function setScores (array $scores)
    {
        $this->_scores = $scores;
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

    public function getLink() 
    {
        return $this->_link;
    }

    public function getCertificate() 
    {
        return $this->_certificate;
    }

    public function getDestinations() 
    {
        return $this->_destinations;
    }

    public function getReviews() 
    {
        return $this->_reviews;
    }

    public function getScores() 
    {
        return $this->_scores;
    }
        

}