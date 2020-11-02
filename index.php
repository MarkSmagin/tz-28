<?php
if (!isset($_COOKIE['user_id']))
{
    setcookie('user_id', time());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form id="user_form" enctype="multipart/form-data">
        <div>
            <h3>Введите имя:</h3>
            <input type="text" name="user_name" value="">
        </div>
        <div>
            <h3>Введите телефон:</h3>
            <input type="tel" name="user_phone" value="">
        </div>
        <div>
            <h3>Введите email:</h3>
            <input type="email" name="user_email" value="">
        </div>
        <div>
            <h3>Прикрепить файл</h3>
            <input type="file" name="user_file" id="user_file">
        </div>
        <button type="submit">Отправить</button>
    </form>
    <script src="/jquery.js"></script>
    <script src="/script.js"></script>
</body>
</html>