<?php

namespace App\Http\Controllers; 

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        $blogWiseData = DB::table('blogs')
        ->join('categories', 'blogs.category_id', '=', 'categories.id')
        ->select('blogs.*', 'categories.name as category')
        ->orderBy('blogs.id', 'desc')
        ->get();
        // 
        return array('success'=>200, 'data'=>$blogWiseData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;
        $blog->slug = Str::slug($request->title);
        $blog->save();
        return array('success' => 200, 'data' => $blog);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $blogs = Blog::where('id',$id)->first();
        // dd($blogs);
        return array('success'=>200, 'data'=>$blogs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        // $blog=Blog::find($id);
        // $blog->title = $request->title;
        // $blo->content = $request->content;
        // $blogs->category_id = $request->category_id;
        // $blog->slug = Str::slug($request->title);
        // $blog->save();
        // $blog->update($request->all());
        // return array('success' => 200, 'message' => 'blog update', 'data' => $blog);
        
        $blog->title=$request->title;
        $blog->slug=Str::slug($request->title);
        $blog->content=$request->content;
        $blog->category_id=$request->category_id;
        $blog->save();
        // $blog->update($request->all());
        return array('success'=> 200, 'message'=>'blog updated', 'data'=>$blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return array('success'=>200, 'message'=>'blog deleted');


        // Blog::destroy($blog);         Example
    }
}