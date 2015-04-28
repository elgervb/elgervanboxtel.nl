<?php
namespace app\page;

use compact\mvvm\impl\ViewModel;
use compact\Context;
class IndexController 
{
    private $viewModel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->viewModel = new ViewModel('index.html');
    }

    /**
     * @return \core\mvc\impl\view\ViewModel
     */
    public function index(){

        return $this->viewModel;
    }
}
