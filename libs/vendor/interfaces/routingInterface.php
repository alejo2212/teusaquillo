<?php

namespace mvc\interfaces {

  interface routingInterface {

    public function getUlrWeb($module, $action = null, $variables = null);

    public function getUlrImg($image);

    public function getUlrCss($css);

    public function getUlrJs($javascript);

    public function redirect($module, $action = null, $variables = null);

    public function forward($module, $action, $variables = null);

    public function validateRouting($routing);

    public function registerModuleAndAction();
  }

}