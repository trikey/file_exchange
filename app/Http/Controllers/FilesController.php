<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Requests;

class FilesController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth'); // только авторизованные пользователи
//        $this->middleware('App\Http\Middleware\CanAccessMiddleware'); // только администраторы и модераторы


        $this->create_view = 'files.create';
        $this->index_view = 'folders.list';
        $this->edit_view = 'files.edit';
        $this->multi_view = 'files.multi';
        $this->item_view = 'files.webix_item';

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

    public function getModal()
    {
        return view('files.file_webix_add');
    }

    public function multiHandle(Request $request)
    {
        dd($request->allFiles());
        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $file->move(public_path().'/uploads/'.sha1(time()).'/', sha1(time().time()).".".$file->getClientOriginalExtension());
        }
//        $input = Input::all();
//        $rules = array(
//            'file' => 'image|max:3000',
//        );

//        $validation = Validator::make($input, $rules);
//
//        if ($validation->fails())
//        {
//            return Response::make($validation->errors->first(), 400);
//        }


//        $file = Input::file('file');
//
//        $extension = File::extension($file['name']);
//        $directory = path('public').'uploads/'.sha1(time());
//        $filename = sha1(time().time()).".{$extension}";
//
//        $upload_success = Input::upload('file', $directory, $filename);
//
//        if( $upload_success ) {
//            return Response::json('success', 200);
//        } else {
//            return Response::json('error', 400);
//        }
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
        return 'Файл загружен';
//        return redirect($this->list_page);
    }


    public function update($id, FileRequest $request)
    {
        $model = $this->model;
        $data = $request->all();
        $file = $model::findOrFail($id);
        unset($data['name']);
        $file->update($data);
        return view($this->item_view, compact('file'));
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
}
