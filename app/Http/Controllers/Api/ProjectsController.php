<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\project\Project;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['index' ,'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $entires = Project::latest()
        //         ->with(['user' , 'category' , 'tags'])
        //         ->paginate(); // this for all data of everything in relations
        $entires = Project::latest()
                ->with([
                    'user:id,name' , 
                    'category:id,name' , 
                    'tags:id,name'
                    ])
                ->paginate(); // this for specific data of everything in relations

        // return $entires; // return all data as object with default shape
        
        return ProjectResource::collection($entires);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $user = User::find(1);

        $data =$request->except('attachments') ;
        $project = $user->projects()->create($data);
        $tags = explode(',', trim($request->tags));
        $project->syncTags($tags);

        //all of this make the same function
        return $project;//or
        return response($project , 201);//or
        return response()->json($project , 201);//or
        return Response::json($project , 201);//or
        return new JsonResponse( $project , 201);  
    }



  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // return Project::with('category')->find($id);
        
        // return $project->category; // return category only 
        // return $project; // return without relations 
        // for egar for realation with object original 
        // return $project->load('category'); // using load()

        // using load() for return a lot of relations
        // return $project->load(['category:id,name' , 'user:id,name' , 'tags']); 

        // api resource for customization showing data 
       $user = Auth::guard('sanctum')->user();
       
        if(!$user->tokenCan('project.cr'))
        {
            return Response::json([
                'message'=>'not authorized',
            ],401);
        }
        
        return new ProjectResource( $project );
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
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required |string',
            'type' => 'sometimes|required|in:hourly,fixed',
            'budget' => 'nullable|numeric',
        ]);
       
        $project = Project::findOrFail($id);
        $project->update($request->all());
        
        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // $project = project::findOrFail($id);
        // $project->delete();
        // return; // up tile this line the attachments doesn't deleted

        $project->delete();

        if($project->attachments)
        {
            foreach($project->attachments as $file)
            {
                Storage::disk('public')->delete($file);
            }
        }
            return [
                'message' =>'project deleted',
            ];
    }
}
