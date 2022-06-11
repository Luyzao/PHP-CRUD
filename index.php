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
    table{
        
        border: solid;
        padding: 40px;
        margin-right: 100px;
        border-color: aliceblue;
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
        border-bottom-style: 20px;
        margin-left:650px;
        margin-top:30px;
        
     
     
    }
    .titulo{
        padding: 10px;
        border: solid;
        font-size: 25px;
        background-color: tan;
        border-color: tan;
      

    }
    .anot{
        font-family:arial;
        color:white;
        font-size:40px;
        margin-top:50px;

    }
    a{
      
      color:white;
      font-size:20px;
      font-family:arial;
      padding:10px;

    }
    .perfil{
        color :white;
        font-size:20px;
        font-family:arial;
    }
  
    

    
</style>
<body>
<?php

session_start();

    
    

if(isset($_SESSION['login'])){

    
    echo '<div class="anot">SUAS ANOTAÇÕES</div>';

    echo $_SESSION['login'];
 
    
    echo "<a href='create.php'>Criar<a/>";
    echo "<a href='logout.php'>Deslogar<a/>";
}
else{
    echo "<a href='login.php'> Logar </a>";
}

?>
<table>

<tr>
    <td class="titulo">TITLE</td>
    <td class="titulo">Date</td>

</tr>

<?php

    $conn = pg_connect("host=localhost dbname=luizsilva user=aluno password=3T3K3Q");
    if(!$conn){
        die("ERRO NAO CONEXAO, BANCO DE DADOS NÂO CONECTADO");
    }
    $result=pg_query($conn,"SELECT * FROM publicacao order by data desc");
    while($row = pg_fetch_assoc($result)){
        $date = new DateTime($row['data']);
        echo "<tr>";
            echo "<td><a href='read.php?id=".$row['id']."'>".htmlspecialchars($row['titulo'])."</a></td>";
            echo "<td>".$date->format('d/m/Y'). "</td>";
        echo "</tr>";
    }
        
pg_close($conn);
?>

</table>   
</body>
</html>