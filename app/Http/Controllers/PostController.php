<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostMail;
use Illuminate\Http\Request;
use App\Models\DepartmentPost;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
      }elseif (auth()->user()->role_id == 2){
        $posts = Post::where('department_id', auth()->user()->department_id)->get();
      }
      else
       {
        $posts = Post::where('status', 1)->where('user_id', auth()->user()->id)->get();
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
    // $departmentpost = DepartmentPost::create([

    // 'post_id' => $post->id,
    // ]);
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
    
        // Find the post by ID
        $post = Post::find($post);
    
        if (!$post) {
            return back()->with('error', 'Post not found');
        }
    
        // Handle File Upload if a new file is provided
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
    
            // Determine the destination directory based on file type
            if (strpos($mimeType, 'image') !== false) {
                $destinationPath = public_path('file/images');
            } elseif (in_array($mimeType, ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])) {
                $destinationPath = public_path('file/files');
            } else {
                return back()->with('error', 'Unsupported file type');
            }
    
            // Move the uploaded file to the destination directory
            $file->move($destinationPath, $fileName);
    
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
     * Delete file from storage if it exists.
     *
     * @param string $filePath
     * @return void
     */
    private function deleteFileIfExists($filePath)
    {
        if (File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
        }
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    // {
    //   $post = Post::find($request->post_id);
    //   // unlink(public_path($post->file));
    //   $post->delete();
    //   return back()->with('success', 'post deleted successfully');
    
    // }

    public function destroy(Request $request)
{
    // Validate the request to ensure post_id is present and numeric
    $request->validate([
        'post_id' => 'required|numeric',
    ]);

    // Find the post by its ID
    $post = Post::find($request->post_id);

    // Check if post exists
    if ($post) {
        // Delete the image file if it exists
        if ($post->file && Storage::disk('public')->exists($post->file)) {
            Storage::disk('public')->delete($post->file);
        }

        // Delete the post record from database
        $post->delete();

        // Redirect back with success message
        return back()->with('success', 'Post deleted successfully');
    } else {
        // If post not found, redirect back with error message
        return back()->with('error', 'Post not found or already deleted');
    }
}

    public function change_status(Request $request)
    {
      $post = Post::find($request->post_id);
      $post->status=$request->status;
      $post->save();
      return back()->with('status','Status change successfully!!!');
    }


}
