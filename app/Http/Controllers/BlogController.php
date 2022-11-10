<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BlogController extends Controller
{
    public function blogs()
    {
        $time_start = microtime(true);
        $cacheBlog = Redis::get('blogs');

        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);

        if (isset($cacheBlog)) {
            $blogs = json_decode($cacheBlog);
            return view('blog.index', compact('blogs', 'execution_time'));
        } else {
            $time_start = microtime(true);
            $blogs = Blog::all();
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start);
            Redis::set('blogs', json_encode($blogs));
            return view('blog.index', compact('blogs', 'execution_time'));
        }
    }
}
