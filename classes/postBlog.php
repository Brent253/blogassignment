
<?php
/*
 *This class is used to create a blog for members of the blog website
 *
 */
   class postBlog
   {
   protected $title; //title of blog
   protected $text; //blog info
   protected $id; //id of user
   
   //Constructor
   function __construct($title, $text, $id){
      $this->title = $title;
      $this->text = $text;
      $this->id = $id;
   }
   
   //Getters
   function getTitle(){
      return $this->title;
   }
   
   function getText(){
      return $this->text;
   }
   
   function getBlogID(){
      return $this->id;
   }
   
   }
