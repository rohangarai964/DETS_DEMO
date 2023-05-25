
<div class="max-w-4xl mx-auto mt-2">
<x-notifications.notify />
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-orange-900">Item Group</h1>
                <p class="mt-2 text-sm text-orange-700">A list of all Item Groups.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button wire:click="create()"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-orange-700 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-700 focus:ring-offset-2 sm:w-auto">
                    Add Item Group
</button>
            </div>
        </div>
        <div class="flex-col sapce-y-4">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-orange-300">
                            <tr>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                   Group Name
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Created By
                                </th>
                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-yellow-100">

                            @foreach($itemGroup as $row)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $row->id }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $row->group_name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $row->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <button wire:click="edit({{ $row->id }})"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">Edit</button>
                                            <button wire:click="$emit('triggerDelete',{{ $row->id }})" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
   
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                   
                </div>
            </div>
           
        </div>
        <div class="mt-2 bg-yellow-200">
        {{$itemGroup->links()}}
        </div>
    </div>
    @if($isOpen)
        <div class="fixed z-100 w-full h-full bg-gray-500 opacity-75 top-0 left-0"></div>
        <div class="fixed z-101 w-full h-full top-0 left-0 overflow-y-auto">
            <div class="table w-full h-full py-6">
                <div class="table-cell text-center align-middle">
                    <div class="w-50 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-orange-100 rounded-lg text-left overflow-hidden shadow-xl">
                            <div class="text-center mt-6 font-semibold text-orange-800"  >@if($group_id) Edit Item Group
                                @else 
                                Add Item Group
                                @endif
                            </div>
                            <form>
                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    
                                <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Item Group Name</label>
                <input type="text"
                        wire:model="group_name" 
                        class="bg-orange-200 border bg-orange-500 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-200"
                       placeholder=""
                       required="">
                @error('group_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
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
</div>




@push('scripts')

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerDelete', group_id => {
            Swal.fire({
                title: 'Are You Sure?',
                text: 'Item Group will be deleted!',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete!'
            }).then((result) => {
                if (result.value) {
                    @this.call('delete',group_id)
                } else {
                    console.log("Canceled");
                }
            });
        });
    })
</script>
@endpush

