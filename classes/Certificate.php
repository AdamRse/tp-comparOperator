<?php 

class Certificate {
    private string $_expiresAt;
    private string $_signatory;

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
    public function setExpiresAt (string $expiresAt)
    {
        $this->_expiresAt = $expiresAt;
    }

    public function setSignatory (string $signatory)
    {
        $this->_signatory = $signatory;
    }

// GETTER
    public function getExpiresAt() 
    {
        return $this->_expiresAt;
    }

    public function getSignatory() 
    {
        return $this->_signatory;
    }


}