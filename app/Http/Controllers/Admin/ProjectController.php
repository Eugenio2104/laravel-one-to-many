<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProjectRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();

        $new_item = new Project();
        $data['slug'] = Project::generateSlug($data['name']);

        if (array_key_exists('cover_image', $data)) {
            $data['image_original'] = $request->file('cover_image')->getClientOriginalName();
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
            // dd(Storage::put('uploads', $data['cover_image']));
        }
        // dd($data);
        $new_item->fill($data);
        $new_item->save();

        return redirect(route('admin.projects.index', $new_item));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $categories = Category::all();
        return view('admin.projects.show', compact('project', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->all();

        if ($data['name'] != $project->name) {
            $data['slug'] = Project::generateSlug($data['name']);
        } else {
            $data['slug'] = $project->slug;
        }

        if (array_key_exists('cover_image', $data)) {

            // se invio una nuova immagine devo eliminare la vecchia dal filesystem
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['img_original'] = $request->file('cover_image')->getClientOriginalName();
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }


        $project->update($data);

        return redirect(route('admin.projects.show', $project));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted', "il progetto <strong> $project->name </strong> e stato eliminato correttamente");
    }
}
