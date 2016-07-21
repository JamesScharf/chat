<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Chat</title>
	<style>
		#messageArea {
		border-radius: 25px;
		background: #8AC007;
		padding: 20px;
		width: 450px;
		height: 500px;
		}
	</style>


    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript"
    src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
	 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="messageArea">
      <form action="index.php" method="post">
  		<input type="text" name='usernameBox' placeholder="Username">
  		<input type="password" name='Password' placeholder="Password">
  		<button type="Submit">Login</button>
       </form>
  	<iframe id="chatiframe" src="chatiframe.php" width="400" height="400"></iframe>
  	<form action="index.php" method="post">
  		<input type="text" name='messageBox' placeholder="Enter your message">
  		<button type="Submit">Send</button> </br></br>
  	</form>

  		<?php
  				include('dbforchat.php');

  				$results = $mysqli->query("SELECT * FROM usernames_passwords");
  					if($results)
  					{
  						if(isset($_POST['usernameBox']) AND isset($_POST['Password']))
  						{
  							for ($i = 0; $i < $results->num_rows; $i++)
  							{
  								$results->data_seek($i);
  								$row = $results->fetch_assoc();
  								if(($row['username'] == $_POST['usernameBox']) AND ($row['password'] == $_POST['Password']))
  								{
  									$success = true;
  									$username = $row['username'];
                    setcookie('usernameCookie', $username, time()+60*60*24*30);
  									setcookie('isUsernameValidated', "true", time()+60*60*24*15);
  								}
  								else{
  									echo "<script>alert('Incorrect username/password');</script>";
  									$success = false;
                    setcookie('usernameCookie', null, time()+60*60*24*30);
  									setcookie('isUsernameValidated', false, time()+60*60*24*15);
  								}
  							}
  							if(!$success)
  							{
  								echo 'Incorrect username or password.';
  							}
  						}
  					}
  					else
  					{
  						echo "Query failed";
  					}

  		if(isset($_POST['messageBox']))
  		{
  			$usernameCookie = $_COOKIE['usernameCookie'];
  			$isUsernameValidatedCookie = $_COOKIE['isUsernameValidated'];
  			if($isUsernameValidatedCookie == "true")
  			{
  				$message = $_POST['messageBox'];
  				$results = $mysqli->query("INSERT INTO chat_record(username, message) VALUES('$usernameCookie', '$message')");
          $results = $mysqli->query("SELECT * FROM chat ORDER BY counter DESC");
          header('refresh: 0');
  			}
  		}


  	?>
  </div>

  <script>
  var d = $('#chatiframe');
  d.scrollTop(d.prop("scrollHeight"));</script>

  </body>
</html>
