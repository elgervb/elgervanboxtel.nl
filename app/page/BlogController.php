<?php
namespace app\page;

use compact\mvvm\impl\ViewModel;
use compact\Context;
use classes\NestedView;

class BlogController 
{
    /**
     * Show a list of posts on screen
     * 
     * @return \classes\NestedView The layout
     */
    public function index(){

        return new NestedView(
            new ViewModel('blog/layout/index.html', array('pagetitle'=>'Elger van Boxtel\'s Personal Blog')),
            new ViewModel('blog/layout/header.html'),  
            new ViewModel('blog/index.html') 
        );
    }
    
    /**
     * Show a blog post on screen
     * 
     * @param string $item the title of the post. This must resemble the filename in /view/blog/items/$item.html
     * 
     * @return \classes\NestedView The layout
     */
    public function post($item){
        return new NestedView(
            new ViewModel('blog/layout/index.html', array('pagetitle'=>ucfirst(strtolower(str_replace('-', ' ', $item))))),
            new ViewModel('blog/layout/header.html'),
            new ViewModel('blog/items/'.$item.'.html')
        );
    }
}
