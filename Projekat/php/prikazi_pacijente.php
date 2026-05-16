<?php

include "konekcija_sa_bazom.php";

$rezultat = $baza->query("
SELECT *
FROM pacijenti
ORDER BY id DESC
");

$pacijenti = array();

while ($red = $rezultat->fetchArray(SQLITE3_ASSOC)) {
    $pacijenti[] = $red;
}

echo json_encode($pacijenti, JSON_UNESCAPED_UNICODE);

?>