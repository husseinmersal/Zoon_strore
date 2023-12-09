<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategotyRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $parents = Category::all();
        $categories = new Category();
        return view('dashboard.categories.create', compact('parents', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

         $request->validate(Category::rules(),[
            'required' => 'This field(:attribute) is required !',
            'name.unique' => 'This name is already exists !',
         ]);


        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);


        $category = Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        try {
            $categories = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('categories.index')
                ->with('info', 'Record Not Found !');
        }

        $parents = category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('categories', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategotyRequest $request,$id) {


        $category = Category::findOrFail($id);
        $old_image = $category->image;

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);


        $category->update($request->all($data));

        if($old_image && $data['image']) {
            Storage::disk('uploads')->delete($old_image);
        }

        return redirect()->route('categories.index')
            ->with('success', 'Category Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {

        $category = Category::findOrFail($id);

        $category->delete();

        if($category->image) {
            Storage::disk('public')->delete($category->image);
        }


        //    Category::destroy($id);


        return redirect()->route('categories.index')
            ->with('success', 'Category Deleted !');
    }


    protected function uploadImage(Request $request) {

        if(!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');

        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);

        return $path;

    }
}
