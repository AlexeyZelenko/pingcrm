<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SongsController extends Controller
{

    /**
     * Display a listing of songs.
     */
    public function index(Request $request): Response
    {
        // Получаем все песни, можем добавлять фильтры, поиск и пагинацию при необходимости
        $songs = Song::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('language', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Передаем список песен в представление Inertia
        return Inertia::render('Songs/Index', [
            'songs' => $songs,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new song.
     */
    public function create(): Response
    {
        return Inertia::render('Songs/Create');
    }

    /**
     * Store a newly created song in storage.
     */
    public function store(Request $request)
    {
        // Валидация данных перед сохранением
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'youtube_links' => 'nullable|array',
            'note' => 'nullable|string',
            'description' => 'nullable|string',
            'blocks' => 'nullable|array',
        ]);

        // Создание новой песни
        Song::create($validated);

        // Перенаправление на главную страницу с сообщением об успехе
        return redirect()->route('songs')->with('success', 'Песня успешно добавлена.');
    }

    /**
     * Display the specified song.
     */
    public function show(Song $song): Response
    {
        return Inertia::render('Songs/Show', [
            'song' => $song,
        ]);
    }

    /**
     * Show the form for editing the specified song.
     */
    public function edit(Song $song): Response
    {
        return Inertia::render('Songs/Edit', ['song' => $song]);
    }


    /**
     * Update the specified song in storage.
     */
    public function update(Request $request, Song $song)
    {
        // Валидация данных перед обновлением
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'youtube_links' => 'nullable|array',
            'note' => 'nullable|string',
            'description' => 'nullable|string',
            'blocks' => 'nullable|array',
        ]);

        // Обновление данных песни
        $song->update($validated);

        // Перенаправление на главную страницу с сообщением об успехе
        return redirect()->route('songs')->with('success', 'Песня успешно обновлена.');
    }

    /**
     * Remove the specified song from storage.
     */
    public function destroy(Song $song)
    {
        // Удаление песни
        $song->delete();

        // Перенаправление на главную страницу с сообщением об успехе
        return redirect()->route('songs')->with('success', 'Песня успешно удалена.');
    }

    /**
     * Restore the specified song to storage.
     */
    public function restore($id)
    {
        $song = Song::withTrashed()->findOrFail($id);

        // Восстановление песни
        $song->restore();

        // Перенаправление на главную страницу с сообщением об успехе
        return redirect()->route('songs')->with('success', 'Песня успешно восстановлена.');
    }
}
