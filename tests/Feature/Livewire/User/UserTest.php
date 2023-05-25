<?php

namespace Tests\Feature\Livewire\User;

use App\Http\Livewire\User\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Http\Livewire\Item\Items;

class UserTest extends TestCase
{
    /** @test */
    use RefreshDatabase;
    // public function the_component_can_render()
    // {
       
    //     $component = Livewire::test(Users::class);

    //     $component->assertStatus(200);
    // }
    // public function go_to_items_page(){

    //     $this->withoutExceptionHandling();

    //     $component=$this->actingAs(User::factory()->create(['role'=>'1']));
     
    //     $component->get('/item')
    //          ->assertStatus(200);
    //  }

     public function create_item(){
        
        $this->actingAs(User::factory()->create(['role'=>'1']));
        Livewire::test(Items::class)
        ->set('item_name','ABC')->set('item_group_id','9')->set('item_price',56)->set('description','Ok')->call('store')
        ->assertStatus(200);
     }
}
