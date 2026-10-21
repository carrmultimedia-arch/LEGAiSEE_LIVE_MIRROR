<?php
// APPLICATION
define('APPLICATION', 'Admin');

// HTTP
define('HTTP_SERVER', 'https://legaisee.com/Opencart/admin/');
define('HTTP_CATALOG', 'https://legaisee.com/Opencart/');
// DIR
define('DIR_OPENCART', '/home/carrmulti/www/www/Opencart/');
define('DIR_APPLICATION', DIR_OPENCART . 'admin/');
define('DIR_SYSTEM', DIR_OPENCART . 'system/');
define('DIR_EXTENSION', DIR_OPENCART . 'extension/');
define('DIR_IMAGE', DIR_OPENCART . 'image/');
define('DIR_STORAGE','/home/carrmulti/private/appinstall/opencart_260923071931/storage/');
define('DIR_CATALOG', DIR_OPENCART . 'catalog/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/template/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_SESSION', DIR_STORAGE . 'session/');
define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', '127.0.0.1');
define('DB_USERNAME', 'carrmulti');
define('DB_PASSWORD', 'Jmc6253277$');
define('DB_DATABASE', 'carrmulti_opencart_260923071931');
define('DB_PREFIX', 'oc_');
define('DB_PORT', '3308');

// Cache
define('CACHE_ENGINE', 'file'); // apc, file, mem, memcached or redis
//define('CACHE_HOSTNAME', 'unix:///home/user/.system/redis.sock');
//define('CACHE_PORT', 6379);
//define('CACHE_PREFIX', 'oc_cache_');
//define('CACHE_PASSWORD', 'secret');

// OpenCart API
define('OPENCART_SERVER', 'https://www.opencart.com/');