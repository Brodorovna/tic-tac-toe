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
$number_line = $number_line . json_decode(file_get_contents('phone.json'), true);
$phone_book = ["Number line:" => $number_line];
if (!is_array($phone_book)) {
    $phone_book = [];
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
    <button type="submit">Save</button>
    <!-- <a href="?save&result=<?= $result ?>">Save</a> -->
</form>



<a href="?"><strong>Clear</strong></a><br>


<?php


for ($i = 0; $i < count($phone_book); $i++) {
    echo "<p>" . $phone_book[$i] . "</p>";
}
?>