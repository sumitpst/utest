<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store()
    {
        Book::create($this->getValidate());
    }

    public function update(Book $book)
    {
        $book->update($this->getValidate());
//       return redirect($book->path());
        // fresh check db
       return redirect($book->fresh()->path());
    }

    /**
     * @return array
     */
    protected function getValidate(): array
    {
        return request()->validate([
            "title" => 'required',
            "author" => 'required'
        ]);
    }

    public function delete(Book $book)
    {
        $book->delete();
        return redirect("/books");
    }
}
