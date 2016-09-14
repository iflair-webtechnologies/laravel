<?php

namespace Villato\Http\Controllers\Admin;

use Villato\Http\Controllers\Controller;
use yajra\Datatables\Datatables;

class CrudController extends Controller
{

    protected function redirectWithMessage($route, $type, $message)
    {
        return redirect()->route($route)->with('message', [
            'type' => $type,
            'content' => $message
        ]);
    }

    protected function redirectError($route, $message)
    {
        return $this->redirectWithMessage($route, 'alert', $message);
    }

    protected function redirectSuccess($route, $message)
    {
        return $this->redirectWithMessage($route, 'success', $message);
    }

    protected function redirectWarning($route, $message)
    {
        return $this->redirectWithMessage($route, 'warning', $message);
    }

    protected function createCrudDataTable($items, $destroyRoute, $editRoute)
    {
        return Datatables::of($items)
            ->addColumn('action', function ($item) use($destroyRoute, $editRoute) {
                return view('admin.includes.actions',[
                    'destroyUrl' => route($destroyRoute, $item->id),
                    'editUrl' => route($editRoute, $item->id)
                ])->render();
            })->editColumn('updated_at', '{!! $updated_at->diffForHumans() !!}');
    }

}