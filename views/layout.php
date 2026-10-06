<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;

if (!isset($start)) {
    $start = false;
}
?>
<!DOCTYPE html>
<html lang="<?php echo currentLanguage(); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgIn - <?php echo $header ?? ''; ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>
    <?php
    include_once __DIR__ . '/templates/header.php';
    echo $content ?? '';
    include_once __DIR__ . '/templates/footer.php';
    ?>

    <script src="/build/js/bundle.min.js"></script>
</body>
</html>