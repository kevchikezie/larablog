<?php

namespace App\Repositories\Eloquent;

// use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
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
     * Fetch all records (enabled and disabled records)
     *
     * @param  int    $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function allRecords(int $perPage = 0, array $columns = array('*'))
    {
        return $this->model->latest()
                    ->with([
                        'createdBy:first_name,last_name,uid',
                        'modifiedBy:first_name,last_name,uid',
                    ])
                    ->paginateOrNot($perPage, $columns);
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
     * Find a single record in the database with the option of filtering
     * the columns to be viewed
     *
     * @param  string $uid
     * @param  array $columns
     * @return mixed
     */
    public function find(string $uid, array $columns = array('*'))
    {
        return $this->model->where($this->defaultAttribute, $uid)
                    ->with([
                        'createdBy:first_name,last_name,uid',
                        'modifiedBy:first_name,last_name,uid',
                    ])
                    ->firstOrFail($columns);
    }

}
