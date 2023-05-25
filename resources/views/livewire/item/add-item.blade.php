

<div class="max-w-4xl mx-auto mt-5">
<x-notifications.notify />
    <div class="px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="save()">
        <div class="mb-6">
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Group Name</label>
<select  wire:model="Items.item_group_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
  <option selected>Select</option>

 @foreach($itemGroupDropdown as $itemgroup)
            <option value="{{ $itemgroup->id }}">{{ $itemgroup->group_name }}</option>
            @endforeach
</select>
@error('Items.item_group_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Item Name</label>
                <input type="text"
                        wire:model="Items.item_name" name="item_name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder=""
                       required="">
                @error('Items.item_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Item Price</label>
                <input type="text"
                        wire:model="Items.item_price" name="item_price"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder=""
                       required="">
                @error('Items.item_price') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                <input type="text"
                        wire:model="Items.description" name="description"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder=""
                       required="">
                @error('Items.description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
         <div class="flex items-center justify-start space-x-4">
                <a href="/item" class="text-gray-900  font-medium  text-sm ">Back</a>
                <button type="submit"
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Save
                </button>
            </div>
        </form>

    </div>
</div>