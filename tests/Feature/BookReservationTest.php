<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

       $respose = $this->post('/books',[
            'title'=>'Cool Book Title',
            'author'=>'iuiuiui',
        ]);
        $respose->assertOk();
        $this->assertCount(1,Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post("/books",[
            "title" => "",
            "author" => "Victor"
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post("/books",[
            "title" => "hello",
            "author" => ""
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
//        $this->withoutExceptionHandling();
         $this->post("/books",[
            "title" => "hello",
            "author" => "testing"
        ]);

         $book = Book::first();
        $response = $this->patch("/books/".$book->id,[
            "title" => "New title",
            "author" => "New Author"

        ]);
//        dd(Book::all());

        $this->assertEquals("New title",Book::first()->title);
        $this->assertEquals("New Author",Book::first()->author);
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
//        $this->withoutExceptionHandling();
        $this->post("/books",[
            "title" => "Testing",
            "author" => "testing"
        ]);
        $this->assertCount(1,Book::all());
        $book =  Book::first();
        $res = $this->delete("/books/".$book->id);
        $this->assertCount(0,Book::all());
        $res->assertRedirect("/books");
    }
}
