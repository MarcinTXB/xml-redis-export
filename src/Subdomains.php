<?php
class Subdomains {    
    
    private $subdomains;
    
    public function getSubdomains() {
        return $this->subdomains;
    }    
    
    public function addSubdomain(SubdomainRow $subdomainRow) {
        if($this->subdomains) {
            $subdomainsArray = json_decode($this->subdomains);
            array_push($subdomainsArray, $subdomainRow->getSubdomain());            
            $this->subdomains = json_encode($subdomainsArray);
        }
        else {
            $subdomainToAdd = [$subdomainRow->getSubdomain()];            
            $this->subdomains = json_encode($subdomainToAdd);            
        }
    }

}


