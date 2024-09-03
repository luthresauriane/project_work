<?php
include 'bd_to_connection.php';
if(isset($_POST['Souscription'])){
    $email = $_POST['email'];
    $pass = $_POST['mdp'];
    $request = "INSERT INTO `project`(`email`, `pass`) VALUES (:email, :mdp)";
    $stmt = $connect->prepare($request);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mdp', $pass);
    try{
        $stmt->execute();
        echo "";
        header('location: boutton.html');
        exit();
    }catch(PDOException $pde){
        echo "ERREUR : " . $pde ->getMessage();
    }
}
    ?>