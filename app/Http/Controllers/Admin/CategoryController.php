<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'title.required' => 'Поле "Название категории" не заполнeно',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Новая категория добавлена');
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
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

        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Категория обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->posts->count()){
            return redirect()->route('categories.index')->with('error', 'Данная категория привязана к некоторым постам');
        } else {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Вы успещно удалили категорию');
        }

    }
}
