<?php
session_start();
session_unset();
if (isset($username)) {
    unset($username);
}
header("Location: /");
?>