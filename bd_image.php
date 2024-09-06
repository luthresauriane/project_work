<?php
// paramètre de la base de données
$host = 'localhost';  // Changer selon votre configuration
$dbname = 'bd_file_try_again';
$user = 'root';
$pass = '';

// Connexion à la bd
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si un fichier a été soumis
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $imageSize = $_FILES['image']['size'];
    $imageType = $_FILES['image']['type'];
    
    // Définition du répertoire de destination
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($imageName);
    
    // Vérifier si le répertoire existe sinon le créer
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    // Déplacer le fichier téléchargé dans le répertoire de destination
    if (move_uploaded_file($imageTmpPath, $uploadFile)) {
        // Préparer la requête SQL pour insérer les informations de l'image dans la base de données
        $stmt = $pdo->prepare("INSERT INTO imagesstock (filename, filetype, filesize) VALUES (:filename, :filetype, :filesize)");
        $stmt->execute([
            ':filename' => $imageName,
            ':filetype' => $imageType,
            ':filesize' => $imageSize
        ]);
        echo "L'image a été sauvegardé avec succès.";
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
} else {
    echo "Aucun fichier téléchargé ou erreur lors du téléchargement.";
}
?>
