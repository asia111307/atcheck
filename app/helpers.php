<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function checkHoursDifference($dateStart, $dateEnd) {
    $dateStart = strtotime($dateStart);
    $dateEnd = strtotime($dateEnd);
    $diff = $dateEnd - $dateStart;
    $hours = ($diff / (60*60));
    return $hours;
}
