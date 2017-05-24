<?php

    class Blogger
    {
    
        //Fields
        protected $username; //username
        protected $email; //email
        protected $password; //password
        protected $blogpic;
        protected $bio;
        
        //Constructor (parameterized constructor that holds default values)
        function __construct($username,$password, $blogpic, $bio)
        {
            $this->username = $username;
      //      $this->email = $email;
            $this->password = $password;
            $this->blogpic = $blogpic;
            $this->bio = $bio;
        }
        
    

        function getUsername()
        {
            return $this->username;
        }
        
        function setEmail($email)
        {
            $this->email = $email;
        }

        function getEmail()
        {
            return $this->email;
        }
         
        function getPassword()
        {
            return $this->password;
        }
        
        function setPassword($password)
        {
            $this->password = $password;
        }
        
        function setImage($blogpic)
        {
            $this->blogpic = $blogpic;
        }
        
        function getImage()
        {
            return $this->blogpic;
        }
     
        function setBio($bio)
        {
            $this->bio = $bio;
        }
        
        function getBio()
        {
            return $this->bio;
        }
    }