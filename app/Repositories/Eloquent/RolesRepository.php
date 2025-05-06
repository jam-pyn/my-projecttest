<?php

namespace App\Repositories\Eloquent;

use App\Models\Roles;
use App\Repositories\RolesRepositoryInterface;
use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

/**
 * Class RolesRepository.
 */
class RolesRepository extends BaseRepository implements RolesRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Roles $model
     */
    public function __construct(Roles $model)
    {
        parent::__construct($model);
    }
}
