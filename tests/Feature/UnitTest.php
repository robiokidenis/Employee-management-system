<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_goto_companies_page()
    {
        # code...
        $user = User::first();
        $response = $this->actingAs($user)
            ->get(
                '/companies',
                []
            );
        $response->assertStatus(200)
            ->assertSeeText("DataTable with default feature")
            ->assertDontSeeText("robi");
    }
    public function test_post_new_companies()
    {
        # code...
        $user = User::first();
        Storage::fake('public');

        // $file = UploadedFile::fake()->image('avatar.jpg');
        $file = UploadedFile::fake()->image('image.jpeg',200,200)->size(100);
        // ->storeAs('app/images', 'newfilename.jpeg'); //upload manual
        // dd($file);
        // Storage::disk('public')->assertExists($file->hashName());
        $request = $this->actingAs($user)
            ->post(

                'companies'
                // action('App\Http\Controllers\CompaniesControllee@index')
                ,
                [
                    'name' => $this->faker->name(),
                    'email' => $this->faker->unique()->safeEmail(),
                    'website' => $this->faker->url(),
                    'image' => $file,
                ],
                [
                    'HTTP_X-Requested-With' => 'XMLHttpRequest',
                    // 'content-type'=>'multipart/form-data'
                ]
            )
            // ->seeJson([
            //     'success' => "product created",
            // ])
        ;

        $request->assertStatus(201);
    }
}
