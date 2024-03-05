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
        $preparedrequest = $this->_db->prepare("SELECT * FROM `destination`");
        $preparedrequest->execute();
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOperator() 
    {
        $preparedrequest = $this->_db->prepare("SELECT * FROM `tour_operator`");
        $preparedrequest->execute();
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

// GETTER BY ID

    public function getOperatorByDestination(int $tour_operator_id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT * FROM `destination` WHERE tour_operator_id = ?");
        $preparedrequest->execute([$tour_operator_id]);
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
}