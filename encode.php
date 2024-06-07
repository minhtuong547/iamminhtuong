<?php

$url = "https://sieutuoiteen.com/";

for ($i = 1; $i <= 100; $i++) {
    $url = base64_encode($url);
}

echo $url;

?>
