<?php
require './src/dbConnect.php';
require_once './src/crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Supprimer le contact
    if (isset($_POST["delete"])) {
        $idToDelete = $_POST["delete"];
        if (!empty($idToDelete) && is_numeric($idToDelete)) {
            $query = "DELETE FROM `contacts` WHERE `id` = " . (int)$idToDelete;
            $connection->query($query);
            echo "Contact supprimé !";
        } 
    } elseif (isset($_POST["id"])) {   // Mettre à jour le contact
        $idToUpdate = $_POST["id"];
        if (!empty($idToUpdate) && is_numeric($idToUpdate)) {
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $preferences = $_POST["preferences"];
            $query = "UPDATE `contacts` SET ";
            $query .= "`name` = '" . $name . "', ";
            $query .= "`surname` = '" . $surname . "', ";
            $query .= "`email` = '" . $email . "', ";
            $query .= "`phone` = '" . $phone . "', ";
            $query .= "`preferences` = '" . $preferences . "'";
            $query .= " WHERE `id` = " . (int)$idToUpdate;
            $connection->query($query);
            echo "Contact mis à jour";
        }
    }
}
$query = "SELECT * FROM `contacts`";
$whereClause = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["apply_filter"])) {
    $filterPreference = isset($_POST['filter_preference']) ? $_POST['filter_preference'] : '';

    if (!empty($filterPreference)) {
        $whereClause = " WHERE `preferences` = '$filterPreference'";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["search"];
    if (!empty($searchTerm)) {
        if (empty($whereClause)) {
            $whereClause = " WHERE";
        } else {
            $whereClause .= " AND";
        }
        $whereClause .= " (`name` LIKE '%$searchTerm%' OR `surname` LIKE '%$searchTerm%' OR `email` LIKE '%$searchTerm%' OR `phone` LIKE '%$searchTerm%')";
    }
}

$query .= $whereClause . " ORDER BY id DESC";
$data = $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="admin-space">
    <div class="admin-filters">
        <h1>Liste des contacts</h1>
        <form method="post">
            <div>
                <input class="search-input" type="text" name="search" placeholder="Recherche d'un contact" id="search">
                <button class="search-input" type="submit" style="cursor:pointer;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div>
                <select name="filter_preference" class="search-input">
                    <option value="">Toutes les préférences</option>
                    <option value="Graphique">Spé Graphique</option>
                    <option value="Développement">Spé Développement</option>
                    <option value="Marketing">Spé Marketing</option>
                    <option value="Communication Digitale">Spé Communication Digitale</option>
                </select>
                <button type="submit" class="search-input" style="cursor:pointer;" name="apply_filter">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="card-admin">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Préférence de spécialité</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    foreach ($data as $key => $value) {
                        echo "<tr>";
                        echo "<td>" . $value["name"] . "</td>";
                        echo "<td>" . $value["surname"] . "</td>";
                        echo "<td>" . $value["email"] . "</td>";
                        echo "<td>" . $value["phone"] . "</td>";
                        echo "<td>" . $value["preferences"] . "</td>";
                        echo '<td>
                            <button class="pen-to-square bouton-action" data-formid="' . $value["id"] . '"><i class="fas fa-pen-to-square"></i></button>
                            <form method="post" id="editForm' . $value["id"] . '" style="display: none; flex-direction: column; width:100%;">
                                <input type="hidden" name="id" value="' . $value["id"] . '">
                                <div style="display:flex; flex-direction:column; margin-bottom:8px;">
                                    <label>Nom :</label>
                                    <input type="text" name="name" value="' . $value["name"] . '">
                                </div>
                                <div style="display:flex; flex-direction:column; margin-bottom:8px;">
                                <label>Prénom :</label>
                                <input type="text" name="surname" value="' . $value["surname"] . '">
                                </div>
                                <div style="display:flex; flex-direction:column; margin-bottom:8px;">
                                <label>Email :</label>
                                <input type="text" name="email" value="' . $value["email"] . '">
                                </div>
                                <div style="display:flex; flex-direction:column; margin-bottom:8px;">
                                <label>Téléphone :</label>
                                <input type="text" name="phone" value="' . $value["phone"] . '">
                                </div>
                                <div style="display:flex; flex-direction:column; margin-bottom:8px;">
                                <label>Préférences :</label>
                                <input type="text" name="preferences" value="' . $value["preferences"] . '">
                                </div>
                                <button type="submit">Modifier</button>
                            </form>
                            <form method="post">
                                <input type="hidden" name="delete" value="' . $value["id"] . '">
                                <button class="bouton-action" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>';
                        echo "</tr>";
                    }
                    ?>
                </table>
            </tbody>
        </table>
    </div>
</section>
<script> //Affichage de la modification des données dans la table
document.addEventListener("DOMContentLoaded", function() {
    const penToSquareButtons = document.querySelectorAll(".pen-to-square");
    penToSquareButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            const formId = this.getAttribute("data-formid");
            const editForm = document.getElementById("editForm" + formId);

            if (editForm.style.display === "flex") {
                editForm.style.display = "none";
            } else {
                editForm.style.display = "flex";
            }
        });
    });
});
</script>
