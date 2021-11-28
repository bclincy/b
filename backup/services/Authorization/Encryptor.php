<?php

namespace App\Authorization;
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

    public function deepEncrypt (string $string, string $key)
    {
        $key = $this->keyLength($key);
        $encrypt = self::encrypt($key, $string);
        $firstNum = strcspn($encrypt, '0123456789');
        //Todo: update this so I can chunk it up and undo it in the undeepEncrypt function
        $encode = md5(gzdeflate(base64_encode($encrypt . ' '. time())));

        return $encode;
    }

    public function undeepEncrypt (string $encrypted, string $key)
    {
        $data = gzinflate(base64_decode($encrypted));
        list($code, $time) = explode($data,' ');
        $key = $this->keyLength($key);

        $firstNum = strcspn($encrypt, '0123456789');
        $encode = base64_encode($encrypt . ' '. time());
    }

    private function keyLength (string $key)
    {
        $padChar = strpos($key, '%') === 0 ? '-' : '%';
        $padChar = strpos($key, '-') === 0 ? '%' : '-';

        return str_pad($key, 24, $padChar);
    }

    /**
     * Encrypt a message
     *
     * @param string $message - message to encrypt
     * @param string $key - encryption key
     * @return string
     * @throws RangeException
     */
    public static function safeEncrypt(string $message, string $key): string
    {
        if (mb_strlen($key, '8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
            throw new RangeException('Key is not the correct size (must be 32 bytes).');
        }
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        $cipher = base64_encode(
            $nonce.
            sodium_crypto_secretbox(
                $message,
                $nonce,
                $key
            )
        );
        sodium_memzero($message);
        sodium_memzero($key);
        return $cipher;
    }

    /**
     * Decrypt a message
     *
     * @param string $encrypted - message encrypted with safeEncrypt()
     * @param string $key - encryption key
     * @return string
     * @throws Exception
     */
    public static function safeDecrypt(string $encrypted, string $key): string
    {
        $decoded = base64_decode($encrypted);
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

        $plain = sodium_crypto_secretbox_open(
            $ciphertext,
            $nonce,
            $key
        );
        if (!is_string($plain)) {
            throw new Exception('Invalid MAC');
        }
        sodium_memzero($ciphertext);
        sodium_memzero($key);
        return $plain;
    }
}
