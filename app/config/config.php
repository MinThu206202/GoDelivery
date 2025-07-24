<?php 

//call and assign database connection
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','godelivery');

//Define App Root
define('APPROOT',dirname(dirname(__FILE__)));

//Define URL Root
define('URLROOT', 'http://localhost/Delivery');

//Define SITENAME
define('SITENAME','GODELIVERY');
define('ADMIN' , 'Admin');
define('AGENT', 'Agent');
define('ADMIN_ROLE', 1);
define('AGENT_ROLE', 2);