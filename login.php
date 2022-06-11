<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=
	, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<style>
 body{
        background-color: Brown;
        text-align: center;
        background-image:url(https://img.besthqwallpapers.com/Uploads/7-5-2020/132329/blue-abstract-waves-4k-minimal-blue-wavy-background-material-design.jpg);
		align-items: center;
	}
	a{
      
      color:white;
      font-size:50px;
      font-family:arial;
      padding:10px;
	 

    }
	.anot{
        font-family:arial;
        color:white;
        font-size:40px;
        margin-top:170px;

    }
	input{
		margin-top:20px;
		border:solid;
		border-color:white;
		margin-block-end:5px;
		margin-right:10px;
		border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
		font-family:arial;
		font-size: 25px;
	}
	.anote{
		font-family:arial;
        color:white;
		font-size:30px;
		margin-top:250px;
	}
</style>
<body>


<?php

session_start();

if( isset( $_SESSION['login'] ) ){
	echo "Boa noite ".$_SESSION['login']." link para <a href='index.php'>index</a>";
} else {
	if( isset($_POST['login']) ) {
		// codigo do select usuario
		$login = $_POST['login'];
		$senha = $_POST['senha'];


		$conn = pg_connect("host=localhost dbname=luizsilva user=aluno password=3T3K3Q");
		if( !$conn ) {
			die( "Erro de conexão com o banco de dados");
		}
		$senha = md5( $senha );
		$login = pg_escape_literal( $conn, $login );
		$senha = pg_escape_literal( $conn, $senha );
	
		$sql = "SELECT login from usuario where login = $login AND senha = $senha";
		$result=pg_query($conn, $sql);
		$row = pg_fetch_assoc($result);

		if( isset( $row['login'] ) ) {
			echo '<div class="anote">Login com sucesso<br> clicke em OK </div>'."<a href='index.php'>OK</a>";
			$_SESSION['login'] = $row['login'];
			
		} else {
?>

<div class="anot">LOGIN</div>
<form action='login.php' method='post'>
<label class="anote">NOME: </label>
<input type='text' name='login' > <br>
<label class="anote">SENHA:</label>
<input  type='password' name='senha'> <br>
Erro no login ou senha<br>
<input class= "enviar" type='submit' id='OK'>

</form>
<?php 
		}
 
	} else {
?>
<div class="anot">LOGIN</div>
<form action='login.php' method='post'> 
<label class="anote">NOME: </label>
<input class="input"type='text' name='login'><br>
<label class="anote">SENHA:</label>
<input  type='password' name='senha'><br>
<input type='submit' id='OK'>
</form>
<?php 
	}
}



?>
	
</body>
</html>