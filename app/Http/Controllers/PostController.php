<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(auth()->user()->role==1){
        $posts = Post::all();
      }else {
        $posts = Post::where('status', 1)->get();
      }
      $posts = Post::all();
      return view('posts.index', compact('posts'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'file' => 'required|file|mimes:docx,doc,pdf,txt|max:2048', // Example mime types and max size (2MB)
    ]);

    // Handle File Upload
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName); // Store file in storage/app/uploads directory
    } else {
        $filePath = null;
    }


    // Create Post
    $post = Post::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'file' => $filePath, // Store the file path in the database
        'user_id' => auth()->user()->id,
        
    ]);

    if($post) {
        if($post->status){
            $post->status = 0;
        }
        else{
            $post->status = 1;
        }
    }

// Redirect or return response as needed
return redirect()->route('posts.index')->with('success', 'Post created successfully!');

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
      ]);
      $post = Post::find($id);
      $post->update($request->all());
      return redirect()->route('posts.index')
        ->with('success', 'Post updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      $post->delete();
      return redirect()->route('posts.index')
        ->with('success', 'Post deleted successfully');
    }
    // routes functions
    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('posts.create');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::find($id);
      return view('posts.show', compact('post'));
    }
    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);
      return view('posts.edit', compact('post'));
    }
}
