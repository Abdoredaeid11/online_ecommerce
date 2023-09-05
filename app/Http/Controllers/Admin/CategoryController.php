<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\storeCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;




class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeCategoryRequest $request)
    {
        //
        
      try{
        $validate=$request->validated();
      
        $image=$request->file('image')->store('public/assets/uploads/Category');

        
        $category=new Category();
        $category->name=['ar'=>$request->name_ar,'en'=>$request->name_en];
        $category->slug=$request->slug;
        $category->description=['ar'=>$request->description_ar,'en'=>$request->description_en];
        $category->meta_title=['ar'=>$request->title_ar,'en'=>$request->title_en];
      $category->image=$image;
        $category->meta_description=['ar'=>$request->meta_description_ar,'en'=>$request->meta_description_en];
        $category->is_popular=$request->popular ? '1':'0';
        $category->is_showing=$request->show ? '1':'0';
        $category->meta_keywords=$request->meta_keywords;
        $category->save();
     

        toastr()->success(trans("messages_trans.success_save"), 'Congrats', ['timeOut' => 5000]);
 return redirect()->route('categories.index');
      }
      catch(\Exception $e){
        return redirect()->back()->withErrors('error',$e->getMessage());
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        
        return view('admin.category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        


        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request,Category $category)
    {
        //
        try {

          // $vaildated=$request->vaildated(); ?????????????
         
             $image=$category->image;
             
        if($request->hasFile('image')){
            Storage::delete($image);
            $image=$request->file('image')->store('public/assets/uploads/Category');
 
        }
        
           $category->update([
            'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
            'slug'=>$request->slug,
            'description'=>['ar'=>$request->description_ar,'en'=>$request->description_en],
            'meta_title'=>['ar'=>$request->title_ar,'en'=>$request->title_en],
            'image'=>$image,
            'meta_description'=>['ar'=>$request->meta_description_ar,'en'=>$request->meta_description_en],
            'is_popular'=>$request->popular ? '1':'0',
            'is_showing'=>$request->show ? '1':'0',
            'meta_keywords'=>$request->meta_keywords,


           ]);
           
  return redirect()->route('categories.index')->with('success',trans("messages_trans.success_save"));
           
            //code...
        } catch (\Exception $e) {

            //throw $th;
            return redirect()->back()->withErrors('error',$e->getMessage()); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
