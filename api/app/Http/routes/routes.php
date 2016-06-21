<?php
$routes = [
    "index",
    "admin",
];
foreach($routes as $val) {
    require_once app_path("Http/routes/".$val."/routes.php");
}