<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Curățare date și validare de bază
    $nume = strip_tags(trim($_POST["nume"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telefon = strip_tags(trim($_POST["telefon"]));
    $tip_fotografie = strip_tags(trim($_POST["tip_fotografie"]));
    $mesaj = strip_tags(trim($_POST["mesaj"]));

    // Verificare câmpuri obligatorii
    if (empty($nume) || empty($email) || empty($telefon) || empty($tip_fotografie)) {
        echo "Te rog completează toate câmpurile obligatorii.";
        exit;
    }

    // Destinatarul
    $to = "trebuie_mail@yahoo.com"; // SCHIMBĂ cu email-ul tău

    // Subiect
    $subject = "Cerere ofertă personalizată de la $nume";

    // Corp HTML al mesajului
    $body = "
    <html>
    <head>
    <title>Cerere ofertă personalizată</title>
    </head>
    <body>
        <h2>Cerere ofertă de la $nume</h2>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Telefon:</strong> $telefon</p>
        <p><strong>Tip fotografie:</strong> $tip_fotografie</p>
        <p><strong>Mesaj:</strong><br>$mesaj</p>
    </body>
    </html>
    ";

    // Header email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $nume <$email>" . "\r\n";

    // Trimitere email
    if (mail($to, $subject, $body, $headers)) {
        echo "Mulțumim! Cererea ta a fost trimisă cu succes.";
    } else {
        echo "Ne pare rău, a apărut o eroare și mesajul nu a putut fi trimis.";
    }

} else {
    echo "Acces direct nepermis.";
}
?>
