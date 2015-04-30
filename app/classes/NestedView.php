<?php
namespace classes;

use compact\mvvm\IView;

class NestedView implements IView
{
    private $mainView;
    private $views;
    
    public function __construct( $views )
    {
    	$this->views = new \ArrayObject();
    	
    	$args = func_get_args();
    	$this->mainView =  array_shift($args);
    	foreach ($args as $arg){
    	    if ($arg instanceof IView){
    	        $this->add($arg);
    	    }
    	}
    }

    public function add(IView $view){
        $this->views->append($view);
        return $this;
    }
    
    public function render()
    {
    	$result = "";
    	foreach ($this->views as $view){
    	    $result .= $view->render();
    	}
    	$this->mainView->{"body"} = $result;
    	return $this->mainView->render();
    }
}