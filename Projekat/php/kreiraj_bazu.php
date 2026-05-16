<?php

include "konekcija_sa_bazom.php";

$sql = "
CREATE TABLE IF NOT EXISTS pacijenti (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ime TEXT,
    godine INTEGER,
    pol TEXT,
    visina REAL,
    tezina REAL,
    bmi REAL,
    kategorija TEXT,
    napomena TEXT,
    slika TEXT
)
";

$baza->exec($sql);

echo "Baza i tabela su uspešno kreirane.<br>";
echo "Putanja baze: " . $putanja;

?>