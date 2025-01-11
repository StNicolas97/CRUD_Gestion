<?php
/*if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}*/

require '../model/config.php';
include 'header.php';

$sql = "SELECT * FROM clients";
$stmt = $pdo->query($sql);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<body>
    <div class="container mt-5">
        <h2>Liste des clients <a href="../controller/create.php" class="btn btn-primary">Ajouter</a>
        </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse postale</th>
                    <th>Situation géographique</th>
                    <th>Date début contrat</th>
                    <th>Date fin contrat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['id']) ?></td>
                        <td><?= htmlspecialchars($client['nom']) ?></td>
                        <td><?= htmlspecialchars($client['type_client']) ?></td>
                        <td><?= htmlspecialchars($client['email']) ?></td>
                        <td><?= htmlspecialchars($client['telephone']) ?></td>
                        <td><?= htmlspecialchars($client['adresse_postale']) ?></td>
                        <td><?= htmlspecialchars($client['situation_geographique']) ?></td>
                        <td><?= htmlspecialchars($client['date_debut_contrat']) ?></td>
                        <td><?= htmlspecialchars($client['date_fin_contrat']) ?></td>
                        <td>
                            <a href="../controller/update.php?id=<?= $client['id'] ?>" ><img class="bi bi-pencil-square" src="image\pencil-square.svg"></a>
                            <a href="../controller/delete.php?id=<?= $client['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?');"><img class="bi bi-trash" src="image\trash.svg"></a>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    

<?php include 'footer.php'; ?>