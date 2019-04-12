<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\Supplier;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\Supplier;

class SupplierRepository extends RepositoryAbstract implements SupplierRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Supplier $supplier)
    {
        parent::__construct();
        $this->model = $supplier;
        $this->table = 'suppliers';
    }

    /**
     * Get list supplier.
     *
     * @param $filter
     * @return array object
     */
    public function getSuppliers($request)
    {
        $suppliers = $this->model->orderBy('id', 'desc')->withCount('importInvoice');

        if (!empty($request['search'])) {
            $suppliers->where('name', 'LIKE', '%' . $request['search'] . '%');
        }
        $per = isset($request['per']) ? $request['per'] : 10;
        return $suppliers->paginate($per)->appends($request);
    }

    /**
     * Get supplier by id.
     *
     * @param $id
     * @return object
     */
    public function getSupplierById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy supplier.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $supplier = $this->model->find($id);
        if (!empty($supplier)) {
            return $supplier->delete();
        }
        return false;
    }

    /**
     * Store supplier.
     *
     * @param array $request
     * @return bool|void
     */
    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->code = 'NCC'.time();
        return $this->model->save();
    }

    /**
     * Update supplier.
     *
     * @param array|int $request
     * @param array $id
     * @return void
     */
    public function update($request, $id)
    {
        $supplier = $this->model->find($id);
        if (!empty($supplier)) {
            $supplier->fill($request->all());
            return $supplier->save();
        }
        return false;
    }

    /**
     * Check exist supplier.
     *
     * @param string $type
     * @param $value
     * @param $supplierId
     * @return bool
     */
    public function checkExist($type = 'name',$value,$supplierId)
    {
        $suppliers = $this->model->where($type,$value);
        if( !empty($supplierId)) {
            $suppliers = $suppliers->where('id','<>',$supplierId);
        }
        if($suppliers->count() > 0) {
            return false;
        }
        return true;
    }
}