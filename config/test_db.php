<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases // Of course ! But for know we don't care
//$db['dsn'] = 'mysql:host=localhost;dbname=yii2_basic_tests';

return $db;
