<?php
class KeyValuePair {

    private $key;
    private $value;

    public function __construct(string $key, string $value) {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey() {
        return $this->key;
    }


    public function getValue() {
        return $this->value;        
    }

}

