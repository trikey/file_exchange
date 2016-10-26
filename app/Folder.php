<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Folder extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'path', 'created_by', 'modified_by', 'parent_id', 'text'
    ];

    protected $appends = ['text', 'type', 'url', 'count'];


    public static function boot()
    {
        parent::boot();

        static::deleted(function($table)
        {
            if (strlen($table->path) > 0) {
                $target = public_path(). $table->path;
                if (file_exists($target)) {
                    $dirname = dirname($target);
                    unlink( $target );
                    rmdir( $dirname );
                }
            }
            foreach($table->childrenFiles as $child)
            {
                $child->delete(); // Causes any child "deleted" events to be called
            }
            foreach($table->children as $child)
            {
                $child->delete(); // Causes any child "deleted" events to be called
            }
        });
    }

    public function getCountAttribute()
    {
        $folders = self::getCategoryChildrenIdsForParentId($this->attributes['id']);
        $folders[$this->attributes['id']] = $this->attributes['id'];
        return \App\File::whereIn('folder_id', $folders)->count();
    }

    public function getTypeAttribute()
    {
        return $this->attributes['type'] = trans('messages.folder');
    }

    public function getUrlAttribute()
    {
        return $this->attributes['url'] = $this->attributes['id'];
    }

    public function getTextAttribute()
    {
        return $this->attributes['text'] = $this->attributes['name'];
    }

    public function scopeFindRootFolders($query)
    {
        return $query->where('parent_id', '=', 0);

    }

    public function scopeFindChildrenFolders($query, $parentId, $sort = 'name')
    {
        return $query->where('parent_id', '=', $parentId)->orderBy($sort, 'asc');
    }

    public function scopeFindFoldersByDescription($query, $description)
    {
        return $query->where('name', 'like', '%'.$description.'%');
    }

    public function parent()
    {
        return $this->belongsTo('App\Folder', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Folder', 'parent_id');
    }


    public function childrenFiles()
    {
        return $this->hasMany('App\File', 'folder_id');
    }

    public function getFolders()
    {
        $folders = \App\Folder::where('parent_id', '=', 0)->get();
        $folders = $this->addRelation($folders);
        return $folders;
    }

    protected function selectChild($id)
    {
        $folders = \App\Folder::where('parent_id', $id)->get();
        $folders = $this->addRelation($folders);
        return $folders;
    }

    protected function addRelation($folders)
    {
        $folders->map(function ($item, $key)
        {
            $sub = $this->selectChild($item->id);
            $res = $sub->all();
            if (!empty($res)) {
                $item = array_add($item, 'nodes', $sub);
            }
            return $item;
        });
        return $folders;
    }

    public function getChildrenFoldersByParentId($id)
    {
        $folders = \App\Folder::where('parent_id', '=', $id)->get();
        $folders = $this->addRelation($folders);
        return $folders;
    }


    public function getParentFoldersByChildId($id)
    {
        $folders = \App\Folder::where('id', '=', $id)->get();
        $folders = $this->addRelation($folders);
        return $folders;
    }

    public static function getParent($id, $folders = [])
    {
        $folder = \App\Folder::find($id);
        while($folder->parent_id != 0)
        {
            $id = $folder->parent_id;
            $folder = \App\Folder::find($id);

            array_unshift($folders, ['name' => $folder->name, 'id' => $folder->id, 'url' => $folder->url]);
            self::getParent($id, $folders);
        }
        return $folders;
    }

    public static function getPath($id, $array = [])
    {
        $folder = \App\Folder::find($id);
        $array[] = $folder->name;
        while($folder->parent_id != 0)
        {
            $id = $folder->parent_id;
            $folder = \App\Folder::find($id);
            $array[] = $folder->name;
            self::getPath($id, $array);
        }
        return $_SERVER["DOCUMENT_ROOT"].'/download' . '/'.implode('/',array_reverse($array));
    }

    public static function getParentForMkdir($id, $folders = [])
    {
        $folderings = \App\Folder::where('parent_id', '=', $id)->get();
//        if ($folderings->count() > 0) {
            foreach($folderings as $folder)
            {
//                array_unshift($folders, ['name' => $folder->name, 'id' => $folder->id, 'url' => $folder->url, 'path' => self::getPath($folder->id)]);
                $folders[$folder->id] = ['name' => $folder->name, 'id' => $folder->id, 'url' => $folder->url, 'path' => self::getPath($folder->id)];

                self::getParentForMkdir($folder->id, $folders);
            }
//        }
        return $folders;
    }


    public static function getCategoryTreeForParentId($id, &$folders = [])
    {
        $folderings = \App\Folder::where('parent_id', '=', $id)->get();
        foreach ($folderings as $folder)
        {
            $folders[$folder->id] = ['name' => $folder->name, 'id' => $folder->id, 'url' => $folder->url, 'path' => self::getPath($folder->id)];
            self::getCategoryTreeForParentId($folder['id'], $folders);
        }
        return $folders;
    }

    public static function getCategoryChildrenIdsForParentId($id, &$folders = [])
    {
        $folderings = \App\Folder::where('parent_id', '=', $id)->get();
        foreach ($folderings as $folder)
        {
            $folders[$folder->id] = [$folder->id];
            self::getCategoryChildrenIdsForParentId($folder['id'], $folders);
        }
        return $folders;
    }

}
