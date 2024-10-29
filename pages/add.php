<?php
if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = 'assets/img/' . time() . $_FILES['img']['name'];
    $category_id = $_POST['category'];

    $flag = 'true';

    $errors = [
        '<p class="error">Заполните поле ввода</p>'
    ];
}
?>

<form method="POST" class="addform" name="add" enctype="multipart/form-data">
    <h3>Добавление товара</h3>
    <input class="input" type="text" name="name" placeholder="Название букета">
    <?php
    if (isset($_POST['add'])) {
        if (empty($name)) {
            $flag = 'false';
            echo $errors[0];
        }
    } ?>
    <input class="input" type="text" name="price" placeholder="Цена букета">
    <?php
    if (isset($_POST['add'])) {
        if (empty($price)) {
            $flag = 'false';
            echo $errors[0];
        }
    } ?>
    <input class="input-file" type="file" name="img">

    <? if (isset($_POST['add'])) {
        if ($_FILES['img']['name'] == null) {
            $flag = 'false';
            echo $errors[0];
        }
    } ?>

    <select class="input" name="category">
        <?php

        $sql = "SELECT * FROM `category`";
        $res = $connect->query($sql);

        foreach ($res as $cat) { ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
        <? }
        ?>
    </select>

    <input type="submit" value="Добавить" name="add" class="add-btn">
</form>

<? if (isset($_POST['add'])) {
    if ($flag != 'false') {
        move_uploaded_file($_FILES['img']['tmp_name'], $img);
        $sql = "INSERT INTO `tovars`(`name`, `price`, `img`, `category_id`) VALUES ('$name','$price', '$img', '$category_id')";
        $res = $connect->query($sql);
        echo '<script> document.location.href="?page=home"</script>';

    }
} ?>