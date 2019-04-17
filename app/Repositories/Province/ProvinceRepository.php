<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\Province;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\Province;
use Illuminate\Support\Str;
class ProvinceRepository extends RepositoryAbstract implements ProvinceRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Province $province)
    {
        parent::__construct();
        $this->model = $province;
        $this->table = 'provinces';
    }

    /**
     * Get all province.
     *
     * @param $filter
     * @return array object
     */
    public function all()
    {
        $provinces = $this->model->all();
        return $provinces;
    }


}