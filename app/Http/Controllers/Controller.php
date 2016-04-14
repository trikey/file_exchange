<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $create_view;
    protected $index_view;
    protected $edit_view;

    protected $model;

    protected $list_page;

    protected $items_per_page = 10;

    public function create()
    {
        return view($this->create_view);
    }

    public function destroy($id)
    {
        $class = $this->model;
        $object = $class::find($id);
        $object->delete();
        return redirect($this->list_page);
    }

}
