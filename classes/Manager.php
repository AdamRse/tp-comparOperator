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
        $preparedrequest = $this->_db->query("SELECT d.*, p.name, p.description, p.image, t.name as name_to, t.link, t.logo as logo_to FROM `destination` d LEFT JOIN planet p ON d.planet_id = p.id LEFT JOIN tour_operator t ON d.tour_operator_id = t.id;");
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOperator() 
    {
        $preparedrequest = $this->_db->query("SELECT * FROM `tour_operator`");
        $bddOperators = $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
        $objOperators = [];
        foreach ($bddOperators as $line){
            $to = new TourOperator($line);
            $to->setCertificate($this->getCertificateByTourOperator($line['id']));
            $to->setDestinations($this->getDestinationsByTourOperator($line['id']));
            $to->setReviews($this->getReviewByTourOperator($line['id']));
            $to->setScores($this->getScoreByTourOperator($line['id']));
            $objOperators[] = $to;
        }
        return $objOperators;
    }
    public function getAllPlanets()
    {
        $preparedrequest = $this->_db->query("SELECT * FROM planet;");
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

// GETTER BY ID

    public function getOperatorById($to_id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT * FROM tour_operator WHERE id = ?");
        $preparedrequest->execute([$to_id]);
        $to = new TourOperator($preparedrequest->fetch(PDO::FETCH_ASSOC));
        $to->setCertificate($this->getCertificateByTourOperator($to_id));
        $to->setDestinations($this->getDestinationsByTourOperator($to_id));
        $to->setReviews($this->getReviewByTourOperator($to_id));
        $to->setScores($this->getScoreByTourOperator($to_id));
        return $to;
    }
    public function getOperatorByDestination($destination_Id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT d.price, t.name, t.link FROM `destination` d LEFT JOIN tour_operator t ON d.tour_operator_id = t.id WHERE d.tour_operator_id = ");
        $preparedrequest->execute([$destination_Id]);
        return $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReviewByTourOperator(int $tour_operator_id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT r.id, r.message, a.name as author FROM `review` r LEFT JOIN author a ON r.author_id = a.id WHERE r.tour_operator_id = ?");
        $preparedrequest->execute([$tour_operator_id]);
        $bddReviews = $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
        $objReviews = [];
        foreach ($bddReviews as $review) {
            $objReviews[] = new Review($review);
        }
        return $objReviews;
    }

    public function getScoreByTourOperator(int $tour_operator_id) 
    {
        $preparedrequest = $this->_db->prepare("SELECT s.id, s.value, a.name as author FROM `score` s LEFT JOIN author a ON s.author_id = a.id WHERE s.tour_operator_id = ?");
        $preparedrequest->execute([$tour_operator_id]);
        $bddScores = $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
        $objScores = [];
        foreach ($bddScores as $score) {
            $objScores[] = new Score($score);
        }
        return $objScores;
    }

    public function getCertificateByTourOperator(int $tour_operator_id) 
    {//On ne prend que le dernier
        $preparedrequest = $this->_db->prepare("SELECT * FROM `certificate` WHERE tour_operator_id = ? ORDER BY expiresAt DESC");
        $preparedrequest->execute([$tour_operator_id]);
        return new Certificate($preparedrequest->fetch(PDO::FETCH_ASSOC));
    }
    public function getDestinationsByTourOperator($destination_id)
    {
        $preparedrequest = $this->_db->prepare("SELECT d.id, d.price, p.name as location FROM `destination` d LEFT JOIN planet p ON d.planet_id = p.id WHERE d.tour_operator_id = ?");
        $preparedrequest->execute([$destination_id]);
        $bddDestinations = $preparedrequest->fetchAll(PDO::FETCH_ASSOC);
        $objDestinations = [];
        foreach ($bddDestinations as $destination) {
            $objDestinations[] = new Destination($destination);
        }
        return $objDestinations;
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

    public function createOperator (array $data) // Waiting Keys : name, link, password.
    {
        $data["password"]=password_hash($data['password'], PASSWORD_DEFAULT);
        $data["name"]=ucfirst($data['name']);
        $preparedrequest = $this->_db->prepare("INSERT INTO tour_operator (name, link, password) VALUES (:name, :link, :password)");
        $request = $preparedrequest->execute($data);
        return $request ? $this->_db->lastInsertId() : false; 
    }

    // DELETE 

    public function deleteTourOperator($id)
    {
        $rqDelDestination = $this->_db->prepare("DELETE FROM destination WHERE tour_operator_id = ?");
        $rqDelTo = $this->_db->prepare("DELETE FROM tour_operator WHERE id = ?");

        return $rqDelDestination->execute([$id]) && $rqDelTo->execute([$id]);
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
    public function getAdminConnect($name, $pw)
    {
        $query = $this->_db->prepare("SELECT * FROM admin WHERE name = ?");
        $query->execute([$name]);
        $tourOperator = $query->fetch(PDO::FETCH_ASSOC);
        if(!empty($tourOperator) && !password_verify($pw, $tourOperator['password']))
            $tourOperator = false;
        return $tourOperator;
    }
}