<?php

namespace App\Services;

use Yajra\DataTables\Facades\DataTables;

use App\Bases\BaseServices;
use App\Models\Role as Model;
use App\Models\Menu;
use App\Models\Permission;
use App\Services\MenuService;

class RoleService extends BaseServices
{
    // public static function data($request)
    // {
    //     $query = Model::data();
    //     return DataTables::of($query)
    //         ->filter(function ($query) use ($request) {
    //             if (!empty($request->name))
    //                 $query->whereLike('name', $request->name);

    //             if (!empty(intval($request->status)))
    //                 $query->where('status', intval($request->status));
    //         })
    //         ->addColumn('id', function ($query) {
    //             return encrypt($query->id);
    //         })
    //         ->addColumn('checkbox', function ($query) {
    //             return true;
    //         })
    //         ->make(true)
    //         ->getData(true);
    // }

    // public static function store($request)
    // {
    //     $permissions = Permission::with('menus')->whereIn('id', $request->permissions)->get();

    //     return Model::transaction(function () use ($request, $permissions) {
    //         $visibilities = [];
    //         foreach ($permissions as $item) {
    //             $arrName = explode('-', $item->name);
    //             $suffix = end($arrName);
    //             if ($suffix == 'index') {
    //                 $menu = !empty($item->menus[0]) ? $item->menus[0] : null;
    //                 if ($menu != null) {
    //                     $visibilities[] = $menu->id;
    //                 }
    //             }
    //         }

    //         return Model::createOne([
    //             'code' => $request->code,
    //             'name' => $request->name,
    //             'guard_name' => 'web',
    //             'description' => $request->description,
    //             'status' => $request->status ? 1 : 0,
    //         ], function ($query, $event) use ($request, $visibilities) {
    //             $event->permissions()->attach(is_array($request->permissions) ? $request->permissions : []);
    //             $event->menus()->sync(is_array($visibilities) ? $visibilities : []);

    //             // Forgot Cache Permission
    //             app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    //         });
    //     });
    // }

    // public static function get($id = null)
    // {
    //     if (!empty($id))
    //         $query = Model::find($id);
    //     else
    //         $query = Model::all();

    //     if ($query) {
    //         return $query;
    //     }

    //     return false;
    // }

    // public static function update($id, $request)
    // {
    //     $permissions = Permission::with('menus')->whereIn('id', $request->permissions)->get();

    //     return Model::transaction(function () use ($id, $request, $permissions) {
    //         $visibilities = [];
    //         foreach ($permissions as $item) {
    //             $arrName = explode('-', $item->name);
    //             $suffix = end($arrName);
    //             if ($suffix == 'index') {
    //                 $menu = !empty($item->menus[0]) ? $item->menus[0] : null;
    //                 if ($menu != null) {
    //                     $visibilities[] = $menu->id;
    //                 }
    //             }
    //         }

    //         return Model::updateOne($id, [
    //             'code' => $request->code,
    //             'name' => $request->name,
    //             'description' => $request->description,
    //             'status' => $request->status ? 1 : 0,
    //         ], function ($query, $event, $cursor) use ($request, $visibilities) {
    //             $cursor->permissions()->sync(is_array($request->permissions) ? $request->permissions : []);
    //             $cursor->menus()->sync(is_array($visibilities) ? $visibilities : []);

    //             // Forgot Cache Permission
    //             app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    //         });
    //     });
    // }

    // public static function destroy($id)
    // {
    //     return Model::deleteOne($id);
    // }

    // public static function destroys($data)
    // {
    //     $id = [];
    //     foreach ($data->id as $value) {
    //         $id[] = decrypt($value);
    //     }

    //     return Model::transaction(function () use ($id) {
    //         return Model::deleteBatch($id);
    //     });
    // }

    // public static function getMenus($data)
    // {
    //     $cursors = Menu::orderBy('sequence')->get();
    //     $menus = [];

    //     foreach ($cursors as $cursor) {
    //         $parent_id = !empty($cursor->parent_id) ? $cursor->parent_id : 0;
    //         $menus[$parent_id][] = $cursor;
    //     }

    //     $results = count($menus) > 0 ? MenuService::parsingMenu($menus) : [];
    //     return self::outputResult($results);
    // }

    // public static function hasPermissions($id)
    // {
    //     $menu = Model::find($id);
    //     $permissions = [];
    //     if ($menu) {
    //         foreach ($menu->permissions->sortBy(function ($q) {
    //             return $q->pivot->sequence;
    //         }) as $permission) {
    //             $pivot = $permission->pivot;
    //             $permissions[] = $permission->id;
    //         }
    //     }
    //     return $permissions;
    // }

    // public static function hasVisibilities($id)
    // {
    //     $menu = Model::find($id);
    //     $visibilities = [];
    //     if ($menu) {
    //         foreach ($menu->menus as $menu) {
    //             $pivot = $menu->pivot;
    //             $visibilities[] = $menu->id;
    //         }
    //     }
    //     return $visibilities;
    // }

    // public static function dropdown($default = '')
    // {
    //     $results = [];
    //     if (!is_null($default)) {
    //         $results[''] = empty($default) ? __('Pilih') : __($default);
    //     }

    //     $cursors = Model::isActive()->get();

    //     foreach ($cursors as $cursor) {
    //         $results[$cursor->id] = $cursor->name;
    //     }

    //     return $results;
    // }
}
