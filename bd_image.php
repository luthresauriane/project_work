<?php
// $servername='mysql:host=localhost;dbname=bd_project';
// $username="root";
// $password="";
//     $connect = new mysqli($servername, $username, $password);
//     if($connect->connect_error){
//         die ("Connection echouée " . $connect->connect_error);
//     }
include 'bd_to_connection.php';
if(isset($_FILES['image']) && $_FILES['image']['error']==0){
    // recuperons les informations de l'image
    $image = $_FILES['image']['tmp_name'];
    // lecture du contenu
    $data_image = $_POST['image'];
    $data_image = file_get_contents($image);
    // la preparation de la requete
    $stmt = $connect->prepare( "INSERT INTO `project_img`(`data_image`) VALUES (:data)");
    $stmt->bindParam("ssis", $data_image);
    if($stmt->execute()){
        echo "Image sauvegardée";
    }else{
        echo "ERREUR : " . $stmt->error;
    }
    // fermeture
    $stmt->close();
}else{
    echo "Aucun fichier téléchargé"; 
 }
$connect->close();
    ?>
