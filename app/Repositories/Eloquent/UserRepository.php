<?php

namespace App\Repositories\Eloquent;

use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;

/**
 * Class UserRepository.
 */
class UserRepository extends MasterRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


}
