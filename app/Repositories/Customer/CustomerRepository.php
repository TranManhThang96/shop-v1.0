<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\Customer;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\Customer;
use Illuminate\Support\Str;
class CustomerRepository extends RepositoryAbstract implements CustomerRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        parent::__construct();
        $this->model = $customer;
        $this->table = 'customers';
    }

    /**
     * Get list product set.
     *
     * @param $filter
     * @return array object
     */
    public function getCustomers($request)
    {
        $customers = $this->model->orderBy('id', 'desc')->with('order');

        if (!empty($request->search)) {
            $customers = $customers->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('code', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->province_id > 0) {
            $customers = $customers->where('province_id', $request->province_id);
        }

        if ($request->district_id > 0) {
            $customers = $customers->where('province_id', $request->district_id);
        }
        if ($request->ward_id > 0) {
            $customers = $customers->where('province_id', $request->ward_id);
        }
        $per = isset($request['per']) ? $request['per'] : 10;
        return $customers->paginate($per)->appends($request->all());
    }

    /**
     * Get customer by id.
     *
     * @param $id
     * @return object
     */
    public function getCustomerById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy customer.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $customer = $this->model->find($id);
        if (!empty($customer)) {
            return $customer->delete();
        }
        return false;
    }

    /**
     * Store customer.
     *
     * @param array $request
     * @return bool|void
     */
    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->code = 'KH'.time();
        $this->model->address = $request->street . ', ' . $this->model->ward->name . ', ' . $this->model->district->name . ', ' . $this->model->province->name;
        return $this->model->save();
    }

    /**
     * Update customer.
     *
     * @param array|int $request
     * @param array $id
     * @return void
     */
    public function update($request, $id)
    {
        $customer = $this->model->find($id);
        $customer->fill($request->all());
        $customer->address = $request->street . ', ' . $customer->ward->name . ', ' . $customer->district->name . ', ' . $customer->province->name;
        return $customer->save();

    }

    /**
     * Check customer exist.
     *
     * @param $name
     * @param null $customerId
     * @return bool
     */
    public function checkExist($type = 'phone',$value, $customerId = null)
    {
        $customers = $this->model->where($type,$value);
        if(!empty($customerId)) {
            $customers = $customers->where('id','<>',$customerId);
        }
        if($customers->count() > 0) {
            return false;
        }
        return true;
    }

    public function getCustomerByQuery($request)
    {
        return  $this->model->select('id','name')->where("name","LIKE","%{$request->input('query')}%")->get();
    }

}