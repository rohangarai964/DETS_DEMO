

<div class="max-w-4xl mx-auto mt-5">
<x-notifications.notify />
    <div class="px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="save()">
        <div class="mb-6">
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Name</label>
<select  wire:model="Expenditures.item_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
  <option selected>Select</option>

 @foreach($itemDropdown as $item)
            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
            @endforeach
</select>
@error('Expenditures.item_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Expences Date</label>
                <input type="date"
                        wire:model="Expenditures.exp_date" 
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder=""
                       required="">
                @error('Expenditures.exp_date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Qty</label>
                <input type="text"
                        wire:model="Expenditures.qty" 
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder=""
                       required="">
                @error('Expenditures.qty') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            
         <div class="flex Expenditures-center justify-start space-x-4">
                <a href="{{route('user/expenditure')}}" class="text-gray-900  font-medium  text-sm ">Back</a>
                <button type="submit"
                class="inline-flex Expenditures-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Save
                </button>
            </div>
        </form>

    </div>
</div>