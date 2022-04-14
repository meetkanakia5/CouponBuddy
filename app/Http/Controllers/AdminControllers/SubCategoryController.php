<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubCategoryDirection;
use Auth;
use Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sub_categories'] = SubCategory::orderBy('id', 'desc')->get();
        return view('admin.pages.sub_category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::orderBy('category')->get();
        return view('admin.pages.sub_category.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateSubCategory($request);
        $this->saveSubCategory(new SubCategory, $request);
        Session::flash('created', 'Data Successfully Created');
        return redirect()->route('admin.sub-categories.index');
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
        $data['sub_category'] = SubCategory::findOrFail($id);
        $data['categories'] = Category::orderBy('category')->get();
        return view('admin.pages.sub_category.edit', $data);
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
        $this->validateSubCategory($request);
        $this->saveSubCategory(SubCategory::findOrFail($id), $request);
        Session::flash('updated', 'Data Successfully Updated');
        return redirect()->route('admin.sub-categories.index');
    }

    public function validateSubCategory($data) {
        $data->validate([
            'category_id' => 'required|max:255',
            'sub_category' => 'required|max:255',
        ]);
    }

    public function saveSubCategory($subCategory, $data) {
        $subCategory->admin_id     = Auth::user()->id;
        $subCategory->category_id  = $data->category_id;
        $subCategory->sub_category = $data->sub_category;
        $subCategory->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        Session::flash('deleted', 'Data Successfully Deleted');
        return redirect()->route('admin.sub-categories.index');
    }
}