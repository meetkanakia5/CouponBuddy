<?php

namespace App\Http\Controllers\AdminControllers;

use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::orderBy('id', 'desc')->get();
        return view('admin.pages.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCategory($request);
        $this->saveCategory(new Category, $request);
        Session::flash('created', 'Data Successfully Created');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = Category::findOrFail($id);
        return view('admin.pages.category.edit', $data);
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
        $this->validateCategory($request);
        $this->saveCategory(Category::findOrFail($id), $request);
        Session::flash('updated', 'Data Successfully Updated');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function validateCategory($data) {
        $data->validate([
            'category' => 'required|max:20'
        ]);
    }

    public function saveCategory($category, $data) {
        $category->admin_id = Auth::user()->id;
        $category->category = $data->category;
        $category->save();
        return $category;
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('deleted', 'Data Successfully Deleted');
        return redirect()->route('admin.categories.index');
    }
}
