<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow-md w-80">
                <h1 class="text-2xl font-semibold mb-4">Simple Form</h1>
                <form method="POST" action="{{ url('/cve/store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="cpe_name" class="block text-sm font-medium text-gray-700">CpeName</label>
                        <input type="text" id="cpe_name" name="cpe_name" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full">Send</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
