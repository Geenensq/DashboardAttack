<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

// =======================================================================================//
//        Function that allows to encrypt the password with a key store in a constant      /
// ======================================================================================//

if (!function_exists('hash_password')) {
    function hash_password($stringToCrypt)
    {
        $salt = "";
        $salted = '';
        $dx = '';
        // Salt the key(32) and iv(16) = 48
        while (strlen($salted) < 48) {
            $dx = md5($dx . SECURE_PASSPHRASE . $salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv = substr($salted, 32, 16);
        $encrypted_data = openssl_encrypt($stringToCrypt, 'aes-256-cbc', $key, true, $iv);

        return base64_encode('Salted__' . $salt . $encrypted_data);
    }

}
