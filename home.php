<?php 
	session_start();
	include 'dbh.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel= "stylesheet" type="text/css" href="new.css">
</head>
<body>
	<div id= "main">
		<h1 style="background-color: #6495ed; color: white;"><?php  echo $_SESSION['name'] ?>-online</h1>
		<div class = "output">
				<?php $sql = "SELECT * FROM message ";
				$result = $conn->query($sql);
				if($result->num_rows >0){
					while($row = $result ->fetch_assoc()){
					
						echo "<strong>".$row["name"]. "</strong> "." :: ".$row["msg"]. " :". "<strong> ".$row["type_of"]. "</strong> "." -- ".$row["date"]. "<br>";
						echo "<br>";
					}
				}else{
					echo "0 results";
				}
				$conn->close();
				?>
		</div>
		
		<form action = "send.php" method = "post">
			<textarea name="msg" placeholder="Type to send message" class="form-control"></textarea><br>
			<input type="submit" value ="Send">
			<label>Choose: </label>
			<input list = "browsers" name="choice">
			<datalist id="browsers">
			<option value = "atbash">
			<option value = "albam">
			</datalist>
			<br>
			<br>
		</form>
		<br>

		<form method = "GET">
		<textarea name="sentence" placeholder="Paste the message here" class="form-control"></textarea><br>
		<input type ="submit" name= "submit" value ="Decrypt">
		<label>Choose: </label>
			<input list = "browsers" name="choice">
			<datalist id="browsers">
			<option value = "atbash">
			<option value = "albam">
			</datalist>
			<br>
			<br>
	</form>
	<?php
		if(isset($_GET['submit'])){
			$name=$_GET['sentence'];
			$choice = $_GET['choice'];
			$sentencearr = str_split($name);
			$answer = str_split($name);
			$choicearray=array ("");
			$choicealbam=array("");
			$alpha = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
			$alphaup = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$atbash = array('z','y','x','w','v','u','t','s','r','q','p','o','n','m','l','k','j','i','h','g','f','e','d','c','b','a');
			$atbashup= array('Z','Y','X','W','V','U','T','S','R','Q','P','O','N','M','L','K','J','I','H','G','F','E','D','C','B','A');
			$albam = array('m','l','k','j','i','h','g','f','e','d','c','b','a','z','y','x','w','v','u','t','s','r','q','p','o','n');
			$albamup = array('M','L','K','J','I','H','G','F','E','D','C','B','A','Z','Y','X','W','V','U','T','S','R','Q','P','O','N');
			$ai= 0;
			$bul="";
			$sum="";
			$insert_arry=implode($answer);
			$exam="";
			if($choice =="atbash"){
				$choicearray = $atbash;
				$choicearrayup = $atbashup;
				$bul="true";
			}else if($choice =="albam"){
				
				$choicealbam = $albam;
				$choicearrayup = $albamup;
				$sum = "true";
			}
			if($bul == "true"){
				while ($ai < count($sentencearr)){
					for($i = 0; $i<count($alpha); $i++){
						if($sentencearr[$ai] == $alpha[$i]){
							$answer[$ai] = $choicearray[$i];
							$ia = count($alpha) + 1;
						}else if($sentencearr[$ai] == $alphaup[$i]){
							$answer[$ai] = $choicearrayup[$i];
							$ia = count($alpha)+1;
						}
					}
					$insert_arry[$ai] = $answer[$ai];
					$ai++;
				}
				echo "<textarea> $insert_arry </textarea";
			}else if($sum == "true"){
				while ($ai < count($sentencearr)){
					for($i = 0; $i<count($alpha); $i++){
						if($sentencearr[$ai] == $alpha[$i]){
							$answer[$ai] = $choicealbam[$i];
							$ia = count($alpha) + 1;
						}else if($sentencearr[$ai] == $alphaup[$i]){
							$answer[$ai] = $choicearrayup[$i];
							$ia = count($alpha)+1;
						}
					}
					$insert_arry[$ai] = $answer[$ai];
					$ai++;
				}
				echo "<textarea> $insert_arry </textarea";
			}
		}
		?>
		<form action="logout.php">
			<br>
			<input style="width: 100%; background-color: #6495ed; color: white; font-size: 20px" type ="submit" value="Logout">
		</form>

	</div>	
</html>