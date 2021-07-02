<?php
class CookieKey {
    private string $cookieKey;

    public function __construct(string $cookieName, string $cookieHost) {
        $this->cookieKey = "cookie:$cookieName:$cookieHost";
    }

    private function isValidName($cookieName) {

    }

    private function isValidHost($cookieName) {

    }


    public function getCookieKey() {
        return $this->cookieKey;
    }

}

