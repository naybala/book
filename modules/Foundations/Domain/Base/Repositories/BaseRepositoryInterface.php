<?php

namespace Book\Foundations\Domain\Base\Repositories;

/**
 * An interface for BaseRepository class.
 *
 * @author Nay Ba La
 * @copyright (c) 2024 All Right Reserved.
 */
interface BaseRepositoryInterface
{
    /**
     * Retrieve all rows.
     *
     * @param $id
     * @param array $params
     * @return mixed
     * @throws DbErrorException
     */
    public function getAll($request);

    /**
     * Creates a row.
     *
     * @param array $params
     * @param bool $useModel
     * @return mixed
     * @throws DbErrorException
     */
    public function insert(array $params, $useModel = false);

    /**
     * Creates a row and then returns a primary ID of created record.
     *
     * @param array $params
     * @param bool $useModel
     * @return mixed
     * @throws QueryException
     */
    public function insertGetId(array $params, $useModel = false);

    /**
     * edit a row that corresponds to the ID.
     *
     * @param $id
     * @return mixed
     * @throws DbErrorException
     */
    public function edit($id);

    /**
     * Updates a row that corresponds to the ID.
     *
     * @param $id
     * @param array $params
     * @return mixed
     * @throws DbErrorException
     */
    public function update($id, array $params);



    /**
     * Deletes a row that corresponds to the ID.
     *
     * @param $id
     * @return mixed
     * @throws DbErrorException
     */
    public function delete($id);

}