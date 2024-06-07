<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Models/connect.php');
reset_cookie();
header("Location: /".config_admin."/login");