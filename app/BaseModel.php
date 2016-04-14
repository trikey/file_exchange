<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function boot()
    {
        parent::boot();

        // create a event to happen on saving
        static::saving(function($table)  {
            if ($table->created_by == 0) {
                $table->created_by = Auth::user()->id;
            }
            $table->modified_by = Auth::user()->id;
        });

    }

}
