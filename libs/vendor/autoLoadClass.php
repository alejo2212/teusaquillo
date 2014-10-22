<?php

namespace mvc\autoload {

  include_once __DIR__ . '/configClass.php';
  include_once __DIR__ . '/../../config/config.php';
  include_once __DIR__ . '/../yaml/sfYaml.php';

  use mvc\config\configClass;
  use mvc\session\sessionClass;

  /**
   * Description of autoLoadClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class autoLoadClass {

    private static $instance;

    /**
     *
     * @return autoLoadClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    public function autoLoad() {
      $includes = \sfYaml::load(configClass::getPathAbsolute() . 'libs/vendor/loader.yml');
      foreach ($includes['mvcBasicPackage'] as $include) {
        include_once configClass::getPathAbsolute() . $include;
      }
    }

    public function loadIncludes() {
      if (($includes = sessionClass::getInstance()->getLoadFiles()) !== false) {
        foreach ($includes as $include) {
          include_once configClass::getPathAbsolute() . $include;
        }
      }
    }

  }

}