<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class Bonus
 * @package App\Models
 * @version December 27, 2024, 1:12 pm +06
 *
 * @property string $Name
 * @property string $file
 */
class Bonus extends Model
{


    public $table = 'bonuses';
    



    public $fillable = [
        'name',
        'file',
        'locked'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'locked' => 'string',
        'file' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
