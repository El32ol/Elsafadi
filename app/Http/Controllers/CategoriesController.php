<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Rules\FilterRule;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

    protected $rules = [
                        'name'=>'required|string|between:2,255|filter',
                        'parent_id'=>'nullable|int|exists:categories,id',
                        'description'=>'nullable|string|required',
                        'art_path'=>'nullable|image',
                       ];

     protected $messages = [
                            'name.required'=>'This is the first . '
                           ]; 
    //Actions

    public function index($id = 0)
    {
        // $categories = DB::table('categories')->get();
        $categories = Category::leftjoin('categories as parent' ,'parent.id', '=' , 'categories.parent_id')
        ->select([
            'categories.*',
            'parent.name as parent_name'
        ])->paginate();
        // طريقه للاستعلام
        // $categorys = DB::table('categories')->where('id', $id)->first();
        //  طريقه تانيه
        // $category = DB::table('categories')->find($id);
   
        // if($category)
        // {
        //     return view('categories.show' , [
        //         'category'=>$category,
        //         'title' => "Show Category",
        //     ]);
        // }
        $title = "Categories";
        $success = session('success');
        return view('categories.index' , compact('categories' , 'title' ,'success'));
        // return view('dashboard.main' , compact('categories' , 'title' ,'success'));
    }

    public function show(Category $category ,)
    {
        $title = "Show Category";
        return view('categories.show' , [
            'category'=>$category,
            'title' => $title
        ]);

    }

    public function create()
    {
        $parents = Category::get();
        $category= new Category();
        $title = "Create Page";
        return view('categories.create' , compact('title' ,'category' ,'parents' ));
    }

    public function store(Request $request)
    {

        $clean = $request->validate($this->rules , $this->messages);
        // $clean = $this->validate($request, $rules);

        // $clean = Validator::make($request->all(),$rules);
    //    $clean = $clean->validate();
        // if( $clean->fails())
        // {
        //     return redirect()->back()->withErrors($clean);
        // };

        // $category = new Category();
        // $category->name = $request->name;
        // $category->parent_id = $request->input('parent_id');
        // $category->description = $request->description;
        // $category->slug = Str::slug($category->name);
        // $category->save();
        $data = $request->all();   
        if(! $data['slug'])
        {
            $data['slug'] = Str::slug($request->name);
        }

        $category = Category::create($data);

        return redirect()->route('categories.index')->with('success' , 'The Category has been created .');

    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        $title = 'Trash Page';

        return view('categories.trash' , compact ('categories' , 'title'));
    }
    
    public function edit(Category $category)
    {
      
        $parents = Category::get();
      
        $title = 'Edit Page';
        return view('categories.edit' , compact ('title' ,'parents' , 'category'));
    }
    
    public function update(Request $request , Category $category)
    {
        $clean = $request->validate($this->rules , $this->messages);
       // $clean = $this->validate($request, $rules);
        // $category->name = $request->name;
        // $category->parent_id = $request->input('parent_id');
        // $category->description = $request->description;
        // $category->slug = Str::slug($category->name);
        // $category->save();
        $category->update($request->all());
        return redirect()->route('categories.index')->with('warning' , 'Category Updated');
    }
    
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('error' , 'Category Deleted');
    }

    // protected function rules()
    // {
    //     $rules = $this->rules;
    //     $rules['name']= new FilterRule;
    //     // $rules['name'][] = function( $attribute , $value , $fail)
    //     // {
    //     //     if( $value == 'god' )
    //     //     {   
    //     //         $fail('This Word Is not allowed .');
    //     //     }
    //     // };
    //      return $rules;
    // }

    public function restore($id)
    {
        $trashItem = Category::onlyTrashed()->findOrFail($id);
        $trashItem->restore();

        return redirect()->route('categories.index')
        ->with('success' , 'Category  restored successfully');

    }

    public function forceDelete($id)
    {
        $trashItem = Category::withTrashed()->findOrFail($id);
        $trashItem->forceDelete();

        return redirect()->route('categories.index')
        ->with('success' , 'Category deleted forever');
    }

}
