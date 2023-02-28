<form class="form" name="form" method="POST" action="./?p=delete">
    <div class='form__wrapper'>
        <?php
        // todo check connection error
        include("db.php");
        $con = connect();

        if ($_POST) {
            $id = htmlspecialchars(trim($_POST['id']));
            $result = $con->query('DELETE FROM notebook.friends WHERE id="' . $id . '"');

            echo "<div class='form__status'>";
            if ($result) {
                echo "<p class='form__text'>Запись удалена ✍️</p>";
            } else {
                echo "<p class='form__text'>Не удалось удалить запись 😢</p>";
            }
            echo "</div>";

            $_GET['id'] = $id;
        }

        $currentRow = array();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $con->query('select id, first_name, last_name, patronymic from notebook.friends where id="' . $id . '" limit 0, 1');
            $currentRow = $result->fetch_assoc();
        }

        if (!$currentRow) {
            $result = $con->query('select id, first_name, last_name, patronymic from notebook.friends limit 0, 1');
            $currentRow = $result->fetch_assoc();
        }
        ?>
        <fieldset class="form__fieldset">
            <legend class="form__legend">Удалить запись</legend>
            <label class="form__label">
                <span class="visually-hidden">Имя</span>
                <?php
                echo '<input class="form__input"
                 type="text"
                  name="first_name"
                   placeholder="Имя"
                   disabled
                    required value="' . $currentRow['first_name'] . '"/>';
                ?>
            </label>
            <label class="form__label">
                <span class="visually-hidden">Фамилия</span>
                <?php
                echo '<input class="form__input"
                 type="text"
                  name="last_name"
                   placeholder="Фамилия"
                   disabled
                    required value="' . $currentRow['last_name'] . '"/>';
                ?>
            </label>
            <label class="form__label">
                <span class="visually-hidden">Отчество</span>
                <?php
                echo '<input class="form__input"
                 type="text"
                  name="patronymic"
                   placeholder="Отчество"
                   disabled
                    required value="' . $currentRow['patronymic'] . '"/>';
                ?>
            </label>
            <label class="form__label">
                <span class="visually-hidden">ID</span>
                <?php
                echo '<input class="form__input"
                 type="hidden"
                  name="id"
                   placeholder="ID"
                    required value="' . $currentRow['id'] . '"/>';
                ?>
            </label>
        </fieldset>
        <button class="form__submit" name="button-edit" type="submit">Удалить</button>
    </div>
</form>

<?php
// fixme - add pagination
$result = $con->query('select id, first_name, last_name, patronymic from notebook.friends');

if ($result) {
    echo "<ul class='edit-links'>";
    while ($row = $result->fetch_assoc()) {
        $name = $row['last_name'] . " " .
            (mb_substr($row['first_name'], 0, 1)) . ". " .
            (mb_substr($row['patronymic'], 0, 1)) . ".";

        if ($currentRow['id'] == $row['id']) {
            echo "<li class='edit-links__item edit-links__item--current'>" . $name . "</li>";
        } else {
            echo "<li class='edit-links__item'>
                    <a class='edit-links__link' href='?p=delete&id=" . $row['id'] . "'>" . $name . "</a>
                  </li>";
        }
    }
    echo "</ul>";
}

?>

