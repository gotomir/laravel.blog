<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::pluck('title', 'id')->all();
        $categories = Category::pluck('title', 'id')->all();
        return view('admin.posts.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable|image',
        ];

        $messages = [
            'title.required' => 'Поле "Название статьи" не заполнeно',
            'description.required' => 'Поле "Цитата" не заполнeно',
            'content.required' => 'Поле "Текст статьи" не заполнeно',
            'thumbnail.image' => 'Файл должен быть формата "img"',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $data = $request->all();
        if ($request->hasFile('thumbnail')){
            $folder = date('Y-m-d');
            $data['thumbnail'] = $request->file('thumbnail')->store("images/{$folder}");
        }

        $post = Post::create($data);
        $post->tags()->sync($request->tags);
        return redirect()->route('posts.index')->with('success', 'Статья добавлена');
    }


    public function edit($id)
    {
        $tags = Tag::pluck('title', 'id')->all();
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        return view('admin.posts.edit', compact('tags', 'categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable|image',
        ];

        $messages = [
            'title.required' => 'Поле "Название статьи" не заполнeно',
            'description.required' => 'Поле "Цитата" не заполнeно',
            'content.required' => 'Поле "Текст статьи" не заполнeно',
            'thumbnail.image' => 'Файл должен быть формата "img"',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $post = Post::find($id);
        $data = $request->all();
        if ($request->hasFile('thumbnail')){
            Storage::delete($post->thumbnail);
            $folder = date('Y-m-d');
            $data['thumbnail'] = $request->file('thumbnail')->store("images/{$folder}");
        }

        $post->update($data);
        $post->tags()->sync($request->tags);
        return redirect()->route('posts.index')->with('success', 'Статья обнволена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->sync([]);
        Storage::delete($post->thumbnail);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Вы успещно удалили статью');
    }
}
