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
    <div class="main__wrapper">
        <h1 class="main__title">
            Notebook - Яксанов Сергей 221-322
        </h1>

        <?php

        switch ($_GET['p']) {
            case 'viewer':
                include './components/viewer.php';
                if (!isset($_GET['pg']) || $_GET['pg'] < 0) {
                    $_GET['pg'] = 0;
                }
                if (!isset($_GET['sort']) || ($_GET['sort'] != 'by_id' && $_GET['sort'] != 'by_last_name' &&
                        $_GET['sort'] != 'birth')) {

                    $_GET['sort'] = 'by_id';
                }
                echo getFriendsList($_GET['sort'], $_GET['pg']);
                break;
            case 'add':
                include './components/add.php';
                break;
            case 'edit':
                include './components/edit.php';
                break;
            case 'delete.php':
                include './components/delete.php';
                break;
        }
        ?>
    </div>
</main>

<?php
include('./components/footer.php');
?>
</body>
</html>
