<?php

namespace App\Repositories;

use App\Models\Cources;
use App\Repositories\BaseRepository;

/**
 * Class CourcesRepository
 * @package App\Repositories
 * @version December 18, 2024, 3:26 pm UTC
*/

class CourcesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'photo',
        'description',
        'short_description',
        'class_one_date',
        'class_one_link',
        'class_two_date',
        'class_two_link',
        'class_three_date',
        'class_three_link',
        'class_four_date',
        'class_four_link',
        'created_at',
        'updated_at'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cources::class;
    }
}
