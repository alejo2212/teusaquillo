<?php

namespace mvc\session {

  use mvc\interfaces\sessionInterface;

  /**
   * Description of sessionClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class sessionClass implements sessionInterface {
    
    private static $instance;

    /**
     * 
     * @return sessionClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    public function getAction() {
      return ($this->hasFlash('mvcAction')) ? $this->getFlash('mvcAction') : false;
    }

    public function getAttribute($attribute) {
      return (isset($_SESSION[$attribute])) ? $_SESSION[$attribute] : false;
    }
    
    public function getCredentials() {
      return ($this->hasAttribute('mvcCredentials')) ? $this->getAttribute('mvcCredentials') : false;
    }

    public function getFlash($flash) {
      return (isset($GLOBALS[$flash])) ? $GLOBALS[$flash] : false;
    }

    public function getModule() {
      return ($this->hasFlash('mvcModule')) ? $this->getFlash('mvcModule') : false;
    }

    public function hasAttribute($attribute) {
      return isset($_SESSION[$attribute]);
    }

    public function hasCredential($credential) {
      if ($this->hasAttribute('mvcCredentials')) {
        return isset($this->getAttribute('mvcCredentials')[$credential]);
      }
      return false;
    }

    public function hasFlash($flash) {
      return isset($GLOBALS[$flash]);
    }

    public function isUserAuthenticated() {
      return $this->getAttribute('mvcUserAuthenticate');
    }

    public function setAction($action) {
      $this->setFlash('mvcAction', $action);
    }

    public function setAttribute($attribute, $value) {
      $_SESSION[$attribute] = $value;
    }

    public function setUserAuthenticate($authenticate) {
      $this->setAttribute('mvcUserAuthenticate', $authenticate);
    }

    public function setCredential($credential) {
      $_SESSION['mvcCredentials'][] = $credential;
    }
    
    public function setCredentials($credentials) {
      $this->setAttribute('mvcCredentials', $credentials);
    }

    public function setFlash($flash, $value) {
      $GLOBALS[$flash] = $value;
    }

    public function setModule($module) {
      $this->setFlash('mvcModule', $module);
    }
    
    public function getFormatOutput() {
      return $this->getFlash('mvcFormatOutput');
    }
    
    public function setFormatOutput($format_output) {
      return $this->setFlash('mvcFormatOutput', $format_output);
    }
    
    public function getLoadFiles() {
      return $this->getFlash('mvcLoadFiles');
    }
    
    public function setLoadFiles($load_files) {
      return $this->setFlash('mvcLoadFiles', $load_files);
    }

    /**
     * 
     * @return array from Exception|PDOException
     */
    public function getError() {
      $answer = $_SESSION['mvcError'];
      unset($_SESSION['mvcError']);
      return $answer;
    }

    /**
     * 
     * @return array
     */
    public function getInformation() {
      $answer = $_SESSION['mvcInformation'];
      unset($_SESSION['mvcInformation']);
      return $answer;
    }

    /**
     * 
     * @return array
     */
    public function getSuccess() {
      $answer = $_SESSION['mvcSuccess'];
      unset($_SESSION['mvcSuccess']);
      return $answer;
    }

    /**
     * 
     * @return array
     */
    public function getWarning() {
      $answer = $_SESSION['mvcWarning'];
      unset($_SESSION['mvcWarning']);
      return $answer;
    }

    /**
     * 
     * @param Exception|PDOException $error
     */
    public function setError($error) {
      $_SESSION['mvcError'][] = $error;
    }

    /**
     * 
     * @param string $information
     */
    public function setInformation($information) {
      $_SESSION['mvcInformation'][] = $information;
    }

    /**
     * 
     * @param string $success
     */
    public function setSuccess($success) {
      $_SESSION['mvcSuccess'][] = $success;
    }

    /**
     * 
     * @param string $warning
     */
    public function setWarning($warning) {
      $_SESSION['mvcWarning'][] = $warning;
    }

    public function getFirstCall() {
      return $this->getAttribute('mvcFirstCall');
    }

    public function setFirstCall($first_call) {
      $this->setAttribute('mvcFirstCall', $first_call);
    }
    
    public function hasFirstCall() {
      return $this->hasAttribute('mvcFirstCall');
    }

    public function getUserId() {
      return $this->getAttribute('mvcUserId');
    }

    public function getUserName() {
      return $this->getAttribute('mvcUserName');
    }

    public function setUserId($id) {
      $this->setAttribute('mvcUserId', $id);
    }

    public function setUserName($name_user) {
      $this->setAttribute('mvcUserName', $name_user);
    }

  }

}