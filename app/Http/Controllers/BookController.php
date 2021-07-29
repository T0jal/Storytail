<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityBook;
use App\AgeGroup;
use App\Author;
use App\Book;
use App\Page;
use App\TemporaryFile;
use App\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /*TODO:
    Store:
        Criar um "script" que limpe a pasta storage-app-tmp_images de tempos a tempos
        Ligar o user_id ao Auth
    Update:
        Apagar ficheiro da cover antiga
        Apagar ficheiros das páginas antigas
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::withCount('pages')->orderBy('id', 'desc')->paginate(10);

        return view('pages.books.index', ['books' => $books]);
    }

    public function indexByIdAsc()
    {
        $books = Book::withCount('pages')->orderBy('id', 'asc')->paginate(10);

        return view('pages.books.index', ['books' => $books]);
    }

    public function indexByTitleAtoZ()
    {
        $books = Book::withCount('pages')->orderBy('title', 'asc')->paginate(10);

        return view('pages.books.index', ['books' => $books]);
    }

    public function indexByTitleZtoA()
    {
        $books = Book::withCount('pages')->orderBy('title', 'desc')->paginate(10);

        return view('pages.books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors    = Author::all()->sortBy('last_name');
        $activities = Activity::all()->sortBy('title');
        $ageGroups  = AgeGroup::all();

        return view('pages.books.create',
            ['authors'=> $authors, 'ageGroups'=> $ageGroups, 'activities'=> $activities]);
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
            'user_id'       => 'required',
            'title'         => 'required',
            'description'   => 'required',
            'cover_url'     => 'required',
            'read_time'     => 'required',
            'age_group_id'  => 'required',
            'is_active'     => 'required',
            'access_level'  => 'required',
        ]);

        /*
        CREATING THE book
        */

        $book = new Book();
        $book->user_id          = $request->user_id;
        $book->title            = $request->title;
        $book->description      = $request->description;

        $temporaryFile = TemporaryFile::where('folder', $request->cover_url)->first();
        $book->cover_url        = $temporaryFile->filename;

        $book->read_time        = $request->read_time;
        $book->age_group_id     = $request->age_group_id;
        $book->is_active        = $request->is_active;
        $book->access_level     = $request->access_level;
        $book->save();

        //Deleting the temporary image file
        $cover = $temporaryFile->filename;
        $coverFolderPath = 'app\\tmp\\covers\\' . $temporaryFile->folder . '\\';
        File::delete(storage_path($coverFolderPath . $cover));
        rmdir(storage_path($coverFolderPath));

        /*
        ATTACHING THE author(s)
        */
        foreach($request->author_id as $author)
        {
            $book->authors()->attach($author);
        }

        /*
        CREATING THE page(s)
        */
        $index = 1;
        $pagesFolderPath = 'app\\tmp\\pages\\' . '\\';

        if($request->audio_url)
        {
            $audioIndex = 0;
            $audiosFolderPath = 'app\\tmp\\audios\\' . '\\';
        }

        foreach($request->page_image_url as $page_image_url)
        {
            $page = new Page();
            $page->book_id          = $book->id;
            $page->page_image_url   = $page_image_url;
            if($request->audio_url)
            {
                $audio                  = $request->audio_url[$audioIndex];
                $page->audio_url        = $audio;
                $audioIndex++;
            }
            $page->page_index       = $index;
            $page->save();

            $index++;

            //Deleting the temporary files
            File::delete(storage_path($pagesFolderPath . $page_image_url));
            if($request->audio_url)
            {
                File::delete(storage_path($audiosFolderPath . $audio));
            }
        }

        /*
        CREATING THE video
        */
        $video = new Video();
        $video->book_id     = $book->id;
        $video->title       = $request->title;
        $video->video_url   = $request->video_url;
        $video->save();

        /*
        CREATING THE activityBook
        */
        foreach($request->activity_id as $activity_id)
        {
            $ActivityBook = new ActivityBook();
            $ActivityBook->book_id      = $book->id;
            $ActivityBook->activity_id  = $activity_id;
            $ActivityBook->save();
        }

        /*
       ATTACHING THE tags
       */
        if($request->tags)
        {
            $tags = explode(", ", $request->tags);
            $book->tag($tags);
        }

        return redirect('/admin/books')->with('status', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $nextBookId = ($book->id)+1;
        $nextBook = Book::where('id', $nextBookId)->get()->first();
        if($nextBook != null)
            $next = $nextBookId;
        else
            $next = 0;

        $previousBookId = ($book->id)-1;
        $previousBook = Book::where('id', $previousBookId)->get()->first();
        if($previousBook != null)
            $previous = $previousBookId;
        else
            $previous = 0;

        $list = $book->tagged;
        $tags = $list->implode('tag_name',', ');

        return view('pages.books.show', ['book' => $book, 'next'=>$next, 'previous'=> $previous, 'tags' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all()->sortBy('last_name');
        $activities = Activity::all()->sortBy('title');
        $ageGroups = AgeGroup::all();
        $activityBooks = ActivityBook::all();
        $list = $book->tagged;
        $tags = $list->implode('tag_name', ', ');

        return view('pages.books.edit',
            ['book' => $book, 'authors'=> $authors, 'ageGroups'=> $ageGroups, 'activities'=> $activities, 'activityBooks' => $activityBooks, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        /*
        UPDATING THE book
        */

        $this->validate($request, [
//            'user_id'       => 'required',
            'title'         => 'required',
            'description'   => 'required',
//            'cover_url'     => 'required',
            'read_time'     => 'required',
            'age_group_id'  => 'required',
            'is_active'     => 'required',
            'access_level'  => 'required',
//            'page_image_url'=> 'required',
        ]);

        $book->title            = $request->title;
        $book->description      = $request->description;

        if($request->cover_url != null)
        {
            $temporaryFile = TemporaryFile::where('folder', $request->cover_url)->first();
            $book->cover_url        = $temporaryFile->filename;
        }

        $book->read_time        = $request->read_time;
        $book->age_group_id     = $request->age_group_id;
        $book->is_active        = $request->is_active;
        $book->access_level     = $request->access_level;
        $book->save();

        //Deleting the temporary file for the cover
        if ($request->cover_url != null)
        {
            $cover = $temporaryFile->filename;
            $coverFolderPath = 'app\\tmp\\covers\\' . $temporaryFile->folder . '\\';
            File::delete(storage_path($coverFolderPath . $cover));
            rmdir(storage_path($coverFolderPath));
        }

        /*
        UPDATING THE author(s)
        */
        //If the book has authors detach all the authors (to allow empty)
        if($book->authors())
            $book->authors()->detach();

        //If the request has authors attach the new authors, otherwise it stays empty
        if($request->author_id)
        {
            foreach($request->author_id as $author)
            {
                $book->authors()->attach($author);
            }
        }

        /*
        UPDATING THE page(s)
        */
        if($request->page_image_url[0] != null)
        {
            //Delete all the pages.
            $oldPages = Page::where('book_id', $book->id)->get()->all();
            foreach($oldPages as $oldPage)
            {
                $oldPage->delete();
            }

            //Create the new pages and delete the temporary files.
            $index = 1;
            $pagesFolderPath = 'app\\tmp\\pages\\' . '\\';

            if($request->audio_url)
            {
                $audioIndex = 0;
                $audiosFolderPath = 'app\\tmp\\audios\\' . '\\';
            }

            foreach($request->page_image_url as $page_image_url)
            {
                $page = new Page();
                $page->book_id          = $book->id;
                $page->page_image_url   = $page_image_url;
                if($request->audio_url[0] != null)
                {
                    $audio                  = $request->audio_url[$audioIndex];
                    $page->audio_url        = $audio;
                    $audioIndex++;
                }
                $page->page_index       = $index;
                $page->save();

                $index++;

                //Deleting the temporary files
                File::delete(storage_path($pagesFolderPath . $page_image_url));
                if($request->audio_url[0] != null)
                {
                    File::delete(storage_path($audiosFolderPath . $audio));
                }
            }
        }
//
//        /*
//        UPDATING THE video
//        */
        //If the book has an associated video, delete it (this allows for empties).
        if(Video::where('book_id', $book->id)->get()->first())
        {
            $video = Video::where('book_id', $book->id)->get()->first();
            $video->delete();
        }

        //If the request brings a video, create the video.
        if($request->video_url)
        {
            $video = new Video();
            $video->book_id     = $book->id;
            $video->title       = $request->title;
            $video->video_url   = $request->video_url;
            $video->save();
        }

//
//        /*
//        UPDATING THE activityBook
//        */
        //If the book has an associated activity, delete it (this allows for empties).
        if(ActivityBook::where('book_id', $book->id)->get()->all())
        {
            $activityBook = ActivityBook::where('book_id', $book->id)->get()->all();
            foreach($activityBook as $activityBook)
            {
                $activityBook->delete();
            }
        }

        //If the request brings any activity, create it and associate it to the book.
        if($request->activity_id)
        {
            foreach($request->activity_id as $activity_id)
            {
                $ActivityBook = new ActivityBook();
                $ActivityBook->book_id      = $book->id;
                $ActivityBook->activity_id  = $activity_id;
                $ActivityBook->save();
            }
        }

        /*
        UPDATING THE tags
        */
        $tags = explode(", ", $request->tags);
        $book->untag();
        $book->tag($tags);

        return redirect('/admin/books')->with('status','Item edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/admin/books')->with('status','Item deleted successfully!');
    }
}
