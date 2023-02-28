<form class="form" name="form" method="POST" action="./?p=add">
    <div class='form__wrapper'>
        <?php
        if ($_POST) {
            $first_name = htmlspecialchars(trim($_POST['first_name']));
            $comment = htmlspecialchars(trim($_POST['comment']));

            // first_name is required
            if ($first_name) {
                include("db.php");

                $con = connect();
                if ($con->connect_errno) {
                    echo "<div class='form__status'>";
                    echo "<p class='form__text'>Ошибка подключения к БД 😢</p>";
                    echo "</div>";
                    exit();
                }
                $result = $con->query('INSERT INTO notebook.friends (first_name,comment) VALUES ("' . $first_name . '", "' . $comment . '")');

                echo "<div class='form__status'>";
                if ($result) {
                    echo "<p class='form__text'>Запись добавлена ✅</p>";
                } else {
                    echo "<p class='form__text'>Не удалось добавить запись 😢</p>";
                }
                echo "</div>";

            }
        }
        ?>
        <fieldset class="form__fieldset">
            <legend class="form__legend">Добавить запись</legend>
            <label class="form__label">
                <span class="visually-hidden">Имя</span>
                <input class="form__input" type="text" name="first_name" placeholder="Имя" required/>
            </label>

            <label class="form__label">
                <span class="visually-hidden">Краткий комментарий</span>
                <textarea class="form__input form__textarea"
                          type="text"
                          name="comment"
                          id="comment"
                          placeholder="Краткий комментарий"
                          cols='65'
                          rows='5'></textarea>
            </label>
        </fieldset>
        <button class="form__submit" name="button-add" type="submit">Добавить</button>
    </div>
</form>


