<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<style>

body{
        background-color: Brown;
        text-align: center;
        background-image:url(https://img.besthqwallpapers.com/Uploads/7-5-2020/132329/blue-abstract-waves-4k-minimal-blue-wavy-background-material-design.jpg);
    }
a{
      
      color:white;
      font-size:30px;
      font-family:arial;
      padding:10px;
      margin-block-end: 20px;

    }
    table{
        
        border: solid;
        padding: 30px;
        margin-right: 100px;
        border-color: aliceblue;
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
        border-bottom-style: 20px;
        margin-left:680px;
        margin-top:190px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
    }  
	.anot{
        font-family:arial;
        color:white;
        font-size:40px;
        margin-top:50px;
		margin-block-end: 50px;
		margin-block-end: 50px

    }
	input{
		margin-top:20px;
		border:solid;
		border-color:white;
		margin-block-end:5px;
		border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
		font-family:arial;
		font-size: 25px;
	}
	textarea{
		border:solid;
		border-color:white;
		border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
		font-family:arial;
		font-size: 25px;
	}
</style>
<body>
	
<?php

session_start();


echo "<a href='index.php'>Inicio</a> ";
echo '<div class="anot">EDITANDO</div>';

if( isset( $_SESSION['login'] ) ) {
	
} else {
	echo "<a href='login.php'>LOGIN</a> ";
	die();
}


if( isset($_POST['id']) ){

	$id       = $_POST['id'];	
	$titulo   = $_POST['titulo'];
	$conteudo = $_POST['conteudo'];
	if( $titulo != '' && $conteudo != '' ){
		$conn = pg_connect("host=localhost dbname=luizsilva user=aluno password=3T3K3Q");
		if( !$conn ) {
			die( "Erro de conexão com o banco de dados");
		}
		$id       = pg_escape_literal( $conn, $id );
		$titulo   = pg_escape_literal( $conn, $titulo );
		$conteudo = pg_escape_literal( $conn, $conteudo );
		$sql = "UPDATE publicacao SET titulo=$titulo, conteudo=$conteudo, data=now() WHERE id=$id ";
		$result=pg_query($conn, $sql);
		if( pg_affected_rows( $result ) == 1 ) {
			echo '<div class="anot">Arquivo editado, volte para o inicio:<br></div>'."<a href='index.php'>Inicio</a>";
			
		} else {
			echo "Erro ao atualizar dado no banco de dados, reporte ao administrador";
		}

	} else {
		if( isset($_GET['id']) || isset($_POST['id']) ){
			if( isset($_GET['id'] ) ) $id= $_GET['id'] ;
			if( isset($_POST['id'] ) ) $id= $_POST['id'] ;

			$titulo   = $_POST['titulo'];
			$conteudo = $_POST['conteudo'];
?>
<form action='update.php' method='post'>
<input type='hidden' name=id value='<?=$id?>'>
TITULO:<br><input type='text' name='titulo' value="<?=$titulo?>"><br>
COMENTARIO:<br><textarea name='conteudo'>
<?=$conteudo?>
</textarea>
<br>
Tem que preencher todos os daodos<br>
<input type='submit' id='OK'>
</form>
<?php
		} else {
			echo "Volte para o <a href='index.php'>Inicio</a>";
			die();
		}
	

	}


} else {

		if( isset($_GET['id']) ){

			$conn = pg_connect("host=localhost dbname=luizsilva user=aluno password=3T3K3Q");
			if( !$conn ) {
				die( "Erro de conexão com o banco de dados");
			}
			$id=$_GET['id'];
			$id_select = pg_escape_literal( $conn, $id );

			$result=pg_query($conn, "SELECT * FROM publicacao where id=$id_select");

			$row = pg_fetch_assoc($result);
			if ($row) {

?>
<form action='update.php' method='post'>
<input type='hidden' name=id value='<?=$row['id']?>'>
TITULO:<br><input type='text' name='titulo' value='<?=$row['titulo']?>'><br>
COMENTARIO:<br><textarea name='conteudo'>
<?=$row['conteudo']?>
</textarea>
<br>
<input type='submit' id='OK'>
</form>
<?php



			} else {
 				echo "<td>Artigo não existe volte para o <a href='idenx.php'>Inicio<a/></td>";
			}



		} else {
			echo "Volte para o <a href='index.php'>Inicio</a>";
			die();
		}



}



?>


</body>
</html>
