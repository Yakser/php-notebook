<?php
function getDBPasswordFromDotEnv($dotEnvPath): string
{
    // fixme
    $fh = fopen($dotEnvPath, 'r');
    while ($line = fgets($fh)) {
        list($name, $value) = explode("=", $line);
        if ($name === "DB_PASSWORD") {
            return trim($value);
        }
    }
    fclose($fh);

    return "wanna hack me?";
}

function getFriendsList($type, $page): string
{
    $host = "localhost";
    $user = "test";
    $password = getDBPasswordFromDotEnv("../.env");
    $database = "mysql";
    $port = 3306;

    $con = new mysqli($host, $user, $password, $database, $port);
    if (mysqli_connect_errno()) {
        return 'Ошибка подключения к БД: ' . mysqli_connect_error();
    }

    $result = $con->query('SELECT COUNT(*) FROM notebook.friends')->fetch_row();
    $rows_count = $result[0];
    if ($rows_count === 0) {
        return 'В таблице нет данных';
    }

    $RECORDS_PER_PAGE = 10;
    $pages_count = ceil($rows_count / $RECORDS_PER_PAGE);

    if ($page > $pages_count) {
        $page = $pages_count - 1;
    }

    $start_row = $page * $RECORDS_PER_PAGE;
    $end_row = ($page + 1) * $RECORDS_PER_PAGE;

    $order_type = "id";
    if ($type == "by_last_name") {
        $order_type = "last_name";
    }
    $order_by = "ORDER BY $order_type";

    // todo: remove select *
    $friends = $con->query("
            SELECT * FROM notebook.friends $order_by LIMIT $start_row, $end_row
            ");

    $allMarkup = "";

    $table = "<table class='table'>";
    $table .= "
            <tr class='table__row'>
                <th class='table__heading'>Имя</th>
                <th class='table__heading'>Фамилия</th>
                <th class='table__heading'>Почта</th>
                <th class='table__heading'>Телефон</th>
            </th>
        ";

    while ($row = $friends->fetch_assoc()) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $phone = $row['phone'];

        $table .= "
            <tr class='table__row'>
                <td class='table__data'>$first_name</td>
                <td class='table__data'>$last_name</td>
                <td class='table__data'>$email</td>
                <td class='table__data'>$phone</td>
            </tr>
        ";
    }
    $table .= '</table>';
    $allMarkup .= $table;

    if ($pages_count > 1) {
        $pagination = "<ul class='pagination main__pagination'>";
        for ($page_index = 0; $page_index < $pages_count; $page_index++) {
            if ($page_index != $page) {
                $pagination .= '<li class="pagination__item">
                                    <a class="pagination__link"
                                     href="?p=viewer&pg=' . $page_index . '">' . ($page_index + 1) . '</a>
                                </li>';
            } else {
                $pagination .= '<li class="pagination__item pagination__item--current">' . ($page_index + 1) . '</li>';
            }
        }
        $pagination .= '</ul>';

        $allMarkup .= $pagination;
    }

    return $allMarkup;

}
