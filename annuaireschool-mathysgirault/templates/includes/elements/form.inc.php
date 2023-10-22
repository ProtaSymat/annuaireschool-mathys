<?php
require "./src/dbConnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["name"]) &&
        isset($_POST["surname"]) &&
        isset($_POST["email"]) &&
        isset($_POST["phone"]) &&
        isset($_POST["preferences"])
    ) {
        $query =
            "INSERT INTO `contacts` (`name`, `surname`, `email`, `phone`, `preferences`) VALUES (";
        $query .= "\"" . $_POST["name"] . "\", ";
        $query .= "\"" . $_POST["surname"] . "\", ";
        $query .= "\"" . $_POST["email"] . "\", ";
        $query .= "\"" . $_POST["phone"] . "\", ";
        $query .= "\"" . $_POST["preferences"] . "\"";
        $query .= ")";
        $connection->query($query);
        echo "Prise de contact prit en compte";
    }
}
?>
<form action="#" method="post">
  <div class="first-input">
    <div>
      <label for="name">Nom :</label>
      <input class="input-contact" type="text" id="name" name="name" />
    </div>
    <div>
      <label for="surname">Prénom :</label>
      <input class="input-contact" type="text" id="surname" name="surname" />
    </div>
  </div>
  <div class="second-input">
    <label for="email">Adresse Email :</label>
    <input class="input-contact" type="email" id="email" name="email" />
  </div>
  <div class="second-input">
    <label for="phone">Téléphone :</label>
    <input class="input-contact" type="text" id="phone" name="phone" />
  </div>
  <div class="third-input mb-8">
    <label class="mb-8">Spécialité de préférence :</label>
    <div class="mb-2">
    <label for="graphique">Spé Graphisme</label>
    <input type="radio" id="graphique" name="preferences" value="Graphique">
    </div>
    <div class="mb-2">
    <label for="developpement">Spé Développement Web</label>
    <input type="radio" id="developpement" name="preferences" value="Développement">
    </div>
    <div class="mb-2">
    <label for="marketing">Spé Marketing</label>
    <input type="radio" id="marketing" name="preferences" value="Marketing">
    </div>
    <div class="mb-2">
    <label for="communication">Spé Communication Digitale</label>
    <input type="radio" id="communication" name="preferences" value="Communication Digitale">
    </div>
  </div>
  <input class="button-submit" type="submit" value="S'INSCRIRE" />
  </div>
</form>
