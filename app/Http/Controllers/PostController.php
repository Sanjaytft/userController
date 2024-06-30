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

      if(auth()->user()->role_id==1){
        $posts = Post::latest()->get();
      }else  
       {
        $posts = Post::where('status', 1)->whereJsonContains('department_id', auth()->user()->department_id)->get();
      }

      return view('posts.index', compact('posts'));
    }
    // routes functions
    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if(json_decode(auth()->user()->department_id)==[]){
        return back()->with('error','Please assign department to the user to add post');
      }
      return view('posts.create');
    }
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
        'department_id' => auth()->user()->department_id, 
    ]);
    //create 
    Mail::to("admin@gmail.com")->send(new PostMail($post));

  // Redirect or return response as needed
   return redirect()->route('posts.index')->with('success', 'Post created successfully!');

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'nullable|mimes:docx,doc,pdf,txt,jpg,jpeg,png|max:2048', // Allow null or specific file types and max size (2MB)

        ]);

        dd('asda');
      

        $post = Post::find($post);

        // Handle File Upload if a new file is provided
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $mimeType = $file->getMimeType();

            if (strpos($mimeType, 'image') !== false) {
                $file->move(public_path('file/images'), $fileName);
            } elseif (in_array($mimeType, ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])) {
                $file->move(public_path('file/files'), $fileName);
            }

            // Delete old file if exists
            if ($post->file) {
                $this->deleteFileIfExists($post->file);
            }

            // Update post with new file path
            $post->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'file' => $fileName, // Store the file path in the database
            ]);
        } else {
            // Update post without changing file
            $post->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);
        }

        // Redirect or return response as needed
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
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
      return back()->with('success', 'post deleted successfully');
    
    }

    public function change_status(Request $request)
    {
      $post = Post::find($request->post_id);
      $post->status=$request->status;
      $post->save();
      return back()->with('status','Status change successfully!!!');
    }


}
