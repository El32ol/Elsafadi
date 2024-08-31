<?php

namespace App\Http\Controllers\freelancer;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\project\Project;
use App\Models\Proposal;
use App\Notifications\NewProposalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ProposalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::guard('web')->user();
        // dd($user);
        $proposals = $user->proposals()
                        ->with('project')
                        ->latest()
                        ->paginate();
        return view('proposals.index' , [
            'proposals' => $proposals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        // dd($project);
        //model binnding
        // $project = Project::findOrFail($project_id);
      
        //  dd($project->status);
        // if($project->status !== 'open')
        // {
        //     return redirect()->back()
        //     ->with('error' , 'You Can Not Submit Proposal To This Project');
        // }
        // $user = Auth::guard('web')->user();
        // // dd($user);

        // if ($user->proposedProjects()->find($project->id))
        // {
        //     return redirect()->back()
        //     ->with('error' , 'Your Already Has Been Submitted This Project');
        // }

        // dd(auth()->id());
        return view('proposals.create' , [
            'project' =>$project,
            'proposal' => new Proposal(),
            'title' => 'Proposal',
            'units' =>[
                'day'=>'Day',
                'week'=>'Week',
                'month'=>'Month',
                'year'=>'Year',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $project_id)
    {
            $project = Project::findOrFail($project_id);
        if($project->status !== 'open')
        {
            return redirect()->route('proposal.index')
            ->with('error' , 'You Can Not Submit Proposal To This Project');
        }

        $user = Auth::guard('web')->user();
        if ($user->proposedProjects()->find($project->id))
        {
            return redirect()->route('proposal.index')
            ->with('error' , 'Your Already Has Been Submitted This Project');
        }

        $request->validate([
            'description' => ['required' , 'string' ],
            'cost' => ['required' , 'numeric','min:1'],
            'duration' => ['required' , 'integer','min:1'],
            'duration_unit' => ['required' , 'in:day,week,month,year'],
        ]);

        $request->merge([
            'project_id' => $project_id,
        ]);

       $proposal = $user->proposals()->create($request->all());
        // Notification for user of the project
        $project->user->notify(new NewProposalNotification($proposal , $user));
        // Notification for all admins
        $admins = Admin::all();
        //first method
        // foreach ($admins as $admin)
        // {
        //     $admin->notify(new NewProposalNotification($proposal , $user));
        // }
        //second method
        //=> stop by me it works very well (:D)
        // Notification::send($admins , new NewProposalNotification($proposal , $user));
        // Notification for email out of the system 
        // Notification::route('mail' , 'example@email');
        return redirect()->route('proposal.index')
                ->with('success' , 'Your Proposal Has Been Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
