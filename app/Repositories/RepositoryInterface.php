<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:38 AM
 */

namespace App\Repositories;
interface RepositoryInterface
{
    /**
     * Find.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Get all.
     *
     * @return Collection
     */
    public function all();

    /**
     * Check if model id is exist.
     *
     * @param int $id
     *
     * @return void
     */
    public function existValidate($id);

    /**
     * Store.
     *
     * @param array $data
     *
     * @return
     */
    public function store($data);

    /**
     * Show.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function show($id);

    /**
     * Update.
     *
     * @param int $id
     * @param array $data
     *
     * @return Model
     */
    public function update($id, $data);

    /**
     * Delete.
     *
     * @param Collection|array|int $ids
     *
     * @return int
     */
    public function destroy($ids);

    /**
     * Check exist.
     *
     * @param int $id
     *
     * @return boolean
     */
    public function exist($id);

    /**
     * Store file.
     *
     * @param string $name
     * @param string $path
     *
     * @return string
     */
    public function storeFile($name, $path);
}