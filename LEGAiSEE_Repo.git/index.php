<?php
$url = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$url = rtrim($url, "/");
$url = escapeshellarg($url);
?>
<pre>
This is a GIT repository. You can clone it by the following command:

git clone <?=htmlspecialchars($url)?>
</pre>
