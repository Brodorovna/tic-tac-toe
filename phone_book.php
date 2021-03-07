<?php

///Сохранение переменной в строке, чтобы не таскать её по файлам.
$result = '';

if (array_key_exists('result', $_GET)) {
    $result = $_GET['result'];
}

if (array_key_exists('number', $_GET)) {
    $result = $result . $_GET['number'];
}

// Импорт и декодирование json-a. 
// большой массив, который должен содержать в себе маленькие массивы
$all_numbers = json_decode(file_get_contents('phone.json'), true);
if (!is_array($all_numbers)) {
    $all_numbers = [];
}
?>

<link rel="stylesheet" href="style.css">
<div class="container">
    <?php
    $i = 9;
    while ($i >= 0) : ?>
        <a href="?number=<?= $i ?>&result=<?= $result ?>"><?= $i--; ?></a>
    <?php endwhile; ?>
</div>
<form action="phone_book_answer.php">
    <input type="hidden" name="phone" value="<?= $result ?>">
    <h2>Dial: <span id="output"><?= $result; ?></span></h2>
    <input type="hidden" name="next" value="phone_book.php?">
    <input name="Name">
    <button type="submit" name="Save">Save</button>

</form>


<a href="?"><strong>Clear</strong></a><br>

<?php
if (array_key_exists("save", $_GET)) {
    $phone = $_GET['phone'];
    $name = $_GET['name'];
    $number = ['number' => $phone, 'name' => $name];
    $all_numbers[] = $number;
    file_put_contents('phone.json', json_encode($all_numbers, JSON_PRETTY_PRINT));
}

// if (array_key_exists('0', $all_numbers)) {
//     print_r($all_numbers);
// }
?>

<pre>
<? print_r($all_numbers) ?>
</pre>