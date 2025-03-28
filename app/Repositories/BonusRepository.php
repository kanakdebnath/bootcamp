<?php

namespace App\Repositories;

use App\Models\Bonus;
use App\Repositories\BaseRepository;

/**
 * Class BonusRepository
 * @package App\Repositories
 * @version December 27, 2024, 1:12 pm +06
*/

class BonusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'file',
        'locked'
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
        return Bonus::class;
    }
}
