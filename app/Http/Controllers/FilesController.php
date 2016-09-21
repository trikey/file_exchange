<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Requests;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\LangMiddleware');
//        $this->middleware('auth'); // только авторизованные пользователи
//        $this->middleware('App\Http\Middleware\CanAccessMiddleware'); // только администраторы и модераторы


        $this->create_view = 'files.create';
        $this->index_view = 'folders.list';
        $this->edit_view = 'files.edit';
        $this->multi_view = 'files.multi';
        $this->item_view = 'files.big_item';

        $this->model = 'App\File';

        $this->list_page = 'folders';
    }

    public function index()
    {
        $model = $this->model;
        $files = $model::paginate($this->items_per_page);
        return view($this->index_view, compact('files'));
    }

    public function multi()
    {
        $model = $this->model;
        return view($this->multi_view);
    }

    public function multiView()
    {
        return view('files.multi_popup');
    }

    public function getModal()
    {
        return view('files.file_webix_add');
    }
    public function getModalForUpdate($id)
    {
        $class = $this->model;
        $file = $class::find($id);
        return response()->json($file);
//        return view('files.file_webix_update', compact('file'));
    }

    public function multiHandle(Request $request)
    {
        $model = $this->model;
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            if ($request->file('file')->isValid())
            {
                $file = $request->file('file');
                $fileName = sha1(time().time().rand(1, 9999)).".".$file->getClientOriginalExtension();
                $path = '/uploads/'.sha1(time().rand(1, 9999)).'/';
                $file->move(public_path().$path, $fileName);
                $data['path'] = $path . $fileName;
                $data['name'] = $fileName;
                $data['description'] = $fileName;

                $file = new $model($data);
                $file->save();
                echo $file->id;
            }
        }
    }


    public function store(FileRequest $request)
    {
        $model = $this->model;
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            if ($request->file('file')->isValid())
            {
                $file = $request->file('file');
                $fileName = sha1(time().time()).".".$file->getClientOriginalExtension();
                $path = '/uploads/'.sha1(time()).'/';
                $file->move(public_path().$path, $fileName);
                $data['path'] = $path . $fileName;
                $data['name'] = $fileName;
            }
        }
        $file = new $model($data);
        $file->save();
        return trans('files.file_uploaded');
//        return redirect($this->list_page);
    }


    public function update($id, FileRequest $request)
    {
        $model = $this->model;
        $data = $request->all();
        $object = $model::findOrFail($id);
        unset($data['name']);
        $fileChanged = false;
        if ($request->hasFile('file'))
        {
            if ($request->file('file')->isValid())
            {
                $file = $request->file('file');
                $fileName = sha1(time().time()).".".$file->getClientOriginalExtension();
                $path = '/uploads/'.sha1(time()).'/';
                $file->move(public_path().$path, $fileName);
                $data['path'] = $path . $fileName;
                $data['name'] = $fileName;
                $fileChanged = true;
                $target = public_path(). $object->path;
                if (file_exists($target)) {
                    $dirname = dirname($target);
                    unlink( $target );
                    rmdir( $dirname );
                }
            }
        }
        $object->update($data);
        $file = $object;
        if ($fileChanged) {
            return trans('files.file_updated');
        }
        return response()->json($file);
//        return view($this->item_view, compact('file'));
//        return redirect($this->list_page);
    }

    public function edit($id)
    {
        $model = $this->model;
        $file = $model::find($id);
        return view($this->edit_view, compact('file'));
    }

    public function download($id)
    {
        $class = $this->model;
        $object = $class::find($id)->toArray();
        return response()->download(public_path().$object['path']);
    }

    public function getInfo ($id) {
        $model = $this->model;
        $file = $model::find($id);
        return response()->json($file);
//        return view('files.info', compact('file'));
    }
}
