<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request){

        $file = $request->file('file');
        $fileName = time().".".$file->getClientOriginalExtension();
        $path = $file->storeAs('images',$fileName,'s3');

        // $url = Storage::disk('s3')->url($path);

        Post::create([
            'title' =>$request->title,
            'description'=>$request->description,
            'uploaded_file'=>$path,
        ]);
        $request->session()->flash('message', "File Successfully Uploaded!");
        return back();


    return back();
    }
    public function show(){
        $post = Post::latest()->first();
        $url = Storage::disk('s3')->url($post->uploaded_file);
        return view('show',compact('url','post'));
    }
    public function delete($id){
        $post = Post::find($id);
        Storage::disk('s3')->delete($post->uploaded_file);
        $post->delete();

        Session::flash('message', "File Successfully Deleted!");
        return redirect()->route('home');
    }
    public function download($id){
        $post = Post::find($id);
       $file = Storage::disk('s3')->download($post->uploaded_file);
       $file->send();
    }
}
