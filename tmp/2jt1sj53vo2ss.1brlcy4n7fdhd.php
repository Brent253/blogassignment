<!DOCTYPE html>
    <!---This class will list the blogs posted by the user--->
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name ="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/styles.css">
	<title>View my Blogs</title>
    <!--Check the user id for the session-->
	<?php if ($_SESSION['id'] === $id): ?>
		<?php else: ?><meta http-equiv="refresh" content="2;
		URL='http://btaylor.greenrivertech.net/IT328/blog/viewblogs?id=<?= $_SESSION['id'] ?>'"/><?= $id.PHP_EOL ?>
		
	<?php endif; ?> <!--End check-->
	</head>
    <body>
        <!--Check our session-->
		<?php if (!isset($_SESSION['username'])): ?>
            
        <div class= "container col-sm-1" >
      <ul class="nav nav-stacked">
       <strong>Blog Site</strong><br/>
        <img src="images/th.jpg" id="notepad"><br>
             <a href="http://btaylor.greenrivertech.net/IT328/blog/">Home &#65513;</a><br/>
        <a href="http://btaylor.greenrivertech.net/IT328/blog/create">Become a Blogger &#65513;</a><br/>
        <a href="http://btaylor.greenrivertech.net/IT328/blog/about">About Us &#65513;</a><br/>
        <a href="http://btaylor.greenrivertech.net/IT328/blog/login">Login &#65513;</a><br/>
      </ul>    
        </div>
        <?php else: ?>
		<div class= "container col-sm-1" >
      <ul class="nav nav-stacked">
        Blog Site<br/>
         <img src="images/th.jpg" id="notepad"><br>
        <a href="http://btaylor.greenrivertech.net/IT328/blog/">Home &#65513;</a><br/>
        <a href="http://btaylor.greenrivertech.net/IT328/blog/viewblogs">My Blogs &#65513; </a><br/>
				<a href="http://btaylor.greenrivertech.net/IT328/blog/makeblog">Create Blog &#65513;</a><br/>
        <a href="http://btaylor.greenrivertech.net/IT328/blog/about">About us &#65513;</a><br/>
        <a href="http://btaylor.greenrivertech.net/IT328/blog/logout">Logout &#65513;</a><br/>
      </ul>    
        </div>
		
        <?php endif; ?>
        <div class="col-sm-6 col-lg-6 col-xs-6" 
        <h1>View my Blogs</h1>
        <img src="images/user.jpg" ><br/>
        </div>
        <div class ="row">
			<div class="container col-sm-8">
				<table class ="table">
					<tr><!--Start heading row-->
					<th>Blog Summary</th>
					<th>Update Blog</th>
					<th>Delete Blog<th>
					</tr> <!--End heading row-->
					
					<?php foreach (($myblogs?:[]) as $row): ?>
						
					<?php foreach (($row?:[]) as $blog1=>$value): ?>
						
					<?php foreach (($value?:[]) as $blog2=>$othervalue): ?>
						
					<tr>
					<td><a href ="http://btaylor.greenrivertech.net/IT328/blog/blog?blog=<?= $othervalue ?>"><?= $value2 ?></a></td>
					<td><img src="images/pencil-icon.png"></td>
					
					<td><a href ="http://btaylor.greenrivertech.net/IT328/blog/delete?delete=<?= $othervalue ?>"><img src="images/trash.png"></a></td>
					</tr> <!--End table row-->
					
			  <?php endforeach; ?>
              <?php endforeach; ?>
              <?php endforeach; ?>
				</table><!--End table-->
			</div>
			
			
			<div class="container col-sm-4">
				<?= $username ?><br/>
				
				Quick Biography : <?= $bio.PHP_EOL ?>
			</div>
		</div> <!--End class-->
		