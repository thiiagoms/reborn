@csrf()

<div class="grid gap-6 mb-6 md:grid-cols-2">
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Endpoint
        </label>
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Add your site endpoint here"
            value="{{ $endpoint->name ?? old('endpoint') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
    </div>
    <div>
        <label for="http" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            HTTP Method
        </label>
        <select
            id="http"
            name="http"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
            <option selected>Select HTTP method for this endpoint</option>
            @foreach($http as $httpMethod)
                <option value="{{ $httpMethod['id'] }}">
                    {{ $httpMethod['description'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="frequency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Frequency
        </label>
        <input
            type="number"
            id="frequency"
            name="frequency"
            placeholder="Add a frequency to check site"
            value="#"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
    </div>
    <div>
        <label for="frequency_interval" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Frequency type
        </label>
        <select
            id="frequency_interval"
            name="frequency_interval"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
            <option selected>Select a frequency type</option>
            @foreach($frequencies as $frequency)
                <option value="{{ $frequency['id'] }}">
                    {{ ucfirst(strtolower(trans($frequency['description']))) }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<label for="payload" class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-white">Payload</label>
<textarea
    id="payload"
    name="payload"
    rows="4"
    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500
        focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
        dark:focus:ring-blue-500 dark:focus:border-blue-500"
    placeholder="Put a valid JSON here if you want to send a valid payload"></textarea>

<button
    type="submit"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300
        font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700
        focus:ring-blue-800 my-4"
>
    Send
</button>
