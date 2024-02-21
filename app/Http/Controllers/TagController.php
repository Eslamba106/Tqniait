<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{

    public function show(){
        $tags = Tag::all();
        if($tags){

            return response()->apiSuccess($tags);
        }
        return response()->apiFail("No Tags");
    }

    public function create(Request $request){
        $request->validate([
            "name"=> 'required|unique:tags',
        ]);
        $tag = Tag::create([
             'name'=>$request->name ]);
        return response()->apiSuccess($tag);
    }

    public function update(Request $request){
       $tag = Tag::where('name' , $request->name)->first();
         if($tag){
            $tag->update([
                'name' => $request->new_name
            ]);
            return response()->apiSuccess($tag);
         }
         return response()->apiFail('Tag Not Fonud');

    }

    public function delete(Request $request){
        $tag = Tag::where('name',$request->name)->first();
        if($tag){
            $tag->delete();
            return response()->apiSuccess('Deleted Successfully');
        }
        return response()->apiFail('Tag Not Found');
    }
}
