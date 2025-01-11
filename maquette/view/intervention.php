<?php
/*if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}*/

require '../model/config.php';
include 'header.php';

$sql = "SELECT * FROM interventions";
$stmt = $pdo->query($sql);
$inter = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<body>
    <div class="container mt-5">
        <h2>Liste des clients <a href="../controller/In_intervention.php" class="btn btn-primary">Ajouter</a>
        </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>ID client</th>
                    <th>Debut des travaux</th>
                    <th>Lieu</th>
                    <th>Fin des travaux</th>
                    <th>Technicien</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inter as $inter): ?>
                    <tr>
                        <td><?= htmlspecialchars($inter['id']) ?></td>
                        <td><?= htmlspecialchars($inter['objet']) ?></td>
                        <td><?= htmlspecialchars($inter['cleint_id']) ?></td>
                        <td><?= htmlspecialchars($inter['debut_travaux']) ?></td>
                        <td><?= htmlspecialchars($inter['lieu_intervention']) ?></td>
                        <td><?= htmlspecialchars($inter['fin_travaux']) ?></td>
                        <td><?= htmlspecialchars($inter['users_id']) ?></td>
                        <td>
                            <a href="../controller/update.php?id=<?= $inter['id'] ?>" ><img class="bi bi-pencil-square" src="image\pencil-square.svg"></a>
                            <!--<a href="../controller/delete.php?id=<?= $client['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?');"><img class="bi bi-trash" src="image\trash.svg"></a>-->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    

<?php include 'footer.php'; ?>