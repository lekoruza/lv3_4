<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();

        // svi korisnici osim mene (voditelja), za izbor članova tima
        $users = User::where('id', '!=', $user->id)->get();

        return view('projects.create', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user(); // ovo će biti voditelj

        $validated = $request->validate([
            'naziv'            => 'required|string|max:255',
            'opis'             => 'required|string',
            'cijena'           => 'required|numeric|min:0',
            'obavljeni_poslovi'=> 'nullable|string',
            'datum_pocetka'    => 'required|date',
            'datum_zavrsetka'  => 'required|date|after_or_equal:datum_pocetka',
            'clanovi'          => 'array',          // može biti prazno
            'clanovi.*'        => 'integer|exists:users,id',
        ]);

        $project = Project::create([
            'naziv'             => $validated['naziv'],
            'opis'              => $validated['opis'],
            'cijena'            => $validated['cijena'],
            'obavljeni_poslovi' => $validated['obavljeni_poslovi'] ?? null,
            'datum_pocetka'     => $validated['datum_pocetka'],
            'datum_zavrsetka'   => $validated['datum_zavrsetka'],
            'user_id'           => $user->id,
        ]);

        if (!empty($validated['clanovi'])) {
            $project->clanovi()->sync($validated['clanovi']);
        }

        return redirect()
            ->route('projects.edit', $project)
            ->with('status', 'Projekt je uspješno kreiran.');
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
    public function edit(Request $request, Project $project)
    {
        $user = $request->user();

        $isVoditelj = $user->id === $project->user_id;
        $isClan = $project->clanovi()
                        ->where('user_id', $user->id)
                        ->exists();

        if (! $isVoditelj && ! $isClan) {
            abort(403, 'Nemate ovlasti za uređivanje ovog projekta.');
        }

        return view('projects.edit', [
            'project' => $project,
            'isVoditelj' => $isVoditelj,
            'isClan' => $isClan,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $user = $request->user(); 

        $isVoditelj = $user->id === $project->user_id;

        $isClan = $project->clanovi()
                        ->where('user_id', $user->id)
                        ->exists();

        if (! $isVoditelj && ! $isClan) {
            abort(403, 'Nemate ovlasti za uređivanje ovog projekta.');
        }

        if ($isVoditelj) {
            $validated = $request->validate([
                'naziv'            => 'required|string|max:255',
                'opis'             => 'required|string',
                'cijena'           => 'required|numeric|min:0',
                'obavljeni_poslovi'=> 'nullable|string',
                'datum_pocetka'    => 'required|date',
                'datum_zavrsetka'  => 'required|date|after_or_equal:datum_pocetka',
            ]);

            $project->update($validated);
        }

        else {
            $validated = $request->validate([
                'obavljeni_poslovi' => 'nullable|string',
            ]);

            $project->update($validated);
        }

        return redirect()
            ->route('projects.edit', $project)
            ->with('status', 'Projekt je uspješno ažuriran.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
