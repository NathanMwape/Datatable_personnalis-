<?php
// Inclure la connexion à la base de données
require_once "db.php";

// Si la méthode de la requête est POST, traiter l'insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? null;
    $age = $_POST['age'] ?? null;

    if ($nom && $age) {
        // Préparer et exécuter l'insertion dans la base de données
        $sql = "INSERT INTO personne (nom, age) VALUES (:nom, :age)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([':nom' => $nom, ':age' => $age])) {
            // Réponse JSON en cas de succès
            echo json_encode(['status' => 'success', 'message' => 'Personne ajoutée avec succès!']);
        } else {
            // Réponse JSON en cas d'erreur
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'ajout.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Veuillez remplir tous les champs.']);
    }
    exit(); // Stopper l'exécution ici, car c'est une requête AJAX
}

// afficher les donees de la base de données
$sql = "SELECT * FROM personne";
$result = $pdo->query($sql);
$data = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable with Bootstrap 5</title>
    
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="css/datatable-setting.css">
    <link rel="stylesheet" href="css/fontawesome-free-6.5.2-web/css/all.min.css">

    <!-- CDN Pour la notification -->
    <script src="js/sweetalert2@11.js"></script>
    <link rel="stylesheet" href="css/animate.min.css"/>
</head>
<body>
<div class="container mt-5">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une personne</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" class="ajax-form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="nom" placeholder="Nom" >
                        </div>
                        <div class="mb-3">
                            <label for="age" class="col-form-label">Âge</label>
                            <input type="number" class="form-control" name="age" id="age" placeholder="Age">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="mb-4">DATA TABLE</h2>
    <table class="table table-striped  data-table-export"
        data-title = "DataTable title"
        data-filename = "DataTable fileName">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $personne): ?>
            <tr>
                <td><?= $personne['nom'] ?></td>
                <td>Director</td>
                <td>New York</td>
                <td><?= $personne['age'] ?></td>
                <td>2008-09-26</td>
                <td>$645,750</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- jQuery -->
<script src="js/jquery-3.7.1.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/dataTables.js"></script>
<script src="js/dataTables.bootstrap5.js"></script>
<script src="js/datatable-setting.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.bootstrap5.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>

<script>
$(document).ready(function () {
    // Gérer la soumission du formulaire via AJAX
    $(".ajax-form").on("submit", function (e) {
        e.preventDefault(); // Empêcher la soumission normale du formulaire

        var form = $(this); // Référence au formulaire soumis
        $.ajax({
            url: '', // Soumet le formulaire sur la même page
            type: form.attr("method") || "POST", // Type de requête (par défaut POST)
            data: form.serialize(), // Sérialiser les données du formulaire
            dataType: "json", // Réponse attendue : JSON
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'animated tada',
                        }
                    }).then(() => {
                        location.reload(); // Recharger la page après la fermeture du modal
                    });
                } else if (response.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur!',
                        text: response.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur!',
                    text: 'Erreur lors de l\'ajout de l\'opération : ' + error,
                });
            },
        });
    });
});
</script>
</body>
</html>
