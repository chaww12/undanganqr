<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all(); 
        return view('admin.events.index', [
            'title' => 'Daftar Event',
            'events' => $events
        ]);
    }

    public function supindex()
    {
        $events = Event::all(); 
        return view('superadmin.events.index', [
            'title' => 'Daftar Event',
            'events' => $events
        ]);
    }

    public function create()
    {
        return view('admin.events.create', ['title' => 'Tambah Event']);
    }

    public function supcreate()
    {
        return view('superadmin.events.create', ['title' => 'Tambah Event']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'namaevent' => 'required|string|max:255',
            'waktu' => 'required|date',
            'status' => 'required|in:mendatang,sedang berlangsung,sudah terlaksana', 
        ]);

        $event = new Event();

        if ($request->hasFile('poster')) {
            $filePath = $request->file('poster')->store('posters', 'public'); 
            $event->poster = $filePath; 
        }

        $event->namaevent = $request->namaevent; 
        $event->waktu = $request->waktu; 
        $event->status = $request->status; 
        $event->save(); 
    
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function supstore(Request $request)
    {
        $request->validate([
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'namaevent' => 'required|string|max:255',
            'waktu' => 'required|date',
            'status' => 'required|in:mendatang,sedang berlangsung,sudah terlaksana', 
        ]);

        $event = new Event();

        if ($request->hasFile('poster')) {
            $filePath = $request->file('poster')->store('posters', 'public'); 
            $event->poster = $filePath; 
        }

        $event->namaevent = $request->namaevent; 
        $event->waktu = $request->waktu; 
        $event->status = $request->status; 
        $event->save(); 
    
        return redirect()->route('superadmin.events.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.show', ['title' => 'Detail Event'], compact('event'));
    }

    public function supshow($id)
    {
        $event = Event::findOrFail($id);
        return view('superadmin.events.show', ['title' => 'Detail Event'], compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function supedit($id)
    {
        $event = Event::findOrFail($id);
        return view('superadmin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaevent' => 'required|string|max:255',
            'waktu' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|in:mendatang,sedang berlangsung,sudah terlaksana', 
        ]);

        $event = Event::findOrFail($id);
        $event->namaevent = $request->input('namaevent');
        $event->waktu = $request->input('waktu');
        $event->status = $request->input('status'); 

        if ($request->hasFile('poster')) {
            if ($event->poster) {
                Storage::delete('public/' . $event->poster);
            }

            $path = $request->file('poster')->store('posters', 'public');
            $event->poster = $path; 
        }

        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event Berhasil diperbarui.');
    }

    public function supupdate(Request $request, $id)
    {
        $request->validate([
            'namaevent' => 'required|string|max:255',
            'waktu' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|in:mendatang,sedang berlangsung,sudah terlaksana', 
        ]);

        $event = Event::findOrFail($id);
        $event->namaevent = $request->input('namaevent');
        $event->waktu = $request->input('waktu');
        $event->status = $request->input('status'); 

        if ($request->hasFile('poster')) {
            if ($event->poster) {
                Storage::delete('public/' . $event->poster);
            }

            $path = $request->file('poster')->store('posters', 'public');
            $event->poster = $path; 
        }

        $event->save();

        return redirect()->route('superadmin.events.index')->with('success', 'Event Berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->poster) {
            Storage::delete('public/' . $event->poster);
        }
        $event->delete(); 

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }

    public function supdestroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->poster) {
            Storage::delete('public/' . $event->poster);
        }
        $event->delete(); 

        return redirect()->route('superadmin.events.index')->with('success', 'Event berhasil dihapus.');
    }

}
