<?php

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
	header('Location: ../index.php');
}
require '../model/config.php';

function validateDates($startDate, $endDate) {
    $startTimestamp = strtotime($startDate);
    $endTimestamp = strtotime($endDate);

    if ($endTimestamp >= $startTimestamp) {
        return true; // Dates are valid
    } else {
        return false; // End date is before start date
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM clients WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $type_client = $_POST['type_client'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse_postale = $_POST['adresse_postale'];
    $situation_geographique = $_POST['situation_geographique'];
    $date_debut_contrat = $_POST['date_debut_contrat'];
    $date_fin_contrat = $_POST['date_fin_contrat'];

    if (validateDates($date_debut_contrat, $date_fin_contrat)) {
        $sql = "UPDATE clients SET nom = ?, type_client = ?, email = ?, telephone = ?, adresse_postale = ?, situation_geographique = ?, date_debut_contrat = ?, date_fin_contrat = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $type_client, $email, $telephone, $adresse_postale, $situation_geographique, $date_debut_contrat, $date_fin_contrat, $id]);

        echo "Client mis à jour avec succès!";
        header("Location: ../view/client.php");
        exit();
    } else {
        $error = "La date de fin de contrat ne peux pas etre avant la date de début.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../view/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript"> 
        function preventBack() { 
            window.history.forward();  
        } 
          
        setTimeout("preventBack()", 0); 
          
        window.onunload = function () { null }; 
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier les informations du client</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form method="post" action="update.php?id=<?= $id ?>" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer le nom.</div>
            </div>
            <div class="form-group">
                <label for="type_client">Type de client</label>
                <input type="text" class="form-control" id="type_client" name="type_client" value="<?= htmlspecialchars($client['type_client']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer le type de client.</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($client['telephone']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer un numéro de téléphone.</div>
            </div>
            <div class="form-group">
                <label for="adresse_postale">Adresse postale</label>
                <input type="text" class="form-control" id="adresse_postale" name="adresse_postale" value="<?= htmlspecialchars($client['adresse_postale']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer une adresse postale.</div>
            </div>
            <div class="form-group">
                <label for="situation_geographique">Situation géographique</label>
                <input type="text" class="form-control" id="situation_geographique" name="situation_geographique" value="<?= htmlspecialchars($client['situation_geographique']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer la situation géographique.</div>
            </div>
            <div class="form-group">
                <label for="date_debut_contrat">Date de début de contrat</label>
                <input type="date" class="form-control" id="date_debut_contrat" name="date_debut_contrat" value="<?= htmlspecialchars($client['date_debut_contrat']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer la date de début de contrat.</div>
            </div>
            <div class="form-group">
                <label for="date_fin_contrat">Date de fin de contrat</label>
                <input type="date" class="form-control" id="date_fin_contrat" name="date_fin_contrat" value="<?= htmlspecialchars($client['date_fin_contrat']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer la date de fin de contrat.</div>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../view/bootstrap/js/bootstrap.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
