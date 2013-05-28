<?php

final class UserSearchCriteria {

    private $username = null;
    private $password = null;



    public function getUsername() {
        return trim($this->username);
    }

     public function setUsername($username) {
        $this->username = $username;
        return $this;
    }
    
    public function getPassword() {
        return $this->password;
    }

     public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
    
    public function getSha1Password() {
        echo 'password '.$this->password;
        echo 'SHA1 password '.  sha1($this->password);
        return sha1(trim($this->password));
    }
    
    

}

?>
