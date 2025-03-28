<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Cources
 * @package App\Models
 * @version December 18, 2024, 3:26 pm UTC
 *
 * @property string $title
 * @property string $photo
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class Cources extends Model
{
    use SoftDeletes;


    public $table = 'cources';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'photo',
        'description',
        'created_at',
        'updated_at',
        'short_description',
        'duration',
        'start_date',
        'price',
        'offer_price',
        'course_type',
        'class_one_date',
        'class_one_link',
        'class_two_date',
        'class_two_link',
        'class_three_date',
        'class_three_link',
        'class_four_date',
        'class_four_link'
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
        'short_description' => 'string',
        'class_one_date' => 'date',
        'class_one_link' => 'string',
        'class_two_date' => 'date',
        'class_two_link' => 'string',
        'class_three_date' => 'date',
        'class_three_link' => 'string',
        'class_four_date' => 'date',
        'class_four_link' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
    ];

    
}
