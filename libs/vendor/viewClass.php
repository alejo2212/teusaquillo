<?php

namespace mvc\view {

  use mvc\config\configClass;
  use mvc\session\sessionClass;

  /**
   * Description of viewClass - vyo͞o
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class viewClass {
    
    static public function includeHandlerMessage() {
      include_once configClass::getPathAbsolute() . 'libs/view/handlerMessage.php';
    }
    
    static public function includePartial($partial) {
      include_once configClass::getPathAbsolute() . 'view/' . $partial . '.php';
    }

    static public function genMetas() {
      $module = sessionClass::getInstance()->getModule();
      $action = sessionClass::getInstance()->getAction();
      $metas = '';
      $includes = \sfYaml::load(configClass::getPathAbsolute() . 'config/view.yml');
      foreach ($includes['all']['meta'] as $include) {
        $metas .= '<meta' . $include . '>';
      }
      if (isset($includes[$module][$action]['meta'])) {
        foreach ($includes[$module][$action]['meta'] as $include) {
          $metas .= '<meta' . $include . '>';
        }
      }
      return $metas;
    }
    
    static public function genStylesheet() {
      $module = sessionClass::getInstance()->getModule();
      $action = sessionClass::getInstance()->getAction();
      $stylesheet = '';
      $includes = \sfYaml::load(configClass::getPathAbsolute() . 'config/view.yml');
      foreach ($includes['all']['stylesheet'] as $include) {
        $stylesheet .= '<link rel="stylesheet" href="' . configClass::getUrlBase() . 'css/' . $include .  '">';
      }
      if (isset($includes[$module][$action]['stylesheet'])) {
        foreach ($includes[$module][$action]['stylesheet'] as $include) {
          $stylesheet .= '<link rel="stylesheet" href="' . configClass::getUrlBase() . 'css/' . $include .  '">';
        }
      }
      return $stylesheet;
    }
    
    static public function genJavascript() {
      $module = sessionClass::getInstance()->getModule();
      $action = sessionClass::getInstance()->getAction();
      $javascript = '';
      $includes = \sfYaml::load(configClass::getPathAbsolute() . 'config/view.yml');
      foreach ($includes['all']['javascript'] as $include) {
        $javascript .= '<script src="' . configClass::getUrlBase() . 'js/' . $include .  '"></script>';
      }
      if (isset($includes[$module][$action]['javascript'])) {
        foreach ($includes[$module][$action]['javascript'] as $include) {
          $javascript .= '<script src="' . configClass::getUrlBase() . 'js/' . $include .  '"></script>';
        }
      }
      return $javascript;
    }

    static public function renderHTML($module, $template, $typeRender, $arg = array()) {
      if (isset($module) and isset($template)) {
        if (count($arg) > 0) {
          extract($arg);
        }
        switch ($typeRender) {
          case 'html':
            header(configClass::getHeaderHtml());
            include_once configClass::getPathAbsolute() . 'libs/vendor/view/head.php';
            include_once configClass::getPathAbsolute() . "view/$module/$template.html.php";
            include_once configClass::getPathAbsolute() . 'libs/vendor/view/foot.php';
            break;
          case 'json':
            header(configClass::getHeaderJson());
            include_once ConfigClass::PATH . "view/$module/$template.json.php";
            break;
          case 'pdf':
            header(configClass::getHeaderPdf());
            include_once ConfigClass::PATH . "view/$module/$template.pdf.php";
            break;
          case 'javascript':
            header(configClass::getHeaderJavascript());
            include_once ConfigClass::PATH . "view/$module/$template.js.php";
            break;
          case 'xml':
            header(configClass::getHeaderXml());
            include_once ConfigClass::PATH . "view/$module/$template.xml.php";
            break;
          case 'excel2003':
            header(configClass::getHeaderExcel2003());
            include_once ConfigClass::PATH . "view/$module/$template.xls.php";
            break;
          case 'excel2007':
            header(configClass::getHeaderExcel2007());
            include_once ConfigClass::PATH . "view/$module/$template.xlsx.php";
            break;
        }
      }
    }

  }

}