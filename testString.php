<?php

NNutsrequire_once('services/Authorization/Encryptor.php');
$request = new \app\Authorization\Encryptor();

echo $request->encryptStr('hello world');
