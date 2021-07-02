<?php
class SubdomainRow {    
    
    private string $subdomain;
        
    
    public function __construct($subdomain) {

        if ($this->ensureIsValidSubdomain($subdomain)) {
            $this->subdomain = $subdomain;
        }

    }

    private function ensureIsValidSubdomain($subdomain) {
        
        return (filter_var($subdomain, FILTER_VALIDATE_URL)) ? true : false;

    }
    
    public function getSubdomain() {

        return $this->subdomain;

    }

}

