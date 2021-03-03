<?php
if (
    array_key_exists("phone", $_GET) &&
    array_key_exists("Name", $_GET)
) {
    $phone = $_GET['phone'];
    $name = $_GET['Name'];
}

if (array_key_exists("next", $_GET)) {
    header('location: ' . $_GET['next'] . "phone=" . $phone . "&name=" . $name);
    $phone_book = [0 => $number_line];
    $number_line = ['number' => $phone, 'name' => $name];
    file_put_contents('phone.json', json_encode($number_line));
}
