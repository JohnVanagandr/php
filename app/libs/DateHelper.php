<?php

namespace Adso\libs;

use Carbon\Carbon;
use DateTimeZone;
use PSpell\Config;

/**
 * La clase DateHelper proporciona funciones para trabajar con fechas y horas.
 */
class DateHelper {

    /**
     * Convierte una fecha en un formato corto personalizado y la devuelve.
     *
     * @param string $date La fecha que se desea formatear (en formato ISO 8601).
     * @return string La fecha en el formato personalizado "D/MM/Y".
     */

    public static function shortDate($date = "") {
        $carbon = new Carbon();

        $fecha = Carbon::parse($date)->locale('es');
        return $fecha->isoFormat("D/MM/Y");
    }

    /**
     * Calcula la diferencia en segundos entre la hora proporcionada y la hora actual en Bogotá.
     *
     * @param string $hora La hora que se desea comparar (en formato ISO 8601).
     * @return int La diferencia en segundos entre las dos horas.
     */
    public static function timestamp($hora) {
        $fecha = Carbon::now('America/Bogota');
        $diff = $fecha->diffInSeconds($hora);
        return $diff;
    }
}