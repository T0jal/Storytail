<?php

namespace App\Http\Controllers;

use App\Author;
use App\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::orderBy('id', 'desc')->paginate(10);

        return view('pages.authors.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name'        =>'required',
            'last_name'         =>'required',
            'description'       =>'required',
            'author_photo_url'  =>'required',
            'nationality'       =>'required'
        ]);

        $author = new Author();
        $author->first_name           = $request->first_name;
        $author->last_name            = $request->last_name;
        $author->description          = $request->description;

        $temporaryFile = TemporaryFile::where('folder', $request->author_photo_url)->first();
        $author->author_photo_url     = $temporaryFile->filename;

        $author->nationality        = $request->nationality;
        $author->save();

        //Deleting the temporary image file
        $image = $temporaryFile->filename;
        $folderPath = 'app\\tmp\\authorPhoto\\' . $temporaryFile->folder . '\\';
        File::delete(storage_path($folderPath . $image));
        rmdir(storage_path($folderPath));

        return redirect('/admin/authors')->with('status','Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $nextAuthorId = ($author->id)+1;
        $nextAuthor = Author::where('id', $nextAuthorId)->get()->first();
        if($nextAuthor != null)
            $next = $nextAuthorId;
        else
            $next = 0;
        $previousAuthorId = ($author->id)-1;
        $previousAuthor = Author::where('id', $previousAuthorId)->get()->first();
        if($previousAuthor != null)
            $previous = $previousAuthorId;
        else
            $previous = 0;

        return view('pages.authors.show', ['author' => $author, 'next'=>$next, 'previous'=> $previous]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('pages.authors.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        /*
        UPDATING THE author
        */
        $author->first_name                 = $request->first_name;
        $author->last_name                  = $request->last_name;
        $author->description                = $request->description;
        if($request->author_photo_url != null)
        {
            $temporaryFile = TemporaryFile::where('folder', $request->author_photo_url)->first();
            $author->author_photo_url       = $temporaryFile->filename;
        }
        $author->nationality        = $request->nationality;
        $author->save();

        //Deleting the temporary file for the cover
        if ($request->author_photo_url != null)
        {
            $photo = $temporaryFile->filename;
            $authorPhotoFolderPath = 'app\\tmp\\authorPhoto\\' . $temporaryFile->folder . '\\';
            File::delete(storage_path($authorPhotoFolderPath . $photo));
            rmdir(storage_path($authorPhotoFolderPath));
        }

        return redirect('/admin/authors')->with('status','Author edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('/admin/authors')->with('status','Item deleted successfully!');
    }
}
