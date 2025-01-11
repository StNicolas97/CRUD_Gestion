<?php

if (!isset($_SESSION['id']) && isset($_SESSION['user_name'])){
    header('Location: ../index.php');
}

require '../model/config.php';

$userId = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $objet = $_POST['objet'];
    $description = $_POST['description'];
    $client = $_POST['client'];
    $debut = $_POST['debut'];
    $lieu = $_POST['lieu'];
    $fin = $_POST['fin'];
    
   
        $sql = "INSERT INTO interventions (objet, description, client_id, debut_travaux, lieu_intervention, users_id, fin_travaux ) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$objet, $description, $client, $debut, $lieu, $userId, $fin ]);

        echo "intervention ajoutée avec succès!";
        header("Location: ../view/intervention.php");
        exit(); 
    } 


?>
   
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une intervention</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../view/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter une intervention</h2>
        <form method="post" action="In_intervention.php">
            <div class="form-group">
                <label for="objet">type</label>
                <select class="form-control" id="objet" name="objet" required>
                    <option value="installation">installation</option>
                    <option value="desintallation">desintallation</option>
                    <option value="maintenance">maintenance</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>

            <div class="form-group">
                <label for="client">ID du client</label>
                <input type="text" class="form-control" id="client" name="client" required>
            </div>
            <div class="form-group">
                <label for="debut">Date de debut</label>
                <input type="text" class="form-control" id="debut" name="debut" required>
            </div>
            <div class="form-group">
                <label for="lieu">Lieu</label>
                <input type="text" class="form-control" id="lieu" name="lieu" required>
            </div>
            <div class="form-group">
                <label for="fin">Date de fin</label>
                <input type="text" class="form-control" id="fin" name="fin" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../view/bootstrap/js/bootstrap.min.js"></script>
    <script>
</body>
</html>