<?php
;
class template{
    private $template;
    private $vars=[];

    public function __construct($template){
    $this->template=$template;
    }
//whehe we want get propirty from private class we can not get 
// so we most get from vars
    public function __get($key){
     return $this->vars[$key];
    }
// when we will put propirty in class not exist 
// invlold the set and put the propirty in vars
    public function __set($name,$value)
    {
      $this->vars[$name]=$value;
    }
    // whene echo template 
    public function __toString()
    {
       extract($this->vars);
       chdir(dirname($this->template));
       ob_start();
       include basename($this->template);
       return ob_get_clean(); 
    }
}