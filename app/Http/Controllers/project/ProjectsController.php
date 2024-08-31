<?php

namespace App\Http\Controllers\project;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\project\Project;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title= 'Projects Page';
        $user = Auth::user();
        // $project = Project::with('category)->where('user_id', $user->id)->get();
       $projects = $user->projects()
            ->with('category.parent' )
            ->withoutGlobalScope('active') // if i want to apply the global scop use withoutGlobalScope
            // ->withoutGlobalScopes() //for all global scopes with soft delete
            ->paginate();
    
       // if i want to apply the global scop use withoutGlobalScope
       
       return view('project.index' , compact('projects' ,'title' ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $title= 'Create Page';
        $types = project::types(); 
        $project = new Project();
        $categories = $this->categories();
        $tags = [];
        

       return view('project.create' , compact('project' , 'tags' ,'types','title' , 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {

        // $user= Auth::user();

        $user = $request->user();

        $data = $request->except('attachments');
        $data['attachments'] = $this->uploadsAttachment($request);

        $project = $user->projects()->create($data);
        $tags = explode(" , ", trim($request->tags));
         $project->syncTags($tags);


        // dd($tags);
        return redirect()
                ->route('clients.index' )
                ->with('success', 'Project Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $title= 'Show Page';
        $user = Auth::user();

        // $project = Project::where('user_id' , $user->id)->findOrFail($id);
        $project = $user->projects()->findOrFail($id);
        
        // dd($projects->id);
       
        return view('project.show' , compact('project' , 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $types = project::types(); 
        $project = $user->projects()->findOrFail($id);
        
        // dd($project->attachments);

        $tags = $project->tags()->pluck('name')->toArray();
       
        $categories = $this->categories();

        return view('project.edit' , compact('project' , 'tags' , 'types' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $user = Auth::user(); // user id
        $project = $user->projects()->findOrFail($id); 
        $data = $request->except('attachments');
        // $data['attachments'] =($project->attachments ?? []) +  $this->uploadsAttachment($request);
        $data['attachments'] =array_merge(($project->attachments ?? [])  , $this->uploadsAttachment($request));
        $project->update($data);
        $tags = explode(" , ", trim($request->tags));
        $project->syncTags($tags);

        


        return redirect()
        ->route('clients.index')
        ->with('success', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $project = $user->projects()->findOrFail($id);
        $project->delete();

        if($project->attachments)
        {
            foreach($project->attachments as $file)
            {
                Storage::disk('public')->delete($file);
            }
        }
        // $project = Project::where('user_id' , Auth::id())
        //                  ->where($id , 'id' )->delete();

        return redirect()
        ->route('clients.index')
        ->with('success', 'Project Deleted Successfully');

    }
    protected function categories()
    {
        return Category::pluck('name' , 'id')->toArray();
    }

    protected function uploadsAttachment(Request $request)
    {
        if(!$request->hasFile('attachments'))
        {
            return;
        }
               $files = $request->file('attachments');
               $attachments = [];
               foreach($files as $file)
               {
                if($file->isValid())
                {

                    $path = $file->store('attachments' , [
                        'disk' => 'public',
                    ]);
                    $attachments[] = $path;  
                }
                }
                return $attachments; 
    }
}
    
    