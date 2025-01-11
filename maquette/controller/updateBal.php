<?php

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
	header('Location: ../index.php');
}
require '../model/config.php';


$id = $_GET['id'];
$sql = "SELECT * FROM balise WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$balise = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num_serie = $_POST['num_serie'];
    

        $sql = "UPDATE balise SET num_serie = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$num_serie, $id]);

        echo "balise mise à jour avec succès!";
        header("Location: ../view/balise.php");
        exit();

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
        <h2>Modifier les informations de la balise</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form method="post" action="updateBal.php?id=<?= $id ?>" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="nom">numero de serie</label>
                <input type="text" class="form-control" id="num_serie" name="num_serie" value="<?= htmlspecialchars($balise['num_serie']) ?>" required>
                <div class="invalid-feedback">Veuillez entrer le nom.</div>
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
