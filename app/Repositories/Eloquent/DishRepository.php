<?php

namespace App\Repositories\Eloquent;

use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;
use App\Repositories\DishRepositoryInterface;
use App\Models\Dishes;

/**
 * Class DishRepository.
 */
class DishRepository extends MasterRepository implements DishRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Dishes $model
     */
    public function __construct(Dishes $model)
    {
        parent::__construct($model);
    }
}
