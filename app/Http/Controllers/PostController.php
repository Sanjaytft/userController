<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use illuminate\Http\Request;



class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('user.createpost',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.createpost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
// Validate the incoming request data
dd($request);
    $validator = Validator::make($request->all(), [
    'title' => ['required', 'string'],
    'description' => ['required', 'string'],
    'filename' => ['required', 'mimes:pdf,doc,docx,txt'],
    ]);

// Check if the validation fails
if ($validator->fails()) {
    return redirect()->back()
                ->withErrors($validator)
                ->withInput();
}
     
        $path = $request->file('filename')->store('uploads', 'public');
    
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'filename' => $path,
        ]);

        
        return redirect()->route('user.postindex')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('user.postshow',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('user.postedit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'filename' => 'required | mines:pdf, doc, docx,txt'
        ]);
    
        
        $post->update($request->all());
        $path = $request->file('filename')->store('uploads', 'public');
    
        return redirect()->route('userPost.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
    
        return redirect()->route('user.postindex')
                        ->with('success','Post deleted successfully');
    }
}
