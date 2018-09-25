<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/17/18
 * Time: 6:41 AM
 */

namespace App\Content;


class ResumeReq extends Model
{

    private $required = [
        'name' => 'str|5',
        'email' => 'email|2'
    ];
    public function save($data)
    {

    }

    public function verifyReq ($data)
    {
        foreach ($this->required as $field => $type) {
            list($type, $len) = explode('|', $type);
        }
    }

    private function verifyData ($type, $len)
    {

    }
}