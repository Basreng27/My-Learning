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

    // response validaton
    protected function serveValidations($validation)
    {
        return response()->json([
            'code' => 422,
            'status' => 'unsuccessfull',
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
                'message' => isset($data['message']) ? $data['status'] : $status,
                'data' => isset($data['data']) ? $data['status'] : NULL,
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
