<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class Event
 * @package App\Models
 * @version January 6, 2025, 8:12 pm +06
 *
 * @property string $title
 * @property string $photo
 * @property string $link
 * @property string $status
 */
class Event extends Model
{


    public $table = 'events';
    



    public $fillable = [
        'title',
        'photo',
        'link',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'photo' => 'string',
        'link' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'photo' => 'required',
        'link' => 'required'
    ];

    
}
