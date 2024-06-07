<big>Các file nghi ngờ</big>

<?php

$saif = shell_exec(' grep -Ril "curl\|wget\|aHR0\|shell_exec" ');

echo "<pre>$saif</pre>";

?>