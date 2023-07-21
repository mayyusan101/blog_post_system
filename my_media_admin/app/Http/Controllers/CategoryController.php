<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category
    public function index()
    {

        $categories = Category::paginate(5);
        return view('admin.category.index', compact('categories'));
    }
    //create category
    public function create(Request $request)
    {

        $this->validationCheck($request);
        $data = $this->getData($request);
        Category::create($data);
        return back();
    }
    //delete category
    public function delete($id)
    {

        Category::where('category_id', $id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess' => 'One category is deleted']);
    }
    //edit category
    public function editPage($id)
    {

        $category = Category::where('category_id', $id)->first();
        $categories = Category::paginate(5);
        return view('admin.category.edit', compact('categories', 'category'));
    }
    //edit category
    public function update(Request $request, $id)
    {

        $this->validationCheck($request);
        $data = $this->getData($request);
        Category::where('category_id', $id)->update($data);
        return redirect()->route('admin#category');
    }
    //search category
    public function searchCategory(Request $request)
    {

        if ($request->searchKey) {
            $categories = Category::where('title', 'like', '%' . $request->searchKey . '%')
                ->paginate(5);

            return view('admin.category.index', compact('categories'));
        } else {
            return redirect()->route('admin#category');
        }
    }

    //convert array data
    private function getData($request)
    {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription
        ];
    }
    //check validation
    private function validationCheck($request)
    {

        Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ])->validate();
    }
}
