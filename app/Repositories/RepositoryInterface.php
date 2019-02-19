<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get's a model by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all records.
     *
     * @return mixed
     */
    public function all();

    /**
     * Delete a record.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
