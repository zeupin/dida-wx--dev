<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files must retain the above copyright notice.
 */
require __DIR__ . "/../src/Dida/Wx/Curl.php";

$curl = new Dida\Wx\Curl();
$result = $curl->request([
    "url" => "https://www.ulooknz.com",
]);
var_dump($result);