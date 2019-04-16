<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\Ward;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\Ward;
use Illuminate\Support\Str;
class WardRepository extends RepositoryAbstract implements WardRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Ward $ward)
    {
        parent::__construct();
        $this->model = $ward;
        $this->table = 'wards';
    }

    /**
     * Get wards by district.
     *
     * @param $filter
     * @return array object
     */
    public function getWardsByDistrict($districtId)
    {
        $wards = $this->model->orderBy('id', 'desc')->where('district_id',$districtId)->get();

        return $wards;
    }
}