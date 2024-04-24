<?php

namespace Book\Foundations\Domain\Base\Repositories\Eloquent;

use Book\Common\BaseController;
use Book\Foundations\Domain\Base\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


/**
 * A Base repository class.
 *
 * @author Nay Ba La
 * @copyright (c) 2024 All Right Reserved.
 */
class BaseRepository extends BaseController implements BaseRepositoryInterface
{

    protected $model;

    ///////////////////////////////////////////////////////////////

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    ///////////////////////////////////////////////////////////////

    public function connection($useModel = false)
    {
        if ($useModel) {
            return $this->model;
        }
        return $this->model;
    }

    ///////////////////////////////////////////////////////////////

    public function getAll($request)
    {
        if ($request === null) {
            $request = $this->connection(true)->count();
        }
        $request = (int) $request;
        $query = $this->connection(true)
            ->orderByRaw('
                CASE
                WHEN updated_at IS NULL THEN created_at
                ELSE updated_at
                END
                DESC')
            ->orderBy('idx', 'desc')
            ->paginate($request);
        if (!$query) {
            throw new QueryException("Retrieving rows was failed.", $query, [], $query);
        }
        return $query;
    }


    public function insert(array $params, $useModel = false)
    {
        $query = $this->connection($useModel)
            ->create($params);
        if (!$query) {
            throw new QueryException("Inserting a row was failed.", $query, [], $params['idx']);
        }
        return $query;
    }

    ///////////////////////////////////////////////////////////////

    public function insertGetId(array $params, $useModel = false)
    {
        $query = $this->insert($params, $useModel);
        if (!$query) {
            throw new QueryException("Inserting a row was failed.", $query, [], $params['idx']);
        }
        return $query['idx'];
    }

    ///////////////////////////////////////////////////////////////

    public function edit($id)
    {
        $query = $this->connection(true)
            ->where('idx', $id)
            ->first();
        if (!$query) {
            throw new QueryException("Editing a row was failed.", $query, [], $id);
        }
        return $query;
    }

    ///////////////////////////////////////////////////////////////

    public function update($id, array $params)
    {

        $query = $this->connection(true)
            ->where('idx', $id)
            ->update($params);
        if (!$query) {
            throw new QueryException("Updating a row was failed.", $query, [], $id);
            }
        return $query;
    }

    ///////////////////////////////////////////////////////////////

    public function delete($id)
    {
        $query = $this->connection(true)->destroy($id);
        if (!$query) {
            throw new QueryException("Deleting a row was failed.", $query, [], $id);
        }
        return $query;

    }

    ///////////////////////////////////////////////////////////////
    /**
     * Begin DB transaction.
     */
    public function beginTransaction()
    {
        DB::beginTransaction();
    }

     ///////////////////////////////////////////////////////////////
    /**
     * DB transaction rollback.
     */
    public function rollback()
    {
        DB::rollback();
    }

    ///////////////////////////////////////////////////////////////
    /**
     * DB transaction commit.
     */
    public function commit()
    {
        DB::commit();
    }
    ///////////////////////////////////////////////////////////////

}