<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        'file' => 'required|mimes:docx,doc,pdf,txt,jpg,jpeg,png|max:2048', // Example mime types and max size (2MB)
    ]);
    $mimeType = $request->file('file')->getMimeType();
    // Handle File Upload
    if (strpos($mimeType, 'image') !== false) {
      $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('file/images'), $fileName);
  } elseif (in_array($mimeType, ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])) {
    $file = $request->file('file');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('file/files'), $fileName);
  } 
   


    // Create Post
    $post = Post::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'file' => $fileName, // Store the file path in the database
        'user_id' => auth()->user()->id,
        
    ]);

    //create 
    Mail::to("admin@gmail.com")->send(new PostMail($post));

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
    public function update(Request $request, Post $post)
    {
      $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'file' => 'required|mimes:docx,doc,pdf,txt,jpg,jpeg,png|max:2048', // Example mime types and max size (2MB)
    ]);
        $mimeType = $request->file('file')->getMimeType();
        // Handle File Upload
        if (strpos($mimeType, 'image') !== false) {
          $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file/images'), $fileName);
      } elseif (in_array($mimeType, ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('file/files'), $fileName);
      } 
      dd('hello');

      // Create Post
      $post->update ([
          'title' => $request->input('title'),
          'description' => $request->input('description'),
          'file' => $fileName, // Store the file path in the database
          // 'user_id' => auth()->user()->id,
          
      ]);
      
  // Redirect or return response as needed
  return redirect()->route('posts.index')->with('success', 'Post created successfully!');

  }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $post = Post::find($request->post_id);
      // unlink(public_path($post->file));
      $post->delete();
      return back()
        ->with('success', 'post deleted successfully');
     
      // $post = Post::find($id);
      // 
      // $post->delete();
      // return redirect()->route('posts.index')
      //   ->with('success', 'Post deleted successfully');
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
    public function show(string $id)
    {
      $post = Post::find($id);
      return view('posts.show');
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

    public function change_status(Request $request)
    {
      $post = Post::find($request->post_id);
      $post->status=$request->status;
      $post->save();
      return back()->with('status','Status change successfully!!!');
    }
}
