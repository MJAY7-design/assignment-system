<?php

$apiKey = "AIzaSyDOe2NIh9CYzekuL62d7Q71WjNEIdzme78";

$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;

$response = file_get_contents($url);

echo "<pre>";
echo $response;
echo "</pre>";
?>