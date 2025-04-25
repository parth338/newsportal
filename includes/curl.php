<?php
$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL, 'https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=c951fbf67f97460fa2621b5d2a814fa6');
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'News Portal');
$query = curl_exec($curl_handle);
curl_close($curl_handle);
?>
  <?php

    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=c951fbf67f97460fa2621b5d2a814fa6');
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'News Portal');
    $query = curl_exec($curl_handle);
    curl_close($curl_handle);

    ?>
