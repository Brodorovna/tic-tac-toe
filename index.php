<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include 'functions.php';
?>

<link rel="stylesheet" href="style.css">

<?php

if (array_key_exists('reset', $_REQUEST)) {
    resetEntries();
}

$entries = getEntries();
$table = &getTable($entries);

if (
    array_key_exists('r', $_REQUEST) && array_key_exists('c', $_REQUEST)
) {
    $a = $_REQUEST['r'];
    $b = $_REQUEST['c'];

    if (@$table[$a][$b] == 'x' || @$table[$a][$b] == 'O') {
        echo '<h4>Field is reserved</h4>';
    } else {
        (!array_key_exists('count', $entries)) ? $entries['count'] = 1 : $entries['count']++;
        ($entries['count'] % 2 != 0) ?   $table[$a][$b] = 'x' : $table[$a][$b] = 'O';
    }

    saveEntries($entries); // функция сохранения в в файл
}

?>

<div class="container">
    <?php for ($r = 0; $r < 3; $r++) {
        for ($c = 0; $c < 3; $c++) {
            $value = (array_key_exists($r, $table) &&
                array_key_exists($c, $table[$r]))
                ? $table[$r][$c] : '';
            echo "<a href='?r=$r&c=$c'>" . $value . "</a>";
        }
    }
    ?>
    <a href="?reset"> Reset </a>
</div>


<?php
$row = $table[0];
$row1 = $table[1];
$row2 = $table[2];


////////////////row
switch (true) {
    case ($row[0] == "x" && $row[1] == "x" && $row[2] == "x"):
        echo "x won <br>";
        break;
    case ($row[0] == "O" && $row[1] == "O" && $row[2] == "O"):
        echo "O won <br>";
        break;
}

switch (true) {
    case ($row1[0] == "x" && $row1[1] == "x" && $row1[2] == "x"):
        echo "x won <br>";
        break;
    case ($row1[0] == "O" && $row1[1] == "O" && $row1[2] == "O"):
        echo "O won <br>";
        break;
}

switch (true) {
    case ($row2[0] == "x" && $row2[1] == "x" && $row2[2] == "x"):
        echo "x won <br>";
        break;
    case ($row2[0] == "O" && $row2[1] == "O" && $row2[2] == "O"):
        echo "O won <br>";
        break;
}

//////////////////col
switch (true) {
    case ($table[0][0] == "x" && $table[1][0] == "x" && $table[2][0] == "x"):
        echo "x won <br>";
        break;
    case ($table[0][0] == "O" && $table[1][0] == "O" && $table[2][0] == "O"):
        echo "O won <br>";
        break;
}

switch (true) {
    case ($table[0][1] == "x" && $table[1][1] == "x" && $table[2][1] == "x"):
        echo "x won <br>";
        break;
    case ($table[0][1] == "O" && $table[1][1] == "O" && $table[2][1] == "O"):
        echo "O won <br>";
        break;
}


switch (true) {
    case ($table[0][2] == "x" && $table[1][2] == "x" && $table[2][2] == "x"):
        echo "x won <br>";
        break;
    case ($table[0][2] == "O" && $table[1][2] == "O" && $table[2][2] == "O"):
        echo "O won <br>";
        break;
}

/////////////cross
switch (true) {
    case ($table[0][0] == "x" && $table[1][1] == "x" && $table[2][2] == "x"):
        echo "x won <br>";
        break;
    case ($table[0][0] == "O" && $table[1][1] == "O" && $table[2][2] == "O"):
        echo "O won <br>";
        break;
}

switch (true) {
    case ($table[0][0] == "x" && $table[1][1] == "x" && $table[2][2] == "x"):
        echo "x won <br>";
        break;
    case ($table[0][0] == "O" && $table[1][1] == "O" && $table[2][2] == "O"):
        echo "O won <br>";
        break;
}

switch (true) {
    case ($table[0][2] == "x" && $table[1][1] == "x" && $table[2][0] == "x"):
        echo "x won <br>";
        break;
    case ($table[0][2] == "O" && $table[1][1] == "O" && $table[2][0] == "O"):
        echo "O won <br>";
        break;
}

// ПРОВЕРКА ПОБЕДИТЕЛЯ ЧЕРЕЗ SWITCH (СРАВНИТЬ прямые и дагонали.)