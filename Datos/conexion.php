<?php
$db_usuario='root';
$db_contra='Iamhigher16';
try{
    $conexion=new PDO('mysql:host=localhost;dbname=libreriadb',$db_usuario,$db_contra);
    /*echo"Conexion Exitosa";*/
}catch(Exception $error){
    echo ("Error: ".$error->GetMessage()."<br>");
}
?>