<?php

namespace Tests\Feature\Http\Livewire\Item;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
   
     public function go_to_items_page(){
        $this->get('/item')
             ->assertStatus(200);
     }
}
