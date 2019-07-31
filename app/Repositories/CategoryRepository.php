<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\RepositoryInterface;

class CategoryRepository extends Repository
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Category';
    }

}
