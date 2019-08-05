<?php

namespace App\Contracts\Repositories;

interface CategoryRepositoryInterface
{
    /**
     * Fetch all records (enabled and disabled records)
     *
     * @param  int    $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function allRecords(int $perPage = 0, array $columns = array('*'));

    /**
     * Fetch all enabled records
     *
     * @param  int    $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function enabledRecords(int $perPage = 0, array $columns = array('*'));

}
