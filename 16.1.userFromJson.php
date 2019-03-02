<?php 
/**
 * 1. Есть файл user.json: 
 * {
 *     "firstName" : "Иван",
 *     "lastName" : "Иванов",
 *     "address":{
 *         "country" : "Украина",
 *         "city" : "Харьков",
 *         "homeNumber" : 22
 *     },
 *     "phoneNumbers" : [
 *         "+380 66 12 34 567",
 *         "+380 98 88 88 868"
 *     ]
 * }
 * Необходимо вывести полную информацию о пользователе.
 */

$fileName = 'user.json';

function showArrayItems($array, $tab = '')
{
    foreach ($array as $key => $item) {
        if (is_array($item)) {
            echo "$tab <b>$key</b>: <br>";
            showArrayItems($item, $tab . '&nbsp;&nbsp;&nbsp;');
            continue;
        }
        echo "$tab <b>$key</b>: $item <br>";
    }
}

try {
    if (!file_exists($fileName)) {
        throw new Exception("ERROR: file $fileName not found!");
    } 
    
    $user = json_decode(file_get_contents($fileName), true);
    
    if ($user === null) {
        throw new Exception("ERROR: file $fileName does not contain JSON-string or JSON-string broken!");
    }

    showArrayItems($user);

} catch (Exception $err) {
    echo $err->getMessage();
    echo " in line " . $err->getLine();
}
