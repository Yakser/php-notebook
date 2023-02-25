<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebook - Яксанов Сергей 221-322</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include('./components/header.php');
?>

<main class="main">
    <h1 class="main__title">
        Notebook - Яксанов Сергей 221-322
    </h1>
    <?php

    switch ($_GET['p']) {
        case 'viewer':
            include './components/viewer.php';
            break;
        case 'add':
            include './components/add.php';
            break;
        case 'edit':
            include './components/edit.php';
            break;
        case 'delete.php':
            include './components/delete.php.php';
            break;
    }

    ?>
</main>

<?php
include('./components/footer.php');
?>
</body>
</html>
