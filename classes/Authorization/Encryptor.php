<?php

namespace app\Authorization;
/**
 * Encryption and Decryption of Strings
 * @author Brian Clincy
 */

class Encryptor
{
    public $method = 'AES-128-ECB';
    protected $key;
    /**
     * @param int $length
     * @return string
     */
    private static function randKey($length = 10)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     * @param string $algorithm
     * @return int
     */
    private static function getMacAlgoBlockSize($algorithm = 'sha1')
    {
        switch ($algorithm) {
            case 'sha1':
                $type = 160;
                break;
            default:
                $type = 0;
                break;
        }

        return $type;
    }

    /**
     * @param string $data
     * @param string $key
     * @param string $method
     * @return string/boolean
     */
    private static function decrypt ($data, $key, $method = 'AES-128-ECB')
    {
        $str = openssl_decrypt($data, $method, $key);
        if (empty($str)) {
            $str = false;
        }

        return $str;
    }

    /**
     * @param string $str
     * @param string $key
     * @param string $method
     * @return string
     */
    private static function encrypt ($str, $key, $method = 'AES-128-ECB')
    {
        $encrypt = openssl_encrypt($str, $method, $key, 0, '');

        return base64_encode($encrypt);
    }

    /**
     * @param string $str
     * @return boolean
     */
    public static function encryptStr ($str)
    {
        $keylen = [16, 24, 32];
        $key = self::randKey($keylen[array_rand($keylen, 1)]);
        $encryptedStr =  static::encrypt($str, $key);

        return base64_encode($encryptedStr . ':' . $key );
    }

    /**
     * @param string $encodedStr
     * @return string/boolean
     */
    public static function decryptStr ($encodedStr)
    {
        if ($encodedStr !== null) {

        }
        $unencodeStr = base64_decode($encodedStr);
        if (is_string($unencodeStr)) {
            $strandKey= explode(':', $unencodeStr);
            $decrypted = static::decrypt(trim($strandKey[0]), trim($strandKey[1]));
        } else {
            $decrypted = $encodedStr;
        }

        return base64_decode($decrypted);
    }

}
