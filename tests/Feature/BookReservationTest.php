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
//        $this->withoutExceptionHandling();

       $respose = $this->post('/books',[
            'title'=>'Cool Book Title',
            'author'=>'Vector',
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

}
