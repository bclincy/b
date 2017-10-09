<?php

require_once('../classes/Authorization/UserAuthString.php');

$request = new UserAuthString;

echo UserAuthString::encryptStr('hello world');
