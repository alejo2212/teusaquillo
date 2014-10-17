<?php

namespace mvc\routing {

  use mvc\interfaces\routingInterface;
  use mvc\session\sessionClass;
  use mvc\request\requestClass;
  use mvc\dispatch\dispatchClass;
  use mvc\config\configClass;
  use mvc\i18n\i18nClass;

  /**
   * Description of routingClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class routingClass implements routingInterface {

    private static $instance;

    /**
     *
     * @return routingClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * $module = '@default_index';
     * o
     * $module = 'default'; $action = 'index';
     *
     * @param string $module
     * @param string $action [optional]
     * @return array
     */
    public function validateRouting($module, $action = null) {
      $yamlRouting = \sfYaml::load(configClass::getPathAbsolute() . 'config/routing.yml');
      if (preg_match('/^@/', $module) === 1 and $action === null) {
        if (!isset($yamlRouting[$module])) {
          throw new Exception('La ruta "' . $module . '" no está definida');
        } else {
          $answer = $yamlRouting[$module];
        }
      } else {
        $flag = true;
        foreach ($yamlRouting as $routing) {
          if ($routing['param']['module'] === $module and $routing['param']['action'] === $action) {
            $flag = false;
            $answer = $routing;
            break;
          }
        }
        if ($flag === true) {
          throw new Exception('El módulo "' . $module . '" y acción "' . $action . '"no está definido');
        }
      }
      return $answer;
    }

    /**
     * $module = '@default_index';
     * $action = array('id' => 12);
     * o
     * $module = 'default'; $action = 'index';
     *
     * @param string $module
     * @param string|array $action [optional]
     * @param array $variables [optional]
     */
    public function forward($module, $action = null, $variables = null) {
      if (preg_match('/^@/', $module) === 1) {
        $routing = $this->validateRouting($module);
        $module = $routing['param']['module'];
        $variables = $action;
        $action = $routing['param']['action'];
      } else {
        $routing = $this->validateRouting($module, $action);
      }
      sessionClass::getInstance()->setModule($module);
      sessionClass::getInstance()->setAction($action);
      requestClass::getInstance()->addParamGet($variables);
      dispatchClass::getInstance()->main();
      exit();
    }

    public function getUlrCss($css) {
      return configClass::getUrlBase() . 'css/' . $css;
    }

    public function getUlrImg($image) {
      return configClass::getUrlBase() . 'img/' . $image;
    }

    public function getUlrJs($javascript) {
      return configClass::getUrlBase() . 'js/' . $javascript;
    }

    /**
     * $module = '@default_index';
     * $action = array('id' => 12);
     * o
     * $module = 'default'; $action = 'index';
     *
     * $variabls = array('id' => 12);
     * @param string $module
     * @param string|array $action [optional]
     * @param array $variables [optional]
     */
    public function getUlrWeb($module, $action = null, $variables = null) {
      if (preg_match('/^@/', $module) === 1) {
        $routing = $this->validateRouting($module);
        $module = $routing['param']['module'];
        $variables = $this->genVariables($action);
        $action = $routing['param']['action'];
      } else {
        $routing = $this->validateRouting($module, $action);
      }
      return configClass::getUrlBase() . configClass::getIndexFile() . '/' . $module . '/' . $action . $this->genVariables($variables);
    }

    /**
     * $module = '@default_index';
     * $action = array('id' => 12);
     * o
     * $module = 'default'; $action = 'index';
     *
     * $variabls = array('id' => 12);
     * @param string $module
     * @param string|array $action [optional]
     * @param array $variables [optional]
     */
    public function redirect($module, $action = null, $variables = null) {
      if (preg_match('/^@/', $module) === 1 and $action === null) {
        header('Location: ' . $this->getUlrWeb($module, $action));
      } else {
        header('Location: ' . $this->getUlrWeb($module, $action, $variables));
      }
    }

    public function registerModuleAndAction() {
      if (requestClass::getInstance()->hasServer('PATH_INFO')) {
        $data = explode('/', requestClass::getInstance()->getServer('PATH_INFO'));
        if (($data[0] === '' and ! isset($data[1])) or ( $data[0] === '' and $data[1] === '')) {
          $this->registerDefaultModuleAndAction();
        } else {
          $url = '/^(';
          foreach ($data as $key => $value) {
            $url .= (($value === '' and $key === 0)) ? '' : $value;
            $url .= (isset($data[($key + 1)])) ? '\/' : '';
          }
          $url .= ')/';
          $yamlRouting = \sfYaml::load(configClass::getPathAbsolute() . 'config/routing.yml');
          $flag = false;
          foreach ($yamlRouting as $routing) {
            if (preg_match($url, $routing['url']) === 1) {
              sessionClass::getInstance()->setModule($routing['param']['module']);
              sessionClass::getInstance()->setAction($routing['param']['action']);
              sessionClass::getInstance()->setLoadFiles(((isset($routing['load'])) ? $routing['load'] : null));
              sessionClass::getInstance()->setFormatOutput($routing['param']['format']);
              $flag = true;
              break;
            }
          }
          if ($flag === false) {
            throw new \Exception(i18nClass::__(00002, null, 'errors'),00002);
          }
          return true;
        }
      } else {
        $this->registerDefaultModuleAndAction();
      }
    }

    private function registerDefaultModuleAndAction() {
      $yamlRouting = \sfYaml::load(configClass::getPathAbsolute() . 'config/routing.yml');
      sessionClass::getInstance()->setModule($yamlRouting['homepage']['param']['module']);
      sessionClass::getInstance()->setAction($yamlRouting['homepage']['param']['action']);
      sessionClass::getInstance()->setLoadFiles(((isset($yamlRouting['homepage']['load'])) ? $yamlRouting['homepage']['load'] : false));
      sessionClass::getInstance()->setFormatOutput($yamlRouting['homepage']['param']['format']);
    }

    /**
     *
     * @param array $variables
     * @return boolean|string
     */
    private function genVariables($variables) {
      $answer = false;
      if (is_array($variables)) {
        $answer = '?';
        foreach ($variables as $key => $value) {
          $answer .= $key . '=' . $value . '&';
        }
        $answer = substr($answer, (strlen($answer) - 1), 1);
      }
      return $answer;
    }

  }

}