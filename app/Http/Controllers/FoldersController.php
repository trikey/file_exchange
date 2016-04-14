<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use App\Http\Requests;

class FoldersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // только авторизованные пользователи
        $this->middleware('App\Http\Middleware\CanAccessMiddleware'); // только администраторы и модераторы


        $this->create_view = 'folders.create';
        $this->index_view = 'folders.list';
        $this->edit_view = 'folders.edit';
        $this->item_view = 'folders.webix_item';

        $this->model = 'App\Folder';

        $this->list_page = 'folders';
    }

    public function index()
    {
        $model = $this->model;
        $folders = $model::FindRootFolders()->get();
        $parentFolder = 'NULL';
        $breadcrumbs = [];
        $files = \App\File::FindFilesByFolderId(0)->get();
        return view($this->index_view, compact('folders', 'parentFolder', 'breadcrumbs', 'files'));
    }

    public function viewFolder($id)
    {
        $model = $this->model;
        $folders = $model::FindChildrenFolders($id)->get();
        $parentFolder = $id;
        $folder = $model::find($id);
        $breadcrumbs = $model::getParent($id, [['id' => $folder->id, 'name' => $folder->name, 'url' => $folder->url]]);

        $files = \App\File::FindFilesByFolderId($id)->get();
        return view($this->index_view, compact('folders', 'parentFolder', 'breadcrumbs', 'files'));
    }

    public function getTree()
    {
        $model = new $this->model();
        try {
            $allSubCategories = $model->getFolders();
        } catch (Exception $e) {
            dd("error");
        }
        $arr = $allSubCategories->toArray();
        array_unshift($arr, ["id" => 0, "text" => "Корень"]);
        return json_encode($arr);
    }


    public function store(FolderRequest $request)
    {
        $model = $this->model;
        $folder = new $model($request->all());
        $folder->save();
        return view($this->item_view, compact('folder'));

//        return redirect($this->list_page);
    }


    public function update($id, FolderRequest $request)
    {
        $model = $this->model;
        $folder = $model::findOrFail($id);

        $folder->update($request->all());
        return view($this->item_view, compact('folder'));
//        return redirect($this->list_page);
    }

    public function edit($id)
    {
        $model = $this->model;
        $folder = $model::find($id);
        return view($this->edit_view, compact('folder'));
    }


    public function search(Request $request)
    {
        $model = $this->model;
        $search = $request->get('query');
        $folders = [];
        $parentFolder = 'NULL';
        $breadcrumbs = [['name' => 'Результаты поиска']];
        $folders = $model::FindRootFolders()->get();
        $files = \App\File::FindFilesByFolderId(0)->get();

        if (strlen($search) > 0) {
            $model = $this->model;
            $folders = [];
            $parentFolder = 'NULL';
            $breadcrumbs = [['name' => 'Результаты поиска']];

            $files = \App\File::FindFilesByDescription($search)->get();
            $folders = $model::FindFoldersByDescription($search)->get();
            return view($this->index_view, compact('folders', 'parentFolder', 'breadcrumbs', 'files', 'search'));
        }
        return view($this->index_view, compact('folders', 'parentFolder', 'breadcrumbs', 'files', 'search'));

    }
}
