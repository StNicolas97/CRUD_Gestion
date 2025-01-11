<?php
/*if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}*/

require '../model/config.php';
include 'header.php';

$sql = "SELECT * FROM balise";
$stmt = $pdo->query($sql);
$balises = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<body>
    <div class="container mt-5">
        <h2>Liste des Balises <a href="../controller/In_balise.php" class="btn btn-primary">Ajouter</a>
        </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Statut</th>
                    <th>Numero de serie</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($balises as $balise): ?>
                    <tr>
                        <td><?= htmlspecialchars($balise['id']) ?></td>
                        <td><?= htmlspecialchars($balise['statut']) ?></td>
                        <td><?= htmlspecialchars($balise['num_serie']) ?></td>
                        
                        <td>
                            <a href="../controller/updateBal.php?id=<?= $balise['id'] ?>" ><img class="bi bi-pencil-square" src="image\pencil-square.svg"></a>
                            <a href="../controller/deleteBal.php?id=<?= $balise['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette balise?');"><img class="bi bi-trash" src="image\trash.svg"></a>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    

<?php include 'footer.php'; ?>