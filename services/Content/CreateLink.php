<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/2/18
 * Time: 3:58 PM
 */

namespace app\Content;


use app\Authorization\Encryptor;

/**
 * Class CreateLink a with details and ez url
 * @package app\Content
 */

class CreateLink
{
    private $frmData;


    private function processData (array $form)
    {
        $new = Encryptor::encryptStr(json_encode($form));
    }



}