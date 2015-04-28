<?php
namespace app;

use compact\IAppContext;
use compact\Context;
use compact\routing\Router;
use app\page\IndexController;
use app\page\BlogController;

class AppContext implements IAppContext
{

    public function routes(Router $router)
    {
    	$router->add("^/$", function(){
    	    $c = new IndexController();
    		return $c->index();
    	});
    	
    	$router->add("^/blog$", function(){
    		$c = new BlogController();
    		return $c->index();
    	});
    	
	    $router->add("^/blog/([a-zA-Z0-9_-]+)$", function($item){
	        $c = new BlogController();
	        return $c->item($item);
	    });
    }

    public function handlers(Context $ctx)
    {
    	
    }

    public function services(Context $ctx)
    {
    	$path = $ctx->http()->getRequest()->getPathInfo();
    	// TODO add layout service
    }
}
