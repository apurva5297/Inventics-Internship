<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $name=($request->searchC) ? $request->searchC : '';
        $description=($request->searchD) ? $request->searchD : '';
        $categories=Category::search('name',$name)
        ->search('description',$description)
        ->orderBy('name','ASC')->paginate(10);
        return view('Category.index',compact('categories','name','description'))
        ;
    }
    public function deleted()
    {
        $categories=Category::orderBy('name','ASC')->onlyTrashed()->paginate(10);
        return view('Category.deleted_index')
        ->withCategories($categories)
        ;
    }
    public function create()
    {
        return view('Category.create');
    }
    public function store(Request $request)
    {
        $category= new Category;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
       $category=Category::find($id);
       return view('Category.edit')->withCategory($category);
    }
    public function update(Request $request,$id)
    {
       $category=Category::find($id);
       $category->name=$request->name;
       $category->description=$request->description;
       $category->save();
       return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category=Category::withTrashed()->find($id);
        if($category->deleted_at){
        $category->forcedelete();
        session()->flash('success', 'Category Permanently Deleted !');
        }
        else{
        session()->flash('success', 'Category Soft Deleted !');
        $category->delete();
        }
        return redirect()->back();
    }
    public function restore($id)
    {
        $category=Category::onlyTrashed()->find($id);
        $category->restore();
        session()->flash('success', 'Category Restored !');
        return redirect()->back();
    }
}