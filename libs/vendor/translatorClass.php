<?php

namespace mvc\translator {

  /**
   * Description of translatorClass
   *
   * @author julianlasso
   */
  class translatorClass {

    private static $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    private static $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    private static $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    private static $dias = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');

    public static function translateDate($date) {
      return str_replace(self::$days, self::$dias, str_replace(self::$months, self::$meses, $date));
    }

  }

}