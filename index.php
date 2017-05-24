<?php
/*
    Name: Brent Taylor
    05/18/2017
    URL: http://btaylor.greenrivertech.net/IT328/Blog/
    Blog Assignment IndexPage
    
    This page will manage fat-free routing and functions
*/
    
    //Require autoload
    require_once('vendor/autoload.php');
    //Start session
    session_start();
    
    //Create an instance of the Base class
    $f3 = Base::instance(); 
    
    //Set debug level
    $f3->set('DEBUG', 3);
    
    //Define a default route to the homepage
    $f3->route('GET /', function() {
                $view = new View;
                //Route to blog.html / homepage
                echo $view->render('pages/blog.html');
            }
    );
    
        //Define a route to create an account
    $f3->route('GET /create', function() {
                $view = new View;
                //Route to create.html
                echo $view->render('pages/create.html');
            }
    );
    
        //Define a login route
    $f3->route('GET /login', function() {
                $view = new View;
                //Route to login
                echo $view->render('pages/login.html');
            }
    );
    
    //Define a logout route
        $f3->route('GET /logout', function() {
        $view = new View;
        //Route to logout
        echo $view->render('pages/logout.html');
    }); 
    
         //Get create account data
       $f3->route('POST /create', function() {
        //instantiate our class
          $blogData = new blogData(); //required scope
          
          //Verify password
        if($_POST['password'] == $_POST['verifyPassword'])
        {
            //Check if values posted are valid
            if($_POST['username'] != null && $_POST['password'] != null && $_POST['blogpic'] != null && $_POST['bio'] != null)
            {
            //Create new user with posted information
            $newUser = new Blogger($_POST['username'], $_POST['password'], $_POST['blogpic'], $_POST['bio']);
            //Start the session with the user created
            session_start();
            $_SESSION['username'] = $newUser->getUsername();
            
            //Retrieve the user credidentials.
            $blogData->newBlogger($newUser->getUsername(), $newUser->getPassword(), $newUser->getImage(), $newUser->getBio());
            }
        
         }   else{
            //Incorrect Password
            echo "The passwords you entered do not match";
            
            }
        $view = new View;
        //Post info from create.html
        echo $view->render('pages/create.html');
    });
    
          //Define a route to the about page
    $f3->route('GET /about', function() {
                $view = new View;
                //Route to about page
                echo $view->render('pages/aboutus.html');
            }
    );
    
            //Define a route to create a blog
    $f3->route('GET /makeblog', function() {
                $view = new View;
                //Route to create a blog page
                echo $view->render('pages/makeblog.html');
            }
    );
    
    //Post the blog from makeblog.html
       $f3->route('POST /makeblog', function($f3) {
        
        //Instantiate global 
        $blogData = $GLOBALS['blogData'];
        //Check if the posted variables are valid
        if($_POST['title'] != null && $_POST['text'] != null && $_POST['id'] != null)
        {
            //Instantiate our class
            $blogData = new blogData(); //required scope

            //redirect to homepage
            header('Location: http://btaylor.greenrivertech.net/IT328/blog/');
            //instantiate blog post class
            $blog = new postBlog($_POST['title'], $_POST['text'], $_POST['id']);
            //assign method call to variables
            $blogData->createBlog($blog->getTitle(), $blog->getText(), $blog->getBlogID());
        }
        $view = new View;
        //Route blog submission
        echo $view->render('pages/makeblog.html');
    });
       
       //Define route to view blog entries 
         $f3->route('GET /viewblogs', function($f3)
    {

        //Instantiate global variable
          $blogData= $GLOBALS['blogData'];
          $id = 1; //this is our default id
           
           //If the there is no id, assign one
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
        }
        //Instantiate DB class
        $blogData = new blogData(); //required scope
        
        //Set our id to a variable
        $f3->set('id', $id);
        
        //Create a title
        $newblog = $blogData->blogTitles($id);
        
        //set a text variable forblogs
        $f3->set('newblogs', $newblog);
        $view = new View;
        
        //Retrieve the username
        $username = $blogData->getUsername($id);
        $f3->set('username', $username);
        
        //Retrieve bio
        $bio = $blogData->getBiography($id);
        //set bio to variable
        $f3->set('bio', $bio);
        
        //Echo results
        echo Template::instance()->render('pages/viewblogs.html');
    });
    
      function getBlog($id)
        {
         $select = "SELECT title, text FROM blogs WHERE id = '$id' ORDER BY date DESC";
         $results = $this->_pdo->query($select);
         
         $row = $results->fetch(PDO::FETCH_ASSOC);
         return $row;
        }

    
            //Post login validation
       $f3->route('POST /login', function() {
      
            $blogData = $GLOBALS['blogData'];
            //Check username and password
        if($_POST['username'] != null && $_POST['password'] != null){
            //instantiate our class
               $blogData = new blogData(); //required scope
               //validate the users information
       $login = $blogData->validateUser($_POST['username'], $_POST['password']);
        if($login){
            echo 'Succesfully logged in. Welcome back!';
        }
        
        }
            $view = new View;
            echo $view->render('pages/blog.html');
    });
       
       //Get user information
         $f3->route('GET /myaccount', function($f3) {
        $blogData = $GLOBALS['blogData'];
        $id =1;
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
        }
        //Grab blog by user id
        $newblog = $blogData->blogUser($id);
        $f3->set('newblog', $newblog);
        $view = new View;
        
        //Get the most recent blog
        $latestblog= $blogData->getBlog($id);
        $f3->set('latestblog', $latestblog);
        
        //Get the user 
        $username = $blogData->getUsername($id);
        $f3->set('username', $username);
        
        //Get the biography of the user
        $bio = $blogData->getBiography($id);
        $f3->set('bio', $bio);
        
        //Echo results
        echo Template::instance()->render('pages/myaccount.html');
    });
         
         //get blog info
        $f3->route('GET /blog', function($f3) {
            
            //Instantiate our global
        $blogData = $GLOBALS['blogData'];
    
        $entry = 1; //grab entry by increment number
        
        //Check if the entry is empty
        if(!empty($_GET['entry'])){
            $entry = $_GET['entry'];
        }
        
        //Grab the text and title through our method
        $text = $blogData->getText($entry);
        $f3->set('text', $text);
        $f3->set('title', $entry);
        $view = new View;
        
        //Echo results
        echo Template::instance()->render('pages/blog.html');
    }); 
    
    

    
    
    //Run fat free
    $f3->run();