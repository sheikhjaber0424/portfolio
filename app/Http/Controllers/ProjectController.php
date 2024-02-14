<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $projects = ProjectResource::collection(Project::with('skill')->get());
        // $projects = Project::all();
        // dd($projects);
        return Inertia::render('Projects/Index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::all();
        return Inertia::render('Projects/Create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // return $request->all();
        $request->validate([
            'image' => ['required', 'image'],
            'name' => ['required', 'min:3'],
            'skill_id' => ['required'],
            'project_url' => ['nullable'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('skills');

            Project::create([
                'name' => $request->name,
                'skill_id' => $request->skill_id,
                'project_url' => $request->project_url,
                'image' =>  $image,
            ]);
            return Redirect::route('projects.index')->with('message', 'Project Created Successfully!');
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $skills = Skill::all();
        return Inertia::render('Projects/Edit', compact('project', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // $request->validate([
        //     'image' => ['required', 'image'],
        //     'name' => ['required', 'min:3'],
        //     'skill_id' => ['required'],
        //     'project_url' => ['nullable'],
        // ]);

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image')->store('skills');

        //     Project::create([
        //         'name' => $request->name,
        //         'skill_id' => $request->skill_id,
        //         'project_url' => $request->skill_id,
        //         'image' =>  $image,
        //     ]);
        //     return Redirect::route('projects.index');
        // }
        // return Redirect::back();



        // return $request->all();
        $image = $project->image;
        $request->validate([
            'name' => ['required', 'min:3'],
            'skill_id' => ['required'],
            'project_url' => ['nullable'],
        ]);

        if ($request->hasFile('image')) {

            Storage::delete($project->image);
            $image = $request->file('image')->store('projects');
        }
        $project->update([
            'name' => $request->name,
            'skill_id' => $request->skill_id,
            'project_url' => $request->project_url,
            'image' =>  $image,
        ]);
        // return $project;
        return Redirect::route('projects.index')->with('message', 'Project Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();
        return Redirect::back()->with('message', 'Project Deleted Successfully!');
    }
}
