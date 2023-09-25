@csrf()

<label for="site" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site</label>
<input
    type="text"
    id="name"
    name="name"
    placeholder="Add your site URL here"
    value="{{ $site->name ?? old('site') }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
>

<label for="description" class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-white">Description</label>
<textarea
    id="description"
    name="description"
    rows="4"
    value="{{ $site->description ?? old('description') }}"
    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500
        focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
        dark:focus:ring-blue-500 dark:focus:border-blue-500"
    placeholder="Description for your site service"
>{{ $site->description ?? '' }}</textarea>

<button
    type="submit"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300
        font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700
        focus:ring-blue-800 my-4"
>
    Send
</button>
