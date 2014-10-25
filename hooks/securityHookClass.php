<?php

namespace hook\security {

  use mvc\interfaces\hookInterface;
  use mvc\session\sessionClass;
  use mvc\config\configClass;
  use mvc\request\requestClass;
  use mvc\i18n\i18nClass;

  /**
   * Description of securityHookClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class securityHookClass implements hookInterface {

    private static function firstCall() {
      // se verifica que sea primera ves que entra al sistema
      if (sessionClass::getInstance()->getFirstCall() === true) {
        // como es la priemra ves que entran al sistema, entonces cambio el modo a falso
        sessionClass::getInstance()->setFirstCall(false);
        // verifico si existe una cookie para recordar el inicio de sesión el usuario entrante
        self::verifyCookieRememberMe();
      }
    }

    private static function verifyCookieRememberMe() {
      // Si existe la cookie con el nombre para recordar el inicio de sesión (verifico)
      if (requestClass::getInstance()->hasCookie(configClass::getCookieNameRememberMe())) {
        // borro las sesiones abiertas que estén registradas en base de datos con un tiempo mayor a 8 días
        //----\sesionTableClass::clearSessions();
        // entonces verifico que se encuentre en base de datos y guardo el resultado
        if (($user = \sesionTableClass::getUserAndPassword(requestClass::getInstance()->getServer('REMOTE_ADDR'), requestClass::getInstance()->getCookie(configClass::getCookieNameRememberMe()))) !== false) {
          // en caso de que esté en la base de datos, esto quiere decir que hay un inicio de sesión
          // recordado y hay que iniciar sesión en el servidor
          $usuario = \usuarioTableClass::USER;
          $password = \usuarioTableClass::PASSWORD;
          self::login($user->$usuario, $user->$password, false);
        }
      }
    }

    public static function login($user, $password, $encript = true) {
      // si $encript es false, entonces no encriptamos la contraseña de acceso
      $password = ($encript === true) ? md5($password) : $password;
      // si el usuario y contraseña existen en la base de datos, son almacenados en vairable
      if (($userData = \usuarioTableClass::checkUserAndPassword($user, $password)) !== false) {
        // iniciamos sesión y cargamos las variables de sesión con los datos necesarios y credenciales
        sessionClass::getInstance()->setUserAuthenticate(true);
        $id = \usuarioTableClass::ID;
        $usuario = \usuarioTableClass::USER;
        $credencial = \credencialTableClass::NOMBRE;
        sessionClass::getInstance()->setUserId($userData[0]->$id);
        sessionClass::getInstance()->setUserName($userData[0]->$usuario);
        foreach ($userData as $data) {
          sessionClass::getInstance()->setCredential($data->$credencial);
        }
        // si han enviado info por el metodo POST y remember_me existe
        if (requestClass::getInstance()->isMethod('POST') and requestClass::getInstance()->hasPost('remember_me')) {
          // validamos el remember_me
          self::checkRememberMe();
        }
      } else {
        // error en caso de que el usuario y contraseña no existan en base de datos
        throw new Exception(i18nClass::__(00003, null, 'errors'), 00003);
      }
    }

    private static function checkRememberMe() {
      // si remember_me es verdadero o vale uno (1)
      if (requestClass::getInstance()->getPost('remember_me') === 1) {
        // insertamos en la tabla sesion los datos correspondientes
        $data = array(
          \sesionTableClass::USUARIO_ID => sessionClass::getInstance()->getUserId(),
          \sesionTableClass::IP_ADDRESS => requestClass::getInstance()->getServer('REMOTE_ADDR'),
          \sesionTableClass::HASH_COOKIE => md5(sessionClass::getInstance()->getUserId() . sessionClass::getInstance()->getUserName() . requestClass::getInstance()->getServer('REMOTE_ADDR') . date(configClass::getFormatTimestamp()))
        );
        \sesionTableClass::insert($data);
        // Enviamos la cookie correspondiente
        setcookie(configClass::getCookieNameRememberMe(), $data[\sesionTableClass::HASH_COOKIE], time() + configClass::getCookieTime(), configClass::getCookiePath());
      }
    }

    public static function hook() {

      // Se ejecuta solo cuando se entra por primera ves al sistema y
      // la sesión aun no contiene nada de nada con respecto al usuario que está entrando
      self::firstCall();
      
      $module = sessionClass::getInstance()->getModule();
      $action = sessionClass::getInstance()->getAction();
      
      
      
      
      



      // creo el nombre de la variable para extraer sus credenciales y solicitud de seguridad
      // configurados en securityAndCredentialsConfigClass
      //$controller_method = $GLOBALS['target']['controller'] . '_' . $GLOBALS['target']['method'];
      $controller_method = sessionClass::getInstance()->getModule() . '_' . sessionClass::getInstance()->getAction();

      // si es la primera entrada al sistema, es decir
      // si recien abren el navegador y entran al sistema
      if (sessionClass::getInstance()->getFirstCall() === true) {

        // cambiamos el estado de la primera llamada en el sistema
        sessionClass::getInstance()->setFirstCall(false);

        //sessionClass::getInstance()->hasCookie(configClass::getCookieNameRememberMe());
        // confirmamos la existencia de la cookie de recordar
        if (isset($_COOKIE[\Narum\Config\ConfigClass::COOKIE_NAME]) === true) {

          // Incluimos la clase de la tabla recordar_me
          include_once \Narum\Config\ConfigClass::PATH . '/model/base/recordarMeBaseTableClass.php';
          include_once \Narum\Config\ConfigClass::PATH . '/model/recordarMeTableClass.php';

          // Obtenemos usuario y contraseña
          $arrDataUser = RecordarMeTableClass::getUserAndPassword($_SERVER['REMOTE_ADDR'], $_COOKIE[\Narum\Config\ConfigClass::COOKIE_NAME]);

          if ($arrDataUser !== false) {

            // incluimos el controlador de la seguridad
            include_once \Narum\Config\ConfigClass::PATH . '/controller/security/securityClass.php';

            // llamamos el método login para poder inicar el proceso de identificación
            $objSecurity = new \SecurityClass();
            $objSecurity->login($arrDataUser['user'], $arrDataUser['password']);
          }
        }
      }

      // verificar si el controllador_metodo requiere de seguridad detectando que esté
      // registrado en securityAndCredentialsConfigClass
      if (isset(\Narum\Config\SecurityAndCredentials\SecurityAndCredentialsConfigClass::$$controller_method) === true) {

        // pasamos el array a una variable para poder acceder a sus posiciones asociativas
        $arrSecurityAndCredentials = \Narum\Config\SecurityAndCredentials\SecurityAndCredentialsConfigClass::$$controller_method;

        // Si el módulo pide seguridad y no estan autenticados entonces
        // se solicita que se autentique
        if ($arrSecurityAndCredentials['security'] === true and $_SESSION['user']['authenticated'] === false) {

          // asigno el nuevo controlador y método a ejecutar para solicitar usuario y contraseña
          $GLOBALS['target']['controller'] = \Narum\Config\ConfigClass::SECURITY_CONTROLLER_MODULE;
          $GLOBALS['target']['method'] = \Narum\Config\ConfigClass::SECURITY_METHOD_ACTION;

          // guardamos la dirección solicitada inicialmente
          $_SESSION['target']['request'] = $_SERVER['REQUEST_URI'];

          // Si piden seguridad y está autenticado entonces hay que evaluar las credenciales o permisos
        } else if ($arrSecurityAndCredentials['security'] === true and $_SESSION['user']['authenticated'] === true) {

          // si hay credenciales en el AND entonces evaluamos
          if (count($arrSecurityAndCredentials['and']) > 0) {

            // Iniciamos la bandera de AND en verdadero
            $banderaAND = true;

            // recorremos los permisos en AND verificando que cumpla con todos los permisos
            // indicados, con uno que falle no podrá tener accesos a la acción
            foreach ($arrSecurityAndCredentials['and'] as $key => $value) {

              // buscamos que el permiso configurado se encuentre en el los permisos del usuario
              if (!in_array($value, $_SESSION['user']['credentials']) === true) {

                // en caso de que no haya un permiso, entonces la bandera cambia a falso
                $banderaAND = false;

                // paramos el foreach ya que no es necesario continuar si encontramos un false
                break;
              }
            }

            // en caso de que la bandera sea false, entonces creamos una excepción
            if ($banderaAND === false) {
              throw new \Exception('Error!! no tienes los permisos necesarios para hacer uso de esta acción AND');
            }
          }

          // Si hay credenciaes en el OR entonces evaluamos
          if (count($arrSecurityAndCredentials['or']) > 0) {

            // Iniciamos la bandera de OR en falso
            $banderaOR = false;

            // recorremos los permisos en OR verificando que cumpla con todos uno de los permisos
            // indicados, con uno que encuentre podrá tener accesos a la acción
            foreach ($arrSecurityAndCredentials['or'] as $key => $value) {

              // buscamos que el permiso configurado se encuentre en el los permisos del usuario para no cambiar el valor de true
              // que está en $banderaOR por defecto
              if (in_array($value, $_SESSION['user']['credentials']) === true) {

                // en caso de que haya un permiso, entonces la bandera cambia a true
                $banderaOR = true;

                // paramos el foreach ya que no es necesario continuar si encontramos un true
                break;
              }
            }

            // en caso de que la bandera sea false, entonces creamos una excepción
            if ($banderaOR === false) {
              throw new \Exception('Error!! no tienes los permisos necesarios para hacer uso de esta acción OR');
            }
          }
        }
      }
    }

  }

}