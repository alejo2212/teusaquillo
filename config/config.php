<?php

use mvc\config\configClass;

configClass::setDbHost('127.0.0.1');
configClass::setDbDriver('pgsql'); // mysql
configClass::setDbName('teusaquillo');
configClass::setDbPort(5432); // 3306
configClass::setDbUser('postgres');
configClass::setDbPassword('root');
configClass::setDbDsn(
        configClass::getDbDriver()
        . ':host=' . configClass::getDbHost()
        . ';port=' . configClass::getDbPort()
        . ';dbname=' . configClass::getDbName()
);

configClass::setPathAbsolute('C:/wamp/www/teusaquillo/');
configClass::setUrlBase('http://127.0.0.1/teusaquillo/web/');

configClass::setScope('dev'); // prod
configClass::setDefaultCulture('es');
configClass::setIndexFile('index.php');

configClass::setFormatTimestamp('Y-m-d H:i:s');

configClass::setHeaderJson('Content-Type: application/json; charset=utf-8');
configClass::setHeaderXml('Content-Type: application/xml; charset=utf-8');
configClass::setHeaderHtml('Content-Type: text/html; charset=utf-8');
configClass::setHeaderPdf('Content-type: application/pdf; charset=utf-8');
configClass::setHeaderJavascript('Content-Type: text/javascript; charset=utf-8');
configClass::setHeaderExcel2003('Content-Type: application/vnd.ms-excel; charset=utf-8');
configClass::setHeaderExcel2007('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');

configClass::setCookieNameRememberMe('mvcSiteRememberMe');
configClass::setCookieNameSite('mvcSite');
configClass::setCookiePath('/teusaquillo/web/' . configClass::getIndexFile());
configClass::setCookieDomain('http://127.0.0.1');
configClass::setCookieTime(3600); // una hora en segundo

// configClass::setDefaultModuleSecurity('default');
// configClass::setDefaultActionSecurity('index');