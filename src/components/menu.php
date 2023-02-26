<nav class='header__navigation navigation'>
    <ul class="navigation__list">
        <?php
        function toNavigationLinkSelected($pageName): string
        {
            if ($_GET['p'] == $pageName) {
                return "navigation__link--selected";
            }
            return "";
        }

        function toSubmenuLinkSelected($pageName): string
        {
            // todo
            if ($_GET['p'] == $pageName) {
                return "submenu__link--selected";
            }
            return "";
        }

        if (!isset($_GET['p'])) {
            $_GET['p'] = 'viewer';
        }

        $isViewerSelected = toNavigationLinkSelected("viewer");
        $isAddSelected = toNavigationLinkSelected("add");

        $currentPage = 0;
        if (isset($_GET['pg'])) {
            $currentPage = $_GET['pg'];
        }

        echo "<li class='navigation__item'>
            <a href='./?p=viewer' class='navigation__link $isViewerSelected'>Просмотр</a>
            <ul class='navigati on__submenu submenu'>
                   <li class='submenu__item submenu__item--hint'>
                    Сортировка:
                </li>
                <li class='submenu__item'>
                <a href='./?p=viewer&pg=$currentPage&sort=by_id' class='submenu__link'>
                    По умолчанию
                </a>
                </li>
                <li class='submenu__item'>
                     <a href='./?p=viewer&pg=$currentPage&sort=by_last_name' class='submenu__link'>
                         По фамилии
                    </a>
                </li>
            </ul>
          </li>";
        echo "<li class='navigation__item'>
            <a href='./?p=add' class='navigation__link $isAddSelected'>Добавить запись</a>
          </li>";

        ?>
    </ul>
</nav>
