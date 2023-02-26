<form class="form" name="form" method="POST" action="./?p=add">
    <div class='form__wrapper'>
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
        <?php
        if ($_POST) {
            $first_name = htmlspecialchars(trim($_POST['first_name']));
            $comment = htmlspecialchars(trim($_POST['comment']));

            // name is required
            if ($first_name) {
                include("db.php");

                $con = connect();
                $result = $con->query('INSERT INTO notebook.friends (first_name,comment) VALUES ("' . $first_name . '", "' . $comment . '")');

                // todo
                if ($result) {
                    echo "Запись добавлена!";
                } else {
                    echo "Не удалось добавить запись :(";
                }
            }
        }
        ?>
    </div>
</form>


