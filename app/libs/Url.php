<?php

namespace Adso\libs;

class Url
{
    public static function getUrl()
    {
         /** 
         * Método
         * 
         * Valida si existe un parámetro url en la URL de la solicitud para luego mediante la función rtrim eliminar los / del final de la cadena, luego con la función filter_var se eliminan los símbolos o elementos no válidos de la URL, luego con la función explode se divide LA URL en partes, finalmente se retorna la valiable $url.
         * 
         * @access public
         * @param string $url almacena la url
         * @param 
        */

        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}