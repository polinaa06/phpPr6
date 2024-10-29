<div class="catalog container">
    <h2>Каталог товаров</h2>

    <div class="catalog-block">
        <div class="category">
            <a href="?page=home">Все цветы</a>
            <?

            $sql = "SELECT * FROM `category`";
            $res_cat = $connect->query($sql);

            foreach ($res_cat as $cat) { ?>
                <a href="?page=home&cat=<?= $cat['id'] ?>"><?= $cat['name'] ?></a>
            <? } ?>
        </div>

        <form method="post" class="search" name="search">
            <input class="search-input" type="text" name="name" placeholder="Поиск.." value="<? if (isset($_POST['search']))
                echo $_POST['name'] ?>">
                <input type="submit" value="Поиск" name="search" class="search-btn">
            </form>
        </div>

    </div>
    <div class="cards container">
        <?php

            $sql = "SELECT * FROM `tovars`";

            $dopSql = "";

            if (isset($_POST['search'])) {
                $text = $_POST['name'];
                $dopSql .= "WHERE `name` LIKE '%" . $text . "%'";
            }

            if (isset($_GET['cat'])) {
                $cat_id = $_GET['cat'];
                $dopSql .= (empty($dopSql) ? "WHERE " : "AND ") . "category_id = $cat_id";
            }

            $sql = "SELECT * FROM `tovars` $dopSql";
            $result = $connect->query($sql);
            $res = $result->rowCount();

            if ($res == 0) { ?>
        <p>По вашему запросу ничего не найдено! <a href="?page=home">Вернуться ко всем книгам</a></p>
    <? }

            foreach ($result as $tovar) {
                $id = $tovar['id'] ?>
        <div class="card">
            <img src="<?= $tovar['img'] ?>" alt="img">
            <p>Название: <?= $tovar['name'] ?></p>
            <p>Цена: <?= $tovar['price'] ?> ₽</p>
            <?
            $id_cat = $tovar['category_id'];
            $sql = "SELECT * FROM `category` WHERE `id`='$id_cat'";
            $res_cat = $connect->query($sql)->fetch(2);
            ?>
            <p>Категория: <?= $res_cat['name'] ?></p>
        </div>
    <? }
            ?>

</div>
</div>