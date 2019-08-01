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

    /**
     * Fetch all enabled records
     *
     * @param  int    $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function enabledRecords(int $perPage = 0, array $columns = array('*'))
    {
        return $this->model->enabled()->paginateOrNot($perPage, $columns);
    }

    /**
     * Fetch all disabled records
     *
     * @param  int    $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function disabledRecords(int $perPage = 0, array $columns = array('*'))
    {
        return $this->model->disabled()->paginateOrNot($perPage, $columns);
    }

}
