<?php

namespace App\Bases;

use App\Http\Controllers\Controller;
use App\Services\MenuService;

class BaseModule extends Controller
{
    public $module;

    protected function serveView($data = [], $viewBlade = 'index', $currentUrl = null, $pageTitle = null)
    {
        $breadcrumb = $this->getBreadcrumb($currentUrl);

        view()->share([
            'route_group' => $this->getRouteGroup(),
            'module' => $this->getModuleName(),
            'breadcrumb' => !empty($breadcrumb['breadcrumb']) ? $breadcrumb['breadcrumb'] : [],
            'pageTitle' => (empty($breadcrumb['title']) ? ($this->pageTitle ?? '-') : $breadcrumb['title']),
            'currentUrl' => !empty($breadcrumb['currenturl']) ? $breadcrumb['currenturl'] : [],
            'menus' => MenuService::generateMenu()
        ]);

        $view = view(implode('.', array_filter(['pages', $this->module, $viewBlade])), $data);

        return $view;
    }

    protected function getRouteGroup()
    {
        return request()->getHost() == config('domain.admin') ? 'admin.' : 'app.';
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

    // response validaton
    protected function serveValidations($validation)
    {
        return response()->json([
            'code' => 422,
            'status' => 'fail',
            'message' => _('errors.442'),
            'data' => $validation
        ], 422);
    }

    // return Json Inputan
    protected function serveJSON($data, $code = 200, $status = 'success', $message = 'OK')
    {
        $output = $data;

        if (is_array($data)) {
            $output = [
                'code' => isset($data['code']) ? $data['code'] : $code,
                'status' => isset($data['status']) ? $data['status'] : $status,
                'message' => isset($data['message']) ? $data['message'] : $message,
                'data' => isset($data['data']) ? $data['data'] : NULL,
            ];

            // extend data table responses
            if (isset($data['draw']))
                $output['draw'] = $data['draw'];

            if (isset($data['recordsTotal']))
                $output['recordsTotal'] = $data['recordsTotal'];

            if (isset($data['recordsFiltered']))
                $output['recordsFiltered'] = $data['recordsFiltered'];
        }

        return response()->json($output, $code);
    }
}
