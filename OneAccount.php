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

  		<?php
  				include('dbforchat.php');

  				$results = $mysqli->query("SELECT * FROM chat_record");
  					if($results)
  					{
              if($_COOKIE["isUsernameValidated"] == "true") {
  						{
                if(isset($_GET["usernameSought"]) {
                  for ($i = 0; $i < $results->num_rows; $i++)
                  {
                    $results->data_seek($i);
                    $row = $results->fetch_assoc();
                    if(row["username"] == $_GET["usernameSought"]) {
                      $message = row["message"];
                      $group = row["group"];
                      echo "<p>To $group</p>"
                      echo "<p>Message: $message </p> "
                    }
                  }
                }

  						}
  					}
  					else
  					{
  						echo "Query failed";
  					}
  	?>
</html>
