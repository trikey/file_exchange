<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class File extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


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
        });
    }

    protected $fillable = [
        'name', 'description', 'path', 'folder_id', 'created_by', 'modified_by'
    ];

    protected $appends = ['type', 'url', 'size'];

    public function parent()
    {
        return $this->belongsTo('App\Folder', 'folder_id');
    }

    public function scopeFindFilesByFolderId($query, $folderId)
    {
        return $query->where('folder_id', '=', $folderId);
    }


    public function scopeFindFilesByDescription($query, $description)
    {
        return $query->where('description', 'like', '%'.$description.'%');
    }

    public function getTypeAttribute()
    {
        $this->attributes['type'] = 'Файл';
        $path = public_path().$this->attributes['path'];
        if (file_exists($path)) {
            $file = new \Symfony\Component\HttpFoundation\File\File($path);
            $this->attributes['type'] = $file->getExtension();
        }
        return $this->attributes['type'];
    }

    public function getSizeAttribute()
    {
        $this->attributes['size'] = '';
        $path = public_path().$this->attributes['path'];
        if (file_exists($path)) {
            $file = new \Symfony\Component\HttpFoundation\File\File($path);
            $this->attributes['size'] = $this->formatBytes($file->getSize(), 2);
        }
        return $this->attributes['size'];
    }

    public function getUrlAttribute()
    {
        return $this->attributes['url'] = '/';
    }

    private function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
         $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
