<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

       $respose = $this->post("/author",[
            'name' => 'Author Name 2',
            'dob' => '05/14/1993',
        ]);
        $respose->assertOk();
        $author = Author::all();
        $this->assertCount(1,$author);
        $this->assertEquals('05/14/1993',$author->first()->dob);
    }
}
