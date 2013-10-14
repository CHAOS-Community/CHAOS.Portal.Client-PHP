<?php
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . "/../src"); // <-- Relative path to Portal Client
require_once("CaseSensitiveAutoload.php");
spl_autoload_extensions(".php");
spl_autoload_register("CaseSensitiveAutoload");
?>
