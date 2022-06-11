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
      font-size:20px;
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
        margin-top:170px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
    }  

</style>
<body>
    
<table>

<?php

session_start();

    echo "<a href='index.php'>Inicio</a>";

if(isset($_SESSION['login'])){
   
    
}
else{
    echo "<a href='login.php'>Logar</a>";
}

?>

<?php

    $conn = pg_connect("host=localhost dbname=luizsilva user=aluno password=3T3K3Q");
if(!$conn){
    die("ERRO SEM CONEXAO!");
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
else{
    echo "<tr>";
    echo "<td>ESTE ARTIGO NÂO EXISTE VOLTE PARA O INICIO: <a href='index.php></a></td>";
    echo "</tr>";
    die();
}
    $id_select = pg_escape_literal($conn, $id);
    $result = pg_query($conn, "SELECT * FROM publicacao where id=$id_select");
    $row = pg_fetch_assoc($result);
if($row){
    $date = new DateTime( $row['data']  );
	echo "<tr>";
	echo "<td><h1>".$row['titulo']."</h1>";
	echo "</td>";
	echo "</tr>";
}	
if( $result ){
         echo "<tr><td><a href='update.php?id=$id'>Editar</a> <a href='delete.php?id=$id'>Delete</a> </td></tr>";

	echo "<tr>";
 	echo "<td>".$row['conteudo']. "</td>";
	echo "</tr>";
} else {
	echo "<tr>";
 	echo "<td>Artigo não existe volte para o <a href='idenx.php'>index<a/></td>";
	echo "</tr>";
}


pg_close($conn);



?>

</table>
</body>
</html>