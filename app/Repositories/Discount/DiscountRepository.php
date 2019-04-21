<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\Discount;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\Discount;

class DiscountRepository extends RepositoryAbstract implements DiscountRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Discount $discount)
    {
        parent::__construct();
        $this->model = $discount;
        $this->table = 'discounts';
    }

    /**
     * Get list discount.
     *
     * @param $filter
     * @return array object
     */
    public function getDiscounts($request)
    {
        $discounts = $this->model->orderBy('id', 'desc');

        if (!empty($request['search'])) {
            $discounts = $discounts->where(function ($query) use ($request){
                $query->where('name', 'LIKE', '%' . $request['search'] . '%')
                        ->orWhere('code', 'LIKE', '%' . $request['search'] . '%');
            });
        }

        //tim kiem theo loai khuyen mai
        if (!empty($request['typeBy'])) {
            if($request['typeBy'] !=0 )
                $discounts = $discounts->where('type_by', $request['typeBy']);
        }

        //tim kiem theo thoi gian bat dau
        if(!empty($request['start'])) {
            $startTemp = \DateTime::createFromFormat('d/m/Y',$request['start']);
            $discounts = $discounts->where('start', '>=',$startTemp->format('Y-m-d 00:00:00'));
        }

        //tim kiem theo thoi gian ket thuc
        if(!empty($request['end'])) {
            $startTemp = \DateTime::createFromFormat('d/m/Y',$request['end']);
            $discounts = $discounts->where('end', '<=',$startTemp->format('Y-m-d 00:00:00'));
        }

        $per = isset($request['per']) ? $request['per'] : 10;
        return $discounts->paginate($per)->appends($request);
    }

    /**
     * Get discount by id.
     *
     * @param $id
     * @return object
     */
    public function getDiscountById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy discount.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $discount = $this->model->find($id);
        if (!empty($discount)) {
            return $discount->delete();
        }
        return false;
    }

    /**
     * Store discount.
     *
     * @param array $request
     * @return bool|void
     */
    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->code = 'KM' . time();
        $start = \DateTime::createFromFormat("d/m/Y", $request->start);
        $this->model->start = $start->format('Y-m-d 00:00:00');
        $end = \DateTime::createFromFormat("d/m/Y", $request->end);
        $this->model->end = $end->format('Y-m-d 00:00:00');
        $this->model->discount = str_replace('.', '', $this->model->discount);
        $this->model->limit = str_replace('.', '', $this->model->limit);
        return $this->model->save();
    }

    /**
     * Update discount.
     *
     * @param array|int $request
     * @param array $id
     * @return void
     */
    public function update($request, $id)
    {
        $discount = $this->model->find($id);
        if (!empty($discount)) {
            $discount->fill($request->all());
            $start = \DateTime::createFromFormat("d/m/Y", $request->start);
            $discount->start = $start->format('Y-m-d 00:00:00');
            $end = \DateTime::createFromFormat("d/m/Y", $request->end);
            $discount->end = $end->format('Y-m-d 00:00:00');
            $discount->discount = str_replace('.', '', $discount->discount);
            $discount->limit = str_replace('.', '', $discount->limit);
            return $discount->save();
        }
        return false;
    }

    public function getDiscountsAvailable($type_by=0,$discountId = null)
    {
       $discounts =  $this->model->where('start','<=',date('Y-m-d H:i:s'))->where('end','>=',date('Y-m-d H:i:s'));
       if ($type_by != 0) {
           $discounts = $discounts->where('type_by',$type_by);
       }
       if (!empty($discountId)) {
           $discounts = $discounts->orWhere('id',$discountId);
       }
       return $discounts->get();

    }

}