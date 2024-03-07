<?php

class Manager {
    private PDO $_db;

// CONSTRUCT
    public function __construct(PDO $id)
    {
        $this->_db = $id;
    }

// GETTER ALL
    public function getAllDestination() 
    {
        $preparedrequest = $this->_db->query("SELECT d.*, p.name, p.description, p.image FROM `destination` d LEFT JOIN planet p ON d.planet_id = p.id;");
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOperator() 
    {
        $preparedrequest = $this->_db->query("SELECT * FROM `tour_operator`");
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllPlanets()
    {
        $preparedrequest = $this->_db->query("SELECT * FROM planet;");
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

// GETTER BY ID

    public function getOperatorByDestination($destination_Id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT d.price, t.name, t.link FROM `destination` d LEFT JOIN tour_operator t ON d.tour_operator_id = t.id WHERE d.tour_operator_id = ");
        $preparedrequest->execute([$destination_Id]);
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReviewByTourOperator(int $tour_operator_id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT * FROM `review` WHERE tour_operator_id = ?");
        $preparedrequest->execute([$tour_operator_id]);
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getScoreByTourOperator(int $tour_operator_id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT * FROM `score` WHERE tour_operator_id = ?");
        $preparedrequest->execute([$tour_operator_id]);
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCertificateByTourOperator(int $tour_operator_id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT * FROM `certificate` WHERE tour_operator_id = ?");
        $preparedrequest->execute([$tour_operator_id]);
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

// CREATE 

    public function createReview (array $data) // Waiting Keys : message, tour_operator_id, author_id.
    {
        $preparedrequest = $this->_db->prepare("INSERT INTO review (message, tour_operator_id, author_id) VALUES (:message,:tour_operator_id,:author_id)");
        $request = $preparedrequest->execute($data);
            if ($request) {
                return $this->_db->lastInsertId();
            } else 
                return false;        
    }

    public function createScore (array $data) // Waiting Keys : value, tour_operator_id, author_id.
    {
        $preparedrequest = $this->_db->prepare("INSERT INTO review (value, tour_operator_id, author_id) VALUES (:value,:tour_operator_id,:author_id)");
        $request = $preparedrequest->execute($data);
            if ($request) {
                return $this->_db->lastInsertId();
            } else 
                return false; 
    }

    public function createOperator (array $data) // Waiting Keys : name, link.
    {
        $preparedrequest = $this->_db->prepare("INSERT INTO review (name, link) VALUES (:name,:link)");
        $request = $preparedrequest->execute($data);
            if ($request) {
                return $this->_db->lastInsertId();
            } else 
                return false; 
    }

    // USERS
    public function getAuthorConnect($name, $pw)
    {
        $query = $this->_db->prepare("SELECT * FROM author WHERE name = ?");
        $query->execute([$name]);
        $author = $query->fetch(PDO::FETCH_ASSOC);
        if(!empty($author) && !password_verify($pw, $author['password']))
            $author = false;
        return $author;

    }
    public function getTourOperatorConnect($name, $pw)
    {
        $query = $this->_db->prepare("SELECT * FROM tour_operator WHERE name = ?");
        $query->execute([$name]);
        $tourOperator = $query->fetch(PDO::FETCH_ASSOC);
        if(!empty($tourOperator) && !password_verify($pw, $tourOperator['password']))
            $tourOperator = false;
        return $tourOperator;
    }
}