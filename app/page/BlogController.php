<?php
namespace app\page;

use compact\mvvm\impl\ViewModel;
use compact\Context;
use classes\NestedView;
use compact\handler\impl\http\HttpStatus;
use compact\filesystem\exceptions\FileNotFoundException;

class BlogController
{

    /**
     * Show a list of posts on screen
     *
     * @return \classes\NestedView The layout
     */
    public function index()
    {
        return new NestedView(new ViewModel('blog/layout/index.html', array(
            'pagetitle' => 'Elger van Boxtel\'s Personal Blog'
        )), new ViewModel('blog/layout/header.html'), new ViewModel('blog/index.html'));
    }

    /**
     * Show a blog post on screen
     *
     * @param string $item
     *            the title of the post. This must resemble the filename in /view/blog/items/$item.html
     *            
     * @return \classes\NestedView The layout
     */
    public function post($item)
    {
        try {
            return new NestedView(
                new ViewModel('blog/layout/index.html', array('pagetitle' => ucfirst(strtolower(str_replace('-', ' ', $item))))),
                new ViewModel('blog/layout/header.html'), 
                new ViewModel('blog/items/' . $item . '.html'));
        } catch (FileNotFoundException $e) {
            // template could not be found, return a 404
            return new HttpStatus(404, 404);
        }
    }
}
