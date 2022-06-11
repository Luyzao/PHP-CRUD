<!DOCTYPE html>

<html>

    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="index.css">
    </head>

    <body>
        
        <?php
            session_start();
            
            if (isset($_SESSION['login'])) {
   
                if(isset($_GET['logout'])){

                    unset($_SESSION['login']);
                    header('location:index.php');
                }
                else{ 
                    $conn = pg_connect("host=localhost dbname=luizsilva user=aluno password=3T3K3Q");

                    $id = $_GET['id'];
     
                    $sql = pg_query($conn,"DELETE from publicacao WHERE id= $id");
        
                    pg_close($conn);
                    header('location:index.php');
                }
            }
            else{
                header('location:login.php');
            }
        ?>

    </body>
</html>