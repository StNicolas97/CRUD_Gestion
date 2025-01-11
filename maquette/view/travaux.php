<?php
/*if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}*/

require '../model/config.php';
include 'header.php';

$sql = "SELECT * FROM interventions";
$stmt = $pdo->query($sql);
$travaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<body>
    <div class="container mt-5">
        <h2>Liste des travaux <a href="../controller/create.php" class="btn btn-primary">Ajouter</a>
        </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Debut</th>
                    <th>Fin</th>
                    <th>Lieu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($travaux as $travaux): ?>
                    <tr>
                        <td><?= htmlspecialchars($travaux['id']) ?></td>
                        <td><?= htmlspecialchars($travaux['objet']) ?></td>
                        <td><?= htmlspecialchars($travaux['debut_travaux']) ?></td>
                        <td><?= htmlspecialchars($travaux['fin_travaux']) ?></td>
                        <td><?= htmlspecialchars($travaux['lieu_intervention']) ?></td>
                        <td>
                            <a href="../controller/update.php?id=<?= $travaux['id'] ?>" ><img class="bi bi-pencil-square" src="image\pencil-square.svg"></a>
                            <a href="../controller/delete.php?id=<?= $travaux['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce travaux?');"><img class="bi bi-trash" src="image\trash.svg"></a>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    

<?php include 'footer.php'; ?>