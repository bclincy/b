<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/18/18
 * Time: 9:32 AM
 */

namespace app\Error;


class APIExceptions extends \Exception
{



    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function restErrors($msg)
    {
        switch ($msg['code']) {
            case 400:
                $data = ['msg' => 'Bad Request, check data'];
                break;
            case 401:
                $data = ['msg' => 'Unauthorized please check your credentials', 'code' => 401];
                break;
            case 404:
                $data = ['msg' => 'The Resources requested does not exists', 'code' => 404];
                break;
            case 402:
                $data = ['msg' => 'Parameters were valid but the request failed', 'code' => 402];
                break;
            case 429:
                $data = ['msg' => 'Too many request hit the API in concession', 'code' => 429];
                break;
            case 500:
                $data = ['msg' => 'Internal Server error our side is down', 'code' => 500];
                break;
            default:
                $data['msg'] = 'System is currently down please try again later';
        }
        $data['error'] = $msg['error'];
        $data['status'] = 'Failed';
        $data['details'] = $this->error;

        return array_filter($data);
    }

    public function customFunction() {
        echo "A custom function for this type of exception\n";
    }
}