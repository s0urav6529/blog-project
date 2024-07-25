<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tags = (new Tag())->tagListDashboard($request)->paginate(10);

        if ($request->ajax()) {
            return view('backend.modules.tag.table', compact('tags'))->render();
        }

        return view('backend.modules.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        $tag = $request->all();
        $tag['slug'] = Str::slug($request->input('slug'));

        (new Tag())->createTag($tag);

        session()->flash('msg', 'Tag created successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('backend.modules.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('backend.modules.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $upTag = $request->all();
        $upTag['slug'] = Str::slug($request->input('slug'));

        (new Tag())->updateTag($tag, $upTag);

        session()->flash('msg', 'Tag updated successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        (new Tag())->deleteTag($tag);

        session()->flash('msg', 'Tag deleted successfully !');
        session()->flash('notification_color', 'error');

        return redirect()->route('tag.index');
    }
}
