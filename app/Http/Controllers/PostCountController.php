<?php

namespace App\Http\Controllers;

use App\Models\PostCount;
use Illuminate\Http\Request;

class PostCountController extends Controller
{

    private $post_id;

    public function __construct(int $post_id)
    {
        $this->post_id = $post_id;
    }

    final public function postReadCount()
    {
        $countExist = PostCount::where('post_id', $this->post_id)->first();

        if ($countExist) { //update

            $post_count['count'] = $countExist->count + 1;
            $countExist->update($post_count);
        } else { //crate
            $this->storePostCount();
        }
    }

    private function storePostCount()
    {
        $post_count['count'] = 1;
        $post_count['post_id'] = $this->post_id;
        PostCount::create($post_count);
    }
}
