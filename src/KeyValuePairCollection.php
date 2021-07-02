<?php
class KeyValuePairCollection {
    
    private $keyValuePairCollection = [];

    public function addKeyValuePair(KeyValuePair $keyValuePair) {
        array_push($this->keyValuePairCollection, $keyValuePair);
    }

    public function getKeyValuePairCollection() {
        return $this->keyValuePairCollection;
    }

}


