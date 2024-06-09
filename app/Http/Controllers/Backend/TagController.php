<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewView;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tag_data = Tag::orderBy('order_by')->paginate(10);
        return view('backend.modules.tag.index', compact('tag_data'));
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
        $tag_data = $request->all();
        $tag_data['slug'] = Str::slug($request->input('slug'));

        Tag::create($tag_data);

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
        $tag_data = $request->all();
        $tag_data['slug'] = Str::slug($request->input('slug'));

        $tag->update($tag_data);

        session()->flash('msg', 'Tag updated successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('msg', 'Tag deleted successfully !');
        session()->flash('notification_color', 'error');

        return redirect()->route('tag.index');
    }
}
