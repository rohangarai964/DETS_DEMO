<div class="h-auto bg-gray-200">
<x-notifications.notify />
    <div class="container flex justify-center py-20">
       
       <div class="p-3 bg-orange-100 rounded-xl max-w-lg hover:shadow">


        <div class="flex justify-between w-full">

          <img src="{{asset('storage/avatar-g8446795de_1280.png')}}" width="150" class="rounded-lg">

           <div class="ml-2">

            <div class="p-3">
              
              <h3 class="text-2xl">{{$profile->name}}</h3>
            
            </div>
            <div class="p-1">
              
              <h3 class="text-base">Email: {{$profile->email}}</h3>
            
            </div>
            <div class="p-1">
              
              <h3 class="text-sm">User Type: {{($profile->role)?'Aadmin':'Guest'}}</h3>
            
            </div>
<!-- 
            <div class="flex justify-between items-center p-3 bg-gray-200 rounded-lg">

              <div class="mr-3">
                <span class="text-gray-400 block">Article</span>
                <span class="font-bold text-black text-xl">34</span>  
              </div>

              <div class="mr-3">
                <span class="text-gray-400 block">Followers</span>
                <span class="font-bold text-black text-xl">940</span>  
              </div>

              <div>
                <span class="text-gray-400 block">Ratings</span>
                <span class="font-bold text-black text-xl">8.9</span>  
              </div>
              
            </div> -->



           
            
          </div>
          
        </div>


         <div class="flex justify-between items-center mt-2 gap-2">

              <button wire:click="logout()" class="w-full h-12 rounded-md border-2 text-md hover:shadow hover:bg-red-700 hover:border-red-700 hover:text-white ">Logout</button>
              <button class="w-full h-12 rounded-md bg-orange-700 text-white text-md hover:shadow hover:bg-orange-800" wire:click="edit({{$profile->id}})">Change Password</button>
              
            </div>

           
           
          


          

          


         
           
         
       </div>
      
    </div>
    @if($isOpen)
        <div class="fixed z-[102] w-full h-full bg-gray-500 opacity-75 top-0 left-0"></div>
        
        <div class="fixed z-[103] w-full h-full top-0 left-0 overflow-y-auto">

            <div class="table w-full h-full py-6">
                <div class="table-cell text-center align-middle">
                    <div class="w-50 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-orange-100 rounded-lg text-left overflow-hidden shadow-xl">
                        <div class="text-center mt-6 font-semibold text-orange-800" >Change Password
                            </div>
                            <form>
                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                              
                      <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Old Password</label>
                <input type="password"
                        wire:model="old_password" 
                        class="bg-orange-200 border bg-orange-200 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                       placeholder=""
                       required="">
                @error('old_password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">New Password</label>
                <input type="password"
                        wire:model="password" 
                        class="bg-orange-200 border bg-orange-200 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                       placeholder=""
                       required="">
                @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Password</label>
                <input type="password"
                        wire:model="confirmPassword" 
                        class="bg-orange-200 border bg-orange-200 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                       placeholder=""
                       required="">
                @error('confirmPassword') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
           
                                
                                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="mt-3 flex w-full sm:ml-3 sm:w-auto">
                                    <button wire:click.prevent="store()" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-orange-700 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-900 focus:ring-offset-2 sm:w-auto">Save</button>
                                </span>
                                <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
                                    <button wire:click="closeModal()" type="button" class="inline-flex bg-red-600 hover:bg-red-800 border border-gray-300 text-white  py-2 px-4 rounded">Cancel</button>
                                </span>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
  </div>