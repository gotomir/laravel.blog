<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
        ];

        $messages = [
            'title.required' => 'Поле "Название тега" не заполнeно',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success', 'Новый тег добавлен');
    }


    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('tag'));
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
        ];

        $messages = [
            'title.required' => 'Поле "Новое название категории" не заполнeно',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $tag = Tag::find($id);
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('success', 'Тег обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if($tag->posts->count()){
            return redirect()->route('tags.index')->with('error', 'Данный тег ипользуется для маркеровки некоторых статей');
        } else {
            $tag->delete();
            return redirect()->route('tags.index')->with('success', 'Вы успещно удалили тег');
        }

    }
}
