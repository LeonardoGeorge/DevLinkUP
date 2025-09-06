<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('client')
            ->open()
            ->latest()
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'skills_required' => 'required|string',
            'budget' => 'nullable|numeric',
            'budget_type' => 'required|in:hourly,fixed',
            'deadline' => 'nullable|date'
        ]);

        $project = Auth::user()->projects()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'skills_required' => explode(',', $validated['skills_required']),
            'budget' => $validated['budget'],
            'budget_type' => $validated['budget_type'],
            'deadline' => $validated['deadline'],
            'status' => 'open'
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Projeto criado com sucesso!');
    }

    public function show(Project $project)
    {
        $project->load('client', 'proposals.freelancer');
        return view('projects.show', compact('project'));
    }
}
