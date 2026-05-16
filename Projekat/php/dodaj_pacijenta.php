<?php

include "konekcija_sa_bazom.php";

$ime = $_POST["ime"];
$godine = $_POST["godine"];
$pol = $_POST["pol"];
$visina = $_POST["visina"];
$tezina = $_POST["tezina"];
$bmi = $_POST["bmi"];
$kategorija = $_POST["kategorija"];
$napomena = $_POST["napomena"];

$nazivSlike = "";

if (isset($_FILES["slika"]) && $_FILES["slika"]["error"] == 0) {
    $folder = __DIR__ . "/../uploads/";

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $originalniNaziv = $_FILES["slika"]["name"];
    $privremenaPutanja = $_FILES["slika"]["tmp_name"];

    $ekstenzija = pathinfo($originalniNaziv, PATHINFO_EXTENSION);

    $nazivSlike = time() . "_" . rand(1000, 9999) . "." . $ekstenzija;

    $novaPutanja = $folder . $nazivSlike;

    move_uploaded_file($privremenaPutanja, $novaPutanja);
}

$upit = $baza->prepare("
INSERT INTO pacijenti
(
    ime,
    godine,
    pol,
    visina,
    tezina,
    bmi,
    kategorija,
    napomena,
    slika
)
VALUES
(
    :ime,
    :godine,
    :pol,
    :visina,
    :tezina,
    :bmi,
    :kategorija,
    :napomena,
    :slika
)
");

$upit->bindValue(":ime", $ime);
$upit->bindValue(":godine", $godine);
$upit->bindValue(":pol", $pol);
$upit->bindValue(":visina", $visina);
$upit->bindValue(":tezina", $tezina);
$upit->bindValue(":bmi", $bmi);
$upit->bindValue(":kategorija", $kategorija);
$upit->bindValue(":napomena", $napomena);
$upit->bindValue(":slika", $nazivSlike);

$rezultat = $upit->execute();

if ($rezultat) {
    echo "Pacijent uspešno dodat.";
} else {
    echo "Greška pri dodavanju.";
}

?>