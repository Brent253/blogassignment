<?php
/*CREATE TABLE blogging
(
    
    id int PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
    blogpic VARCHAR(50) NOT NULL,
    UNIQUE (`id`)  
);
    
    
CREATE TABLE blogs 
( id int PRIMARY KEY AUTO_INCREMENT, 
 title VARCHAR(80) NOT NULL , 
 text VARCHAR(1000) NOT NULL 
 );

 */

 
    //Class Defined
    class blogData
    {
    
    //Fields
    private $_pdo; //Creates a new PDO to establish a DB connection/

      
      //Constructor
         function __construct()
        {
          require_once'/home/btaylor/blogConfig.php';
          try{
            //Set up Database credidentials.
             $this->_pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
             
             $this->_pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
             
             $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
         
         catch(PDOException $e)
            {
             die("Error connecting to DB ". $e->getMessage());
            } 
         
        }
        
            //Grab user for blog table
        function getUsername($id)
        {
            $query = "SELECT username FROM blogging WHERE id = '$id'";
            $results = $this->_pdo->query($query);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['username'];
        }
        
        //Grab bio for blog table

         function getBiography($id)
        {
            $query = "SELECT bio FROM blogging WHERE id = '$id'";
            $results = $this->_pdo->query($query);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['bio'];  
        }
        
         //grab text for summary
        function getText($title)
        {
            $query = "SELECT text FROM blogs WHERE title = '$title'";
            $results = $this->_pdo->query($query);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['text'];  
        }
        
        //validate the login
        function validateUser($username, $password)
        {
            //Start a query
            $query = "SELECT id, username, password FROM blogging
            WHERE username ='$username' AND password ='$password' ";
            //fetch our array
            $results = $this->_pdo->query($query);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            
            //if found in db, start a session
           if($row['username'] == $username && $password == $row['password'])
           {
            session_start();
            
            $_SESSION['username'] = $username;
            
            $_SESSION['id'] = $row['id'];
            
            //User has successfully logged in
            return true;
           }
           
           else
           {
            //User could not log in.
            return false;
           }      
        }
        
        //Create a blog entry
        function createBlog($title, $text, $id)
        {
           $insert = 'INSERT INTO blogs (title, text, id)
           VALUES(:title, :text, :id)';
           
           //Prepare our statement
           $statement = $this->_pdo->prepare($insert);
           
           //Bind values
           $statement->bindValue(':title', $title, PDO::PARAM_STR);
           $statement->bindValue(':text', $text, PDO::PARAM_STR);
           $statement->bindValue(':id', $id, PDO::PARAM_INT);
           
           //Execute query
           $statement->execute();
        }
        
        //Creates new account function
        function newBlogger($username, $password, $blogpic, $bio)
        {
           $insert = 'INSERT INTO blogging (username, password, blogpic, bio)
           VALUES(:username, :password, :blogpic, :bio)';
           
           //Prepare our statement
           $statement = $this->_pdo->prepare($insert);
           //Bind values..
           $statement->bindValue(':username', $username, PDO::PARAM_STR);
           $statement->bindValue(':password', $password, PDO::PARAM_STR);
           $statement->bindValue(':blogpic', $blogpic, PDO::PARAM_STR);
           $statement->bindValue(':bio', $bio, PDO::PARAM_STR);
           
           //Execute query.
           $statement->execute();
        }
        
         function blogTitles($id)
        {
         $query = "SELECT title FROM blogs WHERE id = '$id'";
         
         $newresult = $this->_pdo->query($query);
         
         while($row = $newresult->fetchAll(PDO::FETCH_ASSOC)){
            $newresultArray[$row['id']] = $row;
          }
         return $newresultArray;
        }
        
        function blogUser($id)
        {
            //Query
         $query = "SELECT id, title, text FROM blogs WHERE id = '$id'";
         
         //Assign query to pdo connection
         $result = $this->_pdo->query($query);
         
         //fetch all rows
         while($getrow = $result->fetchAll(PDO::FETCH_ASSOC)){
            $newresultArray[$getrow['id']] = $getrow;
          }
         return $newresultArray;
        }
        
    }