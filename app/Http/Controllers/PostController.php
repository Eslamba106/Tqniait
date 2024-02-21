<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        
        $posts = Post::where('user_id' , auth()->user()->id)->orderBy('pinned','desc')->paginate(5);
        if($posts){
            return response()->apiSuccess($posts);
        }else{
            return response()->apiFail('You have not posts');
        }
    }
    public function create(Request $request){
        $request->validate([
            'title'=> 'required|max:255',
            'body'=> 'required|string',
            'image'=> 'required',
            'pinned' => 'required|boolean',
            'parent_id'=> 'required',
        ]);
        $image = $request->image->getClientOriginalName();
        $request->merge([
            'user_id' => auth()->user()->id,
        ]);
        $data = $request->except('image');
        $data['image'] = $image;
        $post = Post::create($data);
        $request->image->move(public_path('Attachments'), $image);
        return response()->apiSuccess($post);

    }

    public function update(Request $request){

        $post = Post::findOrFail($request->id);
        $request->validate([
            'title'=> 'required|max:255',
            'body'=> 'required|string',
            'pinned' => 'required|boolean',
            'parent_id'=> 'required',
        ]);
        $request->merge([
            'user_id' => auth()->user()->id,
        ]);
        if($request->hasFile('image')){
            $image = $request->image->getClientOriginalName();

            $data = $request->except('image');
            $data['image'] = $image;

            $post->update($data);
            $request->image->move(public_path('Attachments'), $image);

        }
        $post->update($request->all());
        return response()->apiSuccess($post);
    }

    public function delete(Request $request){
        $post = Post::where('id' , $request->id)->first();
        if($post){  
            $post->delete();
            return response()->apiSuccess("Post Delete Successfully");

        }
        return response()->apiFail('Cannot Find The Post');

    }
}
