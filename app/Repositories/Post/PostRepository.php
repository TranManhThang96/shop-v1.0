<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\Post;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\Post;
use Illuminate\Support\Str;

class PostRepository extends RepositoryAbstract implements PostRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        parent::__construct();
        $this->model = $post;
        $this->table = 'posts';
    }

    /**
     * Get list post.
     *
     * @param $filter
     * @return array object
     */
    public function getPosts($request)
    {
        $posts = $this->model->orderBy('id', 'desc');

        if (!empty($request['search'])) {
            $posts->where('title', 'LIKE', '%' . $request['search'] . '%');
        }
        $per = isset($request['per']) ? $request['per'] : 10;
        return $posts->paginate($per)->appends($request);
    }

    /**
     * Get post by id.
     *
     * @param $id
     * @return object
     */
    public function getPostById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy post.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $post = $this->model->find($id);
        if (!empty($post)) {
            return $post->delete();
        }
        return false;
    }

    /**
     * Store post.
     *
     * @param array $request
     * @return bool|void
     */
    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->slug = Str::slug($request->title);
        return $this->model->save();
    }

    /**
     * Update post.
     *
     * @param array|int $request
     * @param array $id
     * @return void
     */
    public function update($request, $id)
    {
        $post = $this->model->find($id);
        if (!empty($post)) {
            $post->fill($request->all());
            $post->slug = Str::slug($request->title);
            return $post->save();
        }
        return false;
    }

    public function checkExist($title, $postId = null)
    {
        $posts = $this->model->where('title',$title);
        if (!empty($postId)) {
            $posts = $posts->where('id','<>',$postId);
        }
        if ($posts->count() > 0) {
            return false;
        }

        return true;
    }
}