<?php

namespace App\Bases;

use App\Http\Controllers\Controller;

class BaseModule extends Controller
{
    public $module;

    protected function serveView($data = [], $viewBlade = 'index', $currentURL = null, $pageTitle = null)
    {
        $breadcrumb = $this->getBreadcrumb($currentURL);
    }

    protected function getBreadcrumb($currentURL = null)
    {
        if ($currentURL == null) {
            $currentURL = ['home'];
            if ($this->getModuleName())
                $currentURL = [$this->getModuleName() . '.index', $this->getRouteName()];
        }

        // $menu = MenuService
    }

    protected function getModuleName()
    {
        return $this->module;
    }

    protected function getRouteName()
    {
        return request()->route()->getName();
    }
}
