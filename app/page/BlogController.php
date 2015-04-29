<?php
namespace app\page;

use compact\mvvm\impl\ViewModel;
use compact\Context;
use classes\NestedView;
class BlogController 
{
    /**
     * @return \core\mvc\impl\view\ViewModel
     */
    public function index(){

        return new NestedView(
            new ViewModel('blog/layout/header.html'),  
            new ViewModel('blog/index.html') 
        );
    }
    
    public function item($item){
        return new ViewModel('blog/items/'.$item.'.html');
    }
}
