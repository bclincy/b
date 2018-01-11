<?php

namespace app\Authorization;
/**
 * Encryption and Decryption of Strings
 * @author Brian Clincy
 */

class Encryptor
{
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
     * @param string $str
     * @param string $key
     * @param string $mac_algorithm
     * @param string $enc_algorithm
     * @param string $enc_mode
     * @return string/boolean
     */
    private static function decrypt ($str, $key, $mac_algorithm = 'sha1', $enc_algorithm = MCRYPT_RIJNDAEL_256, $enc_mode = MCRYPT_MODE_CBC)
    {
        $str = base64_decode($str);
        $iv_size = mcrypt_get_iv_size($enc_algorithm, $enc_mode);
        $iv_dec = substr($str, 0, $iv_size);
        $str = substr($str, $iv_size);
        $str = mcrypt_decrypt($enc_algorithm, $key, $str, $enc_mode, $iv_dec);
        $mac_block_size = ceil(self::getMacAlgoBlockSize($mac_algorithm) / 8);
        $mac_dec = substr($str, 0, $mac_block_size);
        $str = substr($str, $mac_block_size);
        if (empty($str)) {
            $str = false;
        }

        return $str;
    }

    /**
     * @param string $str
     * @param string $key
     * @param string $mac_algorithm
     * @param string $enc_algorithm
     * @param string $enc_mode
     * @return string
     */
    private static function encrypt ($str, $key, $mac_algorithm = 'sha1', $enc_algorithm = MCRYPT_RIJNDAEL_256, $enc_mode = MCRYPT_MODE_CBC)
    {
        $mac = hash_hmac($mac_algorithm, $str, $key, true);
        $mac = substr($mac, 0, ceil(self::getMacAlgoBlockSize($mac_algorithm) / 8));
        $str = $mac . $str;
        $iv_size = mcrypt_get_iv_size($enc_algorithm, $enc_mode);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $ciphertext = mcrypt_encrypt($enc_algorithm, $key, $str, $enc_mode, $iv);

        return base64_encode($iv . $ciphertext);
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
        $unencodeStr = base64_decode($encodedStr);
        if (is_string($unencodeStr)) {
            $strandKey= explode(':', $unencodeStr);
            //backwards compatable with passwords that weren't encypted by the service
            count($strandKey) == 1 ? $decrypted = $unencodeStr : $decrypted = static::decrypt(trim($strandKey[0]), trim($strandKey[1]));
        } else {
            $decrypted = $encodedStr;
        }

        return base64_decode($decrypted);
    }

}
