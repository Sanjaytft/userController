<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::latest()->get();
    //   if(auth()->user()->role==1){
    //     $department = Department::latest()->get();
    //   }else  {
    //     $department = Department::where('status', 1)->where('role_id', auth()->user()->role)->get();
    //   }
      return view('departments.index',compact('departments'));
    }
    // routes functions
    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('departments.create');
    }
    public function store(Request $request)
    {

        $request->validate([
        'name' => 'required|max:255',
    ]);
   
   // Create Post
    $departments = Department::create([
        'name' => $request->input('name'), 
    ]);

  // Redirect or return response as needed
  return redirect()->route('departments.index')->with('success', 'Department created successfully!');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
      $department = Department::find($id);
      return view('departments.show');
    }
    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $department = Department::find($id);
      return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $department)
    {
      
        $request->validate([
            'name' => 'required|max:255',
        ]);
      
           $department = Department::find($department);
            // Update post without changing file
            $department->update([
                'name' => $request->input('name'),
            ]);
    

        // Redirect or return response as needed
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $department = Department::find($request->department_id);
      
      // unlink(public_path($post->file));
      $department->delete();
      return back()->with('success', 'post deleted successfully');
    
    }

    public function change_status(Request $request)
    {
      $department = Department::find($request->department_id);
      $department->status=$request->status;
      $department->save();
      return back()->with('status','Status change successfully!!!');
    }
}
