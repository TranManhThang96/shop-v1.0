<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\District;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\District;
use Illuminate\Support\Str;
class DistrictRepository extends RepositoryAbstract implements DistrictRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(District $district)
    {
        parent::__construct();
        $this->model = $district;
        $this->table = 'districts';
    }

    /**
     * Get districts by province.
     *
     * @param $filter
     * @return array object
     */
    public function getDistrictsByProvince($provinceId)
    {
        $districts = $this->model->orderBy('id', 'desc')->where('province_id', $provinceId)->get();

        return $districts;
    }

}