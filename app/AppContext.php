<?php
namespace app;

use compact\IAppContext;
use compact\Context;
use compact\routing\Router;
use app\page\IndexController;
use app\page\BlogController;
use compact\mvvm\impl\ViewModel;

class AppContext implements IAppContext
{

    public function routes(Router $router)
    {
    	$router->add("^/$", function(){
    	    $c = new BlogController();
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
	    
	    
	    /**
	     * Errors
	     */
	    $router->add(404, function(){
	    	return new ViewModel('404.html');
	    });
    }

    public function handlers(Context $ctx)
    {
    	// make the initial call to rewrite site url, strip off the elgervanboxtel.nl part in the path
    	Context::siteUrl(function($url){
    		return preg_replace("/(.*:\/\/.*)\/(elgervanboxtel\.nl)/i", "$1/blog", $url);
    	});
    }

    public function services(Context $ctx)
    {
    	$path = $ctx->http()->getRequest()->getPathInfo();
    	// TODO add layout service
    }
}
