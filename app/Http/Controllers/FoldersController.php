<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use App\Http\Requests;

class FoldersController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\LangMiddleware');
        $this->middleware('auth'); // только авторизованные пользователи
        $this->middleware('App\Http\Middleware\CanAccessMiddleware'); // только администраторы и модераторы


        $this->create_view = 'folders.create';
        $this->index_view = 'folders.list';
        $this->edit_view = 'folders.edit';
        $this->item_view = 'folders.big_item';

        $this->model = 'App\Folder';

        $this->list_page = 'folders';
    }

    public function index()
    {
        return view('folders.main');
    }
    public function main()
    {
        $model = $this->model;
        $folders = $model::FindRootFolders()->get();
        return response()->json($folders);
    }

    public function viewFolder(Request $request, $id)
    {
        $model = $this->model;
        $folders = $model::FindChildrenFolders($id)->get();
        $parentFolder = $id;
        $folder = $model::find($id);
        $breadcrumbs = $model::getParent($id, [['id' => $folder->id, 'name' => $folder->name, 'url' => $folder->url]]);

        $files = \App\File::FindFilesByFolderId($id)->get();
        $sort = $request->get('sort');
        if($sort == 'type')
        {
            $files = $files->sortBy(function($file){ return $file->type; })->values();
        }

        return response()->json(['folders' => $folders, 'files' => $files, 'breadcrumbs' => $breadcrumbs]);
//        return view($this->index_view, compact('folders', 'parentFolder', 'breadcrumbs', 'files'));
    }


    public function filebox()
    {
        $folders = [];
        $breadcrumbs = [['name' => trans('menu.basket'), 'url' => 'filebox']];
        $parentFolder = '0';
        $files = [];
        $file_box = session('file_box');
        if (!empty($file_box))
        {
            $files = \App\File::whereIn('id', $file_box)->get();
        }
        return response()->json(compact('breadcrumbs', 'files'));
//        return view('folders.filebox', compact('folders', 'parentFolder', 'breadcrumbs', 'files'));
    }

    public function addToFileBox($id)
    {
        $file_box = session('file_box');
        if (is_array($file_box) && !empty($file_box))
        {
            $file_box[$id] = $id;
        }
        else
        {
            $file_box = [$id => $id];
        }
        session(['file_box' => $file_box]);
        return response()->json(['count' => count(session('file_box'))]);
//        return view('include.menu2');
    }

    public function removeFromFileBox($id)
    {
        $file_box = session('file_box');
        if (is_array($file_box) && !empty($file_box))
        {
            unset($file_box[$id]);
        }
        else
        {
            $file_box = [];
        }
        session(['file_box' => $file_box]);
        return response()->json(['count' => count(session('file_box'))]);
//        return view('include.menu2');
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
        array_unshift($arr, ["id" => 0, "text" => trans('folders.root')]);
        return json_encode($arr);
    }


    public function store(FolderRequest $request)
    {
        $model = $this->model;
        $folder = new $model($request->all());
        $folder->save();
        return response()->json($folder);
//        return view($this->item_view, compact('folder'));

//        return redirect($this->list_page);
    }


    public function update($id, FolderRequest $request)
    {
        $model = $this->model;
        $folder = $model::findOrFail($id);

        $folder->update($request->all());
        return response()->json($folder);
//        return view($this->item_view, compact('folder'));
//        return redirect($this->list_page);
    }

    public function updatePreviewPicture($id, FolderRequest $request)
    {
        $model = $this->model;
        $data = [];
        $folder = $model::findOrFail($id);
        if ($request->hasFile('file'))
        {
            if ($request->file('file')->isValid())
            {
                $file = $request->file('file');
                $fileName = sha1(time().time()).".".$file->getClientOriginalExtension();
                $path = '/uploads/'.sha1(time()).'/';
                $file->move(public_path().$path, $fileName);
                $data['path'] = $path . $fileName;
                if(strlen($folder->path) > 0)
                {
                    $target = public_path(). $folder->path;
                    if (file_exists($target)) {
                        $dirname = dirname($target);
                        unlink( $target );
                        rmdir( $dirname );
                    }
                }
                $folder->update($data);
                return trans('files.file_uploaded');
            }
        }
    }


    public function getModalForUpdate($id)
    {
        $class = $this->model;
        $folder = $class::find($id);
        return response()->json($folder);
//        return view('folders.folder_webix_update', compact('folder'));
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
        $breadcrumbs = [['name' => trans('folders.search_results')]];
        $folders = $model::FindRootFolders()->get();
        $files = \App\File::FindFilesByFolderId(0)->get();

        if (strlen($search) > 0) {
            $model = $this->model;
            $folders = [];
            $parentFolder = 'NULL';
            $breadcrumbs = [['name' => trans('folders.search_results')]];

            $files = \App\File::FindFilesByDescription($search)->get();
            $folders = $model::FindFoldersByDescription($search)->get();
            $sort = $request->get('sort');
            if($sort == 'type')
            {
                $files = $files->sortBy(function($file){ return $file->type; })->values();
            }
            return response()->json(['folders' => $folders, 'files' => $files, 'breadcrumbs' => $breadcrumbs]);
//            return view($this->index_view, compact('folders', 'parentFolder', 'breadcrumbs', 'files', 'search'));
        }
        return response()->json(['folders' => $folders, 'files' => $files, 'breadcrumbs' => $breadcrumbs]);
//        return view($this->index_view, compact('folders', 'parentFolder', 'breadcrumbs', 'files', 'search'));

    }

    public function rmkdir($path) {
        $path = str_replace("\\", "/", $path);
        $path = explode("/", $path);

        $rebuild = '';
        foreach($path AS $p) {

            if(strstr($p, ":") != false) {
                $rebuild = $p;
                continue;
            }
            $rebuild .= "/$p";
            if(!is_dir($rebuild)) mkdir($rebuild);
        }
    }

    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        $this->rrmdir($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            rmdir($dir);
        }
    }

    public function downloadAll($id)
    {
        $model = $this->model;
        $folder = $model::find($id);
        $filename_no_ext = $folder->name;
        $filename_no_ext_path = $model::getPath($folder->id);


        $folders = $model::getCategoryTreeForParentId($id);
//        $folders = $model::getParentForMkdir($id);
//        dd($folders);

        array_unshift($folders,['name' => $folder->name, 'id' => $folder->id, 'url' => $folder->url, 'path' => $model::getPath($folder->id)]);

        $folders__array = [];
        foreach($folders as $folder)
        {
            $folders__array[$folder['id']] = $folder['path'];
            $this->rmkdir($folder['path']);
        }


        foreach($folders__array as $key => $value)
        {
            $files = \App\File::FindFilesByFolderId($key)->get()->toArray();
            if (is_array($files) && !empty($files))
            {
                foreach($files as $file)
                {
                    $old_file = $_SERVER["DOCUMENT_ROOT"].$file['path'];
                    $new_file = $value.'/'.$file['description'].'.'.$file['type'];
                    copy($old_file, $new_file);
                }
            }
        }


        // get a tmp name for the .zip
//        $tmp_zip = tempnam ("tmp", "tempname") . ".zip";
        //change directory so the zip file doesnt have a tree structure in it.
        chdir($filename_no_ext_path);

        $tmp_zip ='tmp'.rand(1, 1000).'.zip';
        // zip the stuff (dir and all in there) into the tmp_zip file
        exec('zip -r '.$tmp_zip.' *');
        $filesize = filesize($tmp_zip);

        if ($filesize > 462144000)
        {
            $this->rmkdir($_SERVER["DOCUMENT_ROOT"]."/temp");
            copy($tmp_zip, $_SERVER["DOCUMENT_ROOT"]."/temp/".$tmp_zip);
            return redirect("/temp/".$tmp_zip);
//            header('Location: '.$_SERVER["DOCUMENT_ROOT"]."/temp/".$tmp_zip);
        }
        else
        {
            // we deliver a zip file
            header("Content-Type: archive/zip");
//         filename for the browser to save the zip file
            header("Content-Disposition: attachment; filename=$filename_no_ext".".zip");
            // calc the length of the zip. it is needed for the progress bar of the browser
            header("Content-Length: $filesize");
//        // deliver the zip file
            $fp = fopen("$tmp_zip","r");
            echo fpassthru($fp);
//        // clean up the tmp zip file
        }

        unlink($tmp_zip);
        $this->rrmdir($filename_no_ext_path);

    }

    public function downloadFileBox()
    {
        $file_box = session('file_box');
        if (!empty($file_box))
        {

            $filename_no_ext = 'FileBox';
            $filename_no_ext_path = $_SERVER["DOCUMENT_ROOT"]."/filebox";

            $files = \App\File::whereIn('id', $file_box)->get();
            $this->rmkdir($_SERVER["DOCUMENT_ROOT"]."/filebox");
            foreach($files as $file)
            {
                $old_file = $_SERVER["DOCUMENT_ROOT"].$file['path'];
                $new_file = $_SERVER["DOCUMENT_ROOT"]."/filebox".'/'.$file['description'].'.'.$file['type'];
                copy($old_file, $new_file);
            }


            chdir($filename_no_ext_path);

            $tmp_zip ='tmp'.rand(1, 1000).'.zip';
            // zip the stuff (dir and all in there) into the tmp_zip file
            exec('zip -r '.$tmp_zip.' *');
            $filesize = filesize($tmp_zip);

            if ($filesize > 462144000)
            {
                copy($tmp_zip, $_SERVER["DOCUMENT_ROOT"]."/temp/".$tmp_zip);
                header('Location: '.$_SERVER["DOCUMENT_ROOT"]."/temp/".$tmp_zip);
            }
            else
            {
                // we deliver a zip file
                header("Content-Type: archive/zip");
//         filename for the browser to save the zip file
                header("Content-Disposition: attachment; filename=$filename_no_ext".".zip");
                // calc the length of the zip. it is needed for the progress bar of the browser
                header("Content-Length: $filesize");
//        // deliver the zip file
                $fp = fopen("$tmp_zip","r");
                echo fpassthru($fp);
//        // clean up the tmp zip file
            }


            // we deliver a zip file
//            header("Content-Type: archive/zip");
////         filename for the browser to save the zip file
//            header("Content-Disposition: attachment; filename=$filename_no_ext".".zip");
//            // get a tmp name for the .zip
////        $tmp_zip = tempnam ("tmp", "tempname") . ".zip";
//            //change directory so the zip file doesnt have a tree structure in it.
//            chdir($filename_no_ext_path);
//            $tmp_zip ='tmp'.rand(1, 1000).'.zip';
//            // zip the stuff (dir and all in there) into the tmp_zip file
//            exec('zip -r '.$tmp_zip.' *');
//            // calc the length of the zip. it is needed for the progress bar of the browser
//            $filesize = filesize($tmp_zip);
//            header("Content-Length: $filesize");
////        // deliver the zip file
//            $fp = fopen("$tmp_zip","r");
//            echo fpassthru($fp);
////        // clean up the tmp zip file
            unlink($tmp_zip);
            $this->rrmdir($filename_no_ext_path);

        }
    }
}
