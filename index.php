<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<link rel="stylesheet" href="style.css">

<?php

//Получили данные из ж-сона, декодировали в массив и записали в $entries
$content = file_get_contents('tictactoe_db.json');
$entries = json_decode($content, true);

//Проверяем, существует ли массив $entries. Если нет, то создаём.
if (!is_array($entries)) {
    $entries = [];
}

// $entries['table'] = (array_key_exists('table', $entries) ? $entries['table'] : []); -- предложенный вариант с тернарным оператором

//if classic для осознания происходящего и чтобы подключить созздание table, если его не было в jsone
if (array_key_exists('table', $entries)) {
    $entries['table'] = $entries['table'];
} else {
    $entries = ['table' => $entries]; //Если такого ключа не было, то он создаётся и ему присваивается массив $entries. 
}

//Переменной $table присваивается значение ключа table в масссиве $entries. 
$table = &$entries['table']; // Вы можете передать переменную в функцию по ссылке, чтобы она могла изменять значение аргумента.

//Если в массиве существуют ключи "строка" и "ячейка", то
if (
    array_key_exists('r', $_REQUEST) &&
    array_key_exists('c', $_REQUEST)
) {
    //Вывести в заголовке 3 значения этих ключей и привоить их значения переменным (чтобы было покороче) 
    // echo "r=" . $_REQUEST['r'] . "; c= " . $_REQUEST['c'] . ' ';
    $a = $_REQUEST['r'];
    $b = $_REQUEST['c'];

    //Если НЕ существует ключа count в массиве $entries, то он создаётся и ему присваивается значение 1
    if (!array_key_exists('count', $entries)) {
        $entries['count'] = 1;
        // Если существует, то его текущее значение увеличивается на 1.
    } else {
        $entries['count']++;
    }

    // Если в активном поле есть х или о, то выводится сообщение, что поле занято
    if ($table[$a][$b] == 'x' || $table[$a][$b] == 'O') {
        echo '<h4>Field is reserved</h4>';
        // в противном случае добавляется соотв. символ
    } else {
        // Если значение ключа count чётное, то в клетке ставится О, если нечётное, то Х.
        if ($entries['count'] % 2 != 0) {
            $table[$a][$b] = 'x';
        } else {
            $table[$a][$b] = 'O';
        }
    }
    // Массив $entries шифруется и отправляется в json с применением эстетичного форматирования. 
    file_put_contents('tictactoe_db.json', json_encode($entries, JSON_PRETTY_PRINT));
}

?>

<div class="container">
    <?php for ($r = 0; $r < 3; $r++) : ?>
        <?php for ($c = 0; $c < 3; $c++) : ?>
            <a href="?r=<?= $r ?>&c=<?= $c ?>"><?= $table[$r][$c]; ?></a>
        <?php endfor; ?>
    <?php endfor; ?>
</div>