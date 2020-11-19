<?php
	
	session_start(); 
	include 'dbh.php';
	$msg= $_POST['msg'];
	$name= $_SESSION['name'];
			$choice = $_POST['choice'];
			$sentencearr = str_split($msg);
			$answer = str_split($msg);
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
				$sql = "insert into posts(msg) values ('$insert_arry')";
				$result=$conn->query($sql);
				header("Location:home.php");
				
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
				$sql = "insert into posts(msg) values ('$insert_arry')";
				$result=$conn->query($sql);
				header("Location:home.php");
			}
			
			

?>