<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
</head>

<style>
	 body{
        background-color: Brown;
        text-align: center;
        background-image:url(https://img.besthqwallpapers.com/Uploads/7-5-2020/132329/blue-abstract-waves-4k-minimal-blue-wavy-background-material-design.jpg);
    }
	a{
      
      color:white;
      font-size:20px;
      font-family:arial;
      padding:10px;
	  
	 

    }
	input{
		margin-top:20px;
		border:solid;
		border-color:white;
		margin-block-end:5px;
		border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
		font-family:arial;
		font-size: 20px;
	}
	.input2{
		margin-top:200px;
		border:solid;
		border-color:white;
		margin-block-end:5px;
		margin-right:65px;
		border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
		font-family:arial;
	
		
	}
	textarea{
		border:solid;
		border-color:white;
		border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
		font-family:arial;
		font-size: 25px;
	}
	.anote{
		font-family:arial;
        color:white;
		font-size:25px;
		margin-top:250px;
	}

</style>

<body>

<?php

session_start();


echo "<a href='index.php'>Incio</a> ";


if( isset( $_SESSION['login'] ) ) {


	
} else {
	echo "<a href='login.php'>LOGIN</a> ";
	die();
}


if( isset($_POST['titulo']) ){
	
	$titulo   = $_POST['titulo'];
	$conteudo = $_POST['conteudo'];
	if( $titulo != '' && $conteudo != '' ){
		$conn = pg_connect("host=localhost dbname=luizsilva user=aluno password=3T3K3Q");
		if( !$conn ) {
			die( "Erro de conexão com o banco de dados");
		}
		$titulo   = pg_escape_literal( $conn, $titulo );
		$conteudo = pg_escape_literal( $conn, $conteudo );
		$sql = "INSERT INTO publicacao ( titulo, conteudo ) values ( $titulo, $conteudo )";
		$result=pg_query($conn, $sql);
		if( pg_affected_rows( $result ) == 1 ) {
			echo "Dado inserido com sucesso, volte para <a href='index.php'>INDEX</a>";
		} else {
			echo "Erro ao inserir dado no banco de dados, reporte ao administrador";
		}

	} else {
?>
<form action='create.php' method='post'>
<label class="anote">TITULO: </label>
<input class="input2" type='text' name='titulo' value="<?=$titulo?>"><br>
<label class="anote">COMENTARIO: </label>
<br><textarea name='conteudo'>
<?=$conteudo?>
</textarea>
<br>
Tem que preencher todos os daodos<br>
<input type='submit' id='OK'>
</form>
<?php
	

	}


} else {

?>
<form action='create.php' method='post'>
<label class="anote">TITULO: </label>
<input class ="input2"type='text' name='titulo'><br>
<label class="anote">COMENTARIO: </label>
<br><textarea name='conteudo'>
</textarea>
<br>
<input type='submit' id='OK'>
</form>
<?php

}



?>
</body>
</html>