<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function index()
    {

        return Inertia::render('Topics/index', [
            'topics' => Topic::all()->map(function ($topic) {
                return [
                    'id' => $topic->id,
                    'name' => $topic->name,
                    'image' => asset('storage/' . $topic->image),

                ];
            })
        ]);
    }

    public function create()
    {
        return Inertia::render('Topics/Create');
    }


    public function store(Request $request)
    {

        $image = $request->file('image')->store('topics', 'public');

        Topic::create([
            'name' => $request->input('name'),
            'image' => $image
        ]);

        return redirect(route('topics.index'))->with('message', 'Topic Added Succefully');
    }

    public function edit(Topic $topic)
    {
        return Inertia::render('Topics/edit', [
            'topic' => $topic,
            'image' => asset('storage/' . $topic->image)
        ]);
    }

    public function update(Request $request)
    {
        $topic = Topic::where('id', $request->topic_id)->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('topics', 'public');
        } else {
            $image = $topic->image;
        }


        Topic::where('id', $request->topic_id)->update([
            'name' => $request->input('name'),
            'image' => $image
        ]);

        return redirect(route('topics.index'))->with('message', 'Topic updated Succefully');
    }

    public function destroy(Topic $topic)
    {
        Storage::delete('public/' . $topic->image);
        $topic->delete();
        return Redirect::route('topics.index');
    }
}
