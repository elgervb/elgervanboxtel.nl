<?php
namespace app;

use compact\IAppContext;
use compact\Context;
use compact\routing\Router;
use app\page\IndexController;
use app\page\BlogController;
use compact\mvvm\impl\ViewModel;
use compact\handler\impl\http\HttpStatus;

/**
 * The Application Context for elgervanboxtel.nl
 * 
 * @author eaboxt
 */
class AppContext implements IAppContext
{

	/**
	 * (non-PHPdoc)
	 * @see \compact\IAppContext::routes()
	 */
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
	        return $c->post($item);
	    });
	    
        $router->add("^/rss/?$", function(){
            return new HttpStatus(HttpStatus::STATUS_404_NOT_FOUND, HttpStatus::STATUS_404_NOT_FOUND);
	    });
	    
	    /**
	     * Errors
	     */
	    $router->add(404, function(){
	    	return new ViewModel('404.html');
	    });
	    
    	$router->add(500, function(){
    		return new ViewModel('500.html');
    	});
    }

    /**
     * (non-PHPdoc)
     * @see \compact\IAppContext::handlers()
     */
    public function handlers(Context $ctx)
    {
    	if (!Context::get()->isLocal()){
    	// make the initial call to rewrite site url, strip off the elgervanboxtel.nl part in the path
    	Context::siteUrl(function($url){
    		return preg_replace("/(.*:\/\/.*)\/(elgervanboxtel\.nl)/i", "$1/blog", $url);
    	});
    	}
    }

    /**
     * (non-PHPdoc)
     * @see \compact\IAppContext::services()
     */
    public function services(Context $ctx)
    {
    	//
    }
}
