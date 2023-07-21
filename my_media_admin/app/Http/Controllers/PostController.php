<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct post
    public function index(){

        $categories = Category::get();
        $posts = Post::paginate(3);
        return view('admin.post.index',compact('categories','posts'));
    }
    //create post
    public function create(Request $request){

        $this->validationCheck($request);
        $data = $this->getPostDate($request);
        if($request->hasFile('postImage')){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/images',$fileName);
            // $file->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Post::create($data);
        return back();
    }
    //delete post
    public function delete($id){

        $post = Post::where('post_id',$id)->first();
        $imageName = $post->image;
        if(File::exists(public_path().'/images/'.$imageName)){
            File::delete(public_path('images/'.$imageName));
        };
        Post::where('post_id',$id)->delete();
        return redirect()->route('admin#post');
    }
    //search post
    public function searchPost(Request $request){
        $categories = Category::get();
        $posts = Post::where('title','LIKE','%'.$request->searchKey.'%')
                    ->paginate(3);
        return view('admin.post.index',compact('categories','posts'));
    }
    //direct edit page
    public function editPage($id){

        $post = Post::where('post_id',$id)->first();    //for edit post
        $posts = Post::paginate(3);
        $categories = Category::get();
        return view('admin.post.edit',compact('post','posts','categories'));
    }
    //update post
    public function update(Request $request,$id){

        $this->validationCheck($request);
        $data = $this->getPostDate($request);
        if($request->postImage){
            $oldPostImage = Post::where('post_id',$id)->first()->image; //check old image
            if($oldPostImage != null){
                File::delete(public_path('images/'.$oldPostImage));
            }
            $fileName = uniqid().'_'.$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->move(public_path().'/images/',$fileName);
            $data['image'] = $fileName;
        }
        Post::where('post_id',$id)->update($data);
        return redirect()->route('admin#post');
     }

    //check for validation
    private function validationCheck($request){

        Validator::make($request->all(),[
            'postTitle' => 'required',
            'postDescription' => 'required',
            'categoryId' => 'required',
            'postImage' => 'mimes:jpg,jpeg,png,bmp,tiff'
        ])->validate();
    }
    //get post data
    private function getPostDate($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->categoryId,
            'updated_at' => Carbon::now(),
        ];
    }
}
