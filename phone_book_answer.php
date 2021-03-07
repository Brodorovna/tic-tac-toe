<?php

if (
    array_key_exists("phone", $_GET) &&
    array_key_exists("Name", $_GET)
) {
    $phone = $_GET['phone'];
    $name = $_GET['Name'];
}

if (array_key_exists("next", $_GET)) {
    header('location: ' . $_GET['next'] . "phone=" . $phone . "&name=" . $name . "&save");
}
