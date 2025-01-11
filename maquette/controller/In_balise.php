<?php
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
	header('Location: ../index.php');
}
require '../model/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $statut = $_POST['statut'];
    $num_serie = $_POST['num_serie'];
    
   
        $sql = "INSERT INTO balise (statut, num_serie) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$statut, $num_serie]);

        echo "Balise ajouté avec succès!";
        header("Location: ../view/balise.php");
        exit();
    } 


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Balise</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../view/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter une Balise</h2>
        <form method="post" action="In_balise.php">
            <div class="form-group">
                <label for="statut">Statut</label>
                <select class="form-control" id="statut" name="statut" required>
                    <option value="En stock">En stock</option>
                </select>
            </div>

            <div class="form-group">
                <label for="num_serie">Numéro de Série</label>
                <input type="text" class="form-control" id="num_serie" name="num_serie" required>
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