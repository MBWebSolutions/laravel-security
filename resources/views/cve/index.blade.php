<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List of CPE-Name checked') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="px-6 py-4 grid grid-cols-2 gap-3">
                    <div>
                        <a href="{{ url('/cve/create') }}"
                            class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out">New
                            search</a>
                    </div>
                    <div style="width:100%;display:flex;flex-direction:row;place-content: flex-end;">
                        <form action="{{ route('cve.index') }}" method="GET" class="left-0 top-0" style="margin-right: 15px;">
                            <input type="text" name="search" placeholder="Search...">
                            <button class="bg-blue-500 text-white font-semibold rounded-lg shadow-md ml-5 px-4 py-2"
                                type="submit">filter results</button>
                        </form>
                        @if(isset($_GET['search']))
                        <a href="{{ route('cve.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out">Reset</a>
                        @endif
                    </div>
                </div>
                <table class="border-collapse table-auto w-full text-sm">
                    <thead>
                        <th
                            class="border dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            id_cve</th>
                        <th
                            class="border dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            publication_date</th>
                        <th
                            class="border dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            threat</th>
                        <th
                            class="border dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            threat_score</th>
                        <th
                            class="border dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            description</th>
                    </thead>
                    <tbody>
                        @if ($cves->isNotEmpty())
                            @foreach ($cves as $cve)
                                <tr>
                                    <td class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                                        style="min-width:200px;"><a
                                            class="text-blue-600/100 p-4 border rounded-sm border-sky-600 hover:bg-sky-600 hover:text-white"
                                            href="{{ url('/cve/show/' . $cve->id) }}">{{ $cve->id_cve }}</a></td>
                                    <td
                                        class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $cve->publication_date }}</td>
                                    <td class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400"
                                        style="min-width:170px;">{{ $cve->threat }}</td>
                                    <td
                                        class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $cve->threat_score }}</td>
                                    <td
                                        class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $cve->description }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>No record found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if ($cves->isNotEmpty())
                    {{ $cves->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
