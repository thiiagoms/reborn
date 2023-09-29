<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <a
                href="{{ route('dashboard.endpoints.create', ['site' => $site]) }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100
                    focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2
                    dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700
                    dark:hover:border-gray-600 dark:focus:ring-gray-700 px-4 ml-4"
            >
                Add new endpoint
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-alerts/>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <caption class="caption-top mb-4">

                        </caption>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-6">Endpoint</th>
                            <th scope="col" class="px-6 py-6">Frequency</th>
                            <th scope="col" class="px-6 py-6">Frequency Type</th>
                            <th scope="col" class="px-6 py-6">HTTP Method</th>
                            <th scope="col" class="px-6 py-6">Has payload ?</th>
                            <th scope="col" class="px-6 py-6">Created At</th>
                            <th scope="col" class="px-6 py-6">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($endpoints as $endpoint)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $endpoint->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $endpoint->frequency }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $endpoint->frequency_interval }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $endpoint->http }}
                                    </td>
                                    @if($endpoint->payload === true)
                                        <td class="px-6 py-4">
                                            <i class="fa-solid fa-x"></i>
                                        </td>
                                    @else
                                        <td class="px-6 py-4">
                                            <i class="fa-solid fa-check"></i>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4">
                                        {{ $endpoint->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a
                                            href="#"
                                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4
                                                focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5
                                                mr-1.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700
                                                focus:outline-none dark:focus:ring-green-800"
                                        >
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a
                                            href="{{ route('dashboard.endpoints.edit', [
                                                'site' => $site, 'endpoint' => $endpoint
                                                ]) }}"
                                            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4
                                                focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5
                                                mr-1 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700
                                                focus:outline-none dark:focus:ring-yellow-800"
                                        >
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <form
                                            action="{{ route('dashboard.endpoints.destroy', [
                                                'site' => $site, 'endpoint' => $endpoint
                                                ]) }}"
                                            method="POST"
                                            class="inline-block"
                                        >
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4
                                                focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5
                                                mr-1 mb-2 dark:bg-red-600 dark:hover:bg-red-700
                                                focus:outline-none dark:focus:ring-red-800"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="py-6">
                        {{ $endpoints->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
