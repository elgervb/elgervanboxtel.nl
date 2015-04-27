<?php
namespace app;

use compact\IAppContext;
use compact\Context;
use compact\routing\Router;

class AppContext implements IAppContext
{

    public function __construct()
    {
    	
    }

    public function routes(Router $router)
    {
    	$router->add("/", function(){
    		return "ROOT";
    	});
    }

    public function handlers(Context $ctx)
    {
    	
    }

    public function services(Context $ctx)
    {
    	
    }
}
