<?php
$id_url = 'id.txt';
$base_url = 'base.json';
$http_url = 'http://todo.local';


header('Access-Control-Allow-Origin: ' . $http_url);
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

//reading text from http query
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $decoded_json = json_decode(file_get_contents('php://input'), true);
    $text = $decoded_json['text'];

//curl "http://scripts.local/addItem.php" -X OPTIONS -H "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:105.0) Gecko/20100101 Firefox/105.0" -H "Accept: */*" -H "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3" -H "Accept-Encoding: gzip, deflate" -H "Access-Control-Request-Method: POST" -H "Access-Control-Request-Headers: content-type" -H "Referer: http://todo.local/" -H "Origin: http://todo.local" -H "Connection: keep-alive"
//curl "http://scripts.local/addItem.php" -X POST -H "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:105.0) Gecko/20100101 Firefox/105.0" -H "Accept: */*" -H "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3" -H "Accept-Encoding: gzip, deflate" -H "Referer: http://todo.local/" -H "Content-Type: application/json;" -H "Origin: http://todo.local" -H "Connection: keep-alive" --data-raw "{""text"":""first""}"

    $id = 0;
    if ($text != null) {
        //counting id
        if (file_get_contents($id_url) != '') {
            $id = file_get_contents($id_url) + 1;
        }

        /*if (file_get_contents($base_url) == "") file_put_contents('log.txt', 'empty');
        else file_put_contents('log.txt', 'not empty');*/
        file_put_contents($id_url, $id);

        //writing item to the file
        if (file_exists($base_url) && file_get_contents($base_url) != '') {
            $base = json_decode(file_get_contents($base_url), true);
            $base['items'][sizeof($base['items'])] = array('id' => $id, 'text' => $text, 'checked' => false);
            file_put_contents($base_url, json_encode($base));
        } else {
            $base['items'][0] = array('id' => $id, 'text' => $text, 'checked' => false);
            file_put_contents($base_url, json_encode($base));
        }
    }

    $arr = array("id" => (string)$id);

    echo json_encode($arr);
}


