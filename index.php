<?php
$poruka = "";
$prosjek = null;
$konacnaOcjena = null;

// Obrada forme
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ocjena1 = isset($_POST['ocjena1']) ? (int)$_POST['ocjena1'] : 0;
    $ocjena2 = isset($_POST['ocjena2']) ? (int)$_POST['ocjena2'] : 0;

    // Provjera valjanosti unosa
    if (($ocjena1 < 1 || $ocjena1 > 5) || ($ocjena2 < 1 || $ocjena2 > 5)) {
        $poruka = "Ocjene moraju biti u rasponu od 1 do 5.";
    } else {
        // Izračun prosjeka i konačne ocjene
        if ($ocjena1 > 1 && $ocjena2 > 1) {
            $prosjek = ($ocjena1 + $ocjena2) / 2;
            $konacnaOcjena = round($prosjek); // Zaokruživanje prosjeka na najbližu cijelu ocjenu
        } else {
            $poruka = "Jedan od kolokvija je negativan. Krajnja ocjena je negativna.";
            $konacnaOcjena = 1; // Negativna ocjena
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Izračun prosjeka i konačne ocjene za predmet.">
    <meta name="keywords" content="prosjek, ocjena, php, forma">
    <title>Izračun ocjene</title>
    <link rel="stylesheet" href="style.css"> <!-- Veza prema vanjskom CSS dokumentu -->
</head>
<body>
    <div class="container">
        <h1>Izračun prosjeka i konačne ocjene</h1>
        <form method="post" action="">
            <label for="ocjena1">Ocjena I. kolokvija:</label>
            <input type="number" id="ocjena1" name="ocjena1" min="1" max="5" required>

            <label for="ocjena2">Ocjena II. kolokvija:</label>
            <input type="number" id="ocjena2" name="ocjena2" min="1" max="5" required>

            <button type="submit">Izračunaj</button>
        </form>

        <?php if (!empty($poruka)): ?>
            <div class="error">
                <strong><?php echo $poruka; ?></strong>
            </div>
        <?php elseif ($prosjek !== null): ?>
            <div class="result">
                <p><strong>Prosjek:</strong> <?php echo number_format($prosjek, 2); ?></p>
                </div>
<?php endif; ?>
</div>
</body>
</html>
            
              
