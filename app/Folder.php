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
        'name', 'description', 'created_by', 'modified_by', 'parent_id', 'text'
    ];

    protected $appends = ['text', 'type', 'url'];


    public static function boot()
    {
        parent::boot();

        static::deleted(function($table)
        {
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

    public function getTypeAttribute()
    {
        return $this->attributes['type'] = trans('messages.folder');
    }

    public function getUrlAttribute()
    {
        return $this->attributes['url'] = route('admin_folder_view', ['id' => $this->attributes['id']]);
    }

    public function getTextAttribute()
    {
        return $this->attributes['text'] = $this->attributes['name'];
    }

    public function scopeFindRootFolders($query)
    {
        return $query->where('parent_id', '=', 0);

    }

    public function scopeFindChildrenFolders($query, $parentId)
    {
        return $query->where('parent_id', '=', $parentId);
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

}
