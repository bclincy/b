<?php

require_once('classes/Authorization/Encryptor.php');
$request = new \app\Authorization\Encryptor();

echo $request->encryptStr('hello world');
