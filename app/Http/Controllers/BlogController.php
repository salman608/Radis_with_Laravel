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


    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        Blog::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $blogs = collect(json_decode(Redis::get('blogs')));
        $blog = $blogs->where('id', $id)->first();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $index = $blogs->search($blog);
        $blogs[$index] = $blog;

        Redis::set('blogs', json_encode($blogs));
        return redirect()->route('blogs');
    }
}
