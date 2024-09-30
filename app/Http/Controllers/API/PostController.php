<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\Basecontroller as Basecontroller;

class PostController extends Basecontroller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Post::all();

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'All Post data.',
        //     'data'=>$data
        // ],200);

        $data = Post::all();

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'All post data',
        //     'data'=>$data
        // ],200);

        return $this->sendResponse($data,'All post data');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatePost = Validator::make(
            $request->all(),
            [
                'title'=>'required',
                'description'=>'required',
                'image'=>'required|mimes:png,jpg,jpeg,gif'
            ]
            );

        if($validatePost->fails()){
            // return response()->json([
            //     'status'=>false,
            //     'message'=>'validation error',
            //     'errors'=>$validatePost->errors()->all()
            // ],401);

            return $this->sendError('validation error' , $validatePost->errors()->all());

        }


        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time().'.'.$ext;
        $img->move(public_path().'/uploads',$imageName);

        $post= Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$imageName
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Post created successfully',
            'post'=>$post
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Post::select('id' , 'title' , 'description' , 'image')->where(['id'=>$id])->get();

        return response()->json([
            'status'=>true,
            'message'=>'your single post',
            'data'=>$data
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $validatePost = Validator::make(
        //     $request->all(),
        //     [
        //         'title'=>'required',
        //         'description'=>'required',
        //         'image'=>'required"mimes:png,jpg,jpeg,gif'
        //     ]
        //     );

        // if($validatePost->fails()){
        //     return response()->json([
        //         'status'=>false,
        //         'message'=>'validation error',
        //         'errors'=>$validatePost->errors()->all()
        //     ],401);
        // }


        // $post = Post::select('id' , 'image')->get();

        // if($request->image !== ""){
        //     $path = public_path().'/uploads';

        //     if($post->image !== '' && $post->image != null){
        //         $old_file = $path.$post->image;
        //         if(file_exists($old_file)){
        //             unlink($old_file);
        //         }
        //     }
        //     $img = $request->image;
        //     $ext = $img->getClientOriginalExtension();
        //     $imageName = time().'.'.$ext;
        //     $img->move(public_path().'/uploads',$imageName);
        // }else{
        //     $imageName=$post->image;
        // }

        // $post= Post::where(['id'=>$id])->update([
        //     'title'=>$request->title,
        //     'description'=>$request->description,
        //     'image'=>$imageName
        // ]);

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'Post updated successfully',
        //     'post'=>$post
        // ],200);

        $validatePost = Validator::make(
            $request->all(),
            [
                'title'=>'required',
                'description'=>'required',
                'image'=>'required|mimes:png,jpg,jpeg,gif'
            ]
            );

            if($validatePost->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation erro',
                    'error'=>$validatePost->errors()->all()
                ],401);
            }


        $postImage = Post::select( 'id','image')->Where('id' , $id)->get();

        if($request->image !== ""){
            $path = public_path().'/uploads';

            if( $postImage[0]->image !== '' &&  $postImage[0]->image != null){
                $old_file = $path. $postImage[0]->image;
                if(file_exists($old_file)){
                    unlink($old_file);
                }
            }
            $img = $request->image;
            $ext = $img->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $img->move(public_path().'/uploads',$imageName);
        }else{
            $imageName=$postImage->image;
        }

        $post = Post::where(['id'=>$id])->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$imageName
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Post successfully updated',
            'post'=>$post
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // $imagePath = Post::select('image')->where('id' , $id)->get();

        // $filePath =  public_path().'/uploads'.$imagePath[0]['image'];
        // unlink($filePath);

        // $post = Post::where('id',$id)->delete();

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'post deleted successfully',
        //     'post'=>$post
        // ],200);

        $imagePath = Post::select('image')->where('id' , $id)->get();

        $filePath = public_path().'/uploads/'.$imagePath[0]['image'];
        unlink($filePath);

        $post = Post::where('id' , $id)->delete();

        return response()->json([
            'status'=>true,
            'message'=>'post deleted successfully',
            'post'=>$post
        ],200);

    }
}
