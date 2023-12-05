<?php

namespace Adso\libs;

class Helper
{
    // Constructor de la clase Helper
    function __construct()
    {
    }

    /**
     * Cifra los datos proporcionados mediante encriptación AES-256-CBC.
     *
     * Este método encripta los datos de entrada utilizando el algoritmo de encriptación AES-256-CBC
     * y una clave maestra proporcionada. Devuelve los datos encriptados como una cadena codificada en base64
     * con un vector de inicialización (IV).
     * 
     * @param string $data Los datos que deben encriptarse.
     * @return string Los datos codificados en base64 con IV.
    */
    public static function encrypt($data)
    {
        $key = base64_decode(MASTER);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
        $string = openssl_encrypt($data, "aes-256-cbc", $key, 0, $iv);
        return base64_encode($string . "::" . base64_encode($iv));
    }

   /**
     * Descifra los datos proporcionados usando descifrado AES-256-CBC.
     *
     * Este método descifra los datos de entrada, que incluyen los datos cifrados y el IV,
     * utilizando el algoritmo de descifrado AES-256-CBC y una clave maestra proporcionada. Devuelve
     * los datos descifrados como una cadena.
     *
     * @param string $data Los datos cifrados en base64 con el IV.
     * @return string|false Los datos descifrados, o false si el descifrado falla.
     */
    public static function decrypt($data)
    {
        $key = base64_decode(MASTER);
        list($string, $iv) = array_pad(explode("::", base64_decode($data), 2), 2, null);
        return openssl_decrypt($string, "aes-256-cbc", $key, 0, base64_decode($iv));
    }

    /**
     * Comprueba los datos proporcionados utilizando HMAC-SHA512 y los trunca a 50 caracteres.
     *
     * Este método toma los datos de entrada, los hashea usando HMAC-SHA512 con una clave proporcionada,
     * y luego trunca el hash a los primeros 50 caracteres. Devuelve el hash resultante.
     *
     * @param string $datos Los datos que se van a hashear.
     * @return string El hash HMAC-SHA512 truncado (50 caracteres).
     */
    public static function encrypt2($data)
    {
        $password = hash_hmac("sha512", $data, KEY);
        $password = substr($password, 0, 50);
        return $password;
    }
}
