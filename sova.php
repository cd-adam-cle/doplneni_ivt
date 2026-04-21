<?php
$citaty = [
    "Kdo chce hýbat světem, musí nejprve hýbat sám sebou.",
    "Trpělivost je hořká, ale její plody jsou sladké.",
    "Chyba je příležitost začít znovu, tentokrát inteligentněji.",
    "Nejlepší způsob, jak předpovědět budoucnost, je vytvořit ji.",
    "Programátor je organismus, který mění kofein v kód."
];

function ziskejMoudrost($seznam) {
    $index = array_rand($seznam);
    return $seznam[$index];
}

$vysledek = ziskejMoudrost($citaty);

$hodina = (int)date("G");

if ($hodina >= 5 && $hodina <= 8) {
    $zprava = "Dobré ráno! Každý nový den je šancí být lepší verzí sebe. Vstávej a jdi do toho! 🌅";
} elseif ($hodina >= 9 && $hodina <= 17) {
    $zprava = "Pracovní doba je tvůj čas zazářit. Soustřeď se, jeden krok za druhým. 💪";
} else {
    $zprava = "Den je za tebou. Odpočívej, nabírej síly – zítra tě čekají nové výzvy. 🌙";
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Moudrá sova PHP</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f9; margin: 0; }
        .karta { background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; max-width: 400px; }
        blockquote { font-style: italic; color: #333; font-size: 1.2rem; margin-bottom: 20px; }
        .cas-zprava { color: #555; font-size: 0.95rem; margin-bottom: 20px; }
        button { background-color: #4CAF50; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 1rem; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>

    <div class="karta">
        <h1>🦉 Moudrá PHP Sova</h1>
        <blockquote>
            <?php echo $vysledek; ?>
        </blockquote>
        <p class="cas-zprava"><?php echo $zprava; ?></p>

        <form method="get">
            <button type="submit">Chci jinou radu!</button>
        </form>
    </div>

</body>
</html>
