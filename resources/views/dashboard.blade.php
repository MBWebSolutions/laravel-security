<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Last CPE-Name checked') }}
                </div>
                <div class="relative rounded-xl overflow-auto">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <th
                                class="border dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                id_cve</th>
                            {{-- <th class="border dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">description</th> --}}
                            <th
                                class="border dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                last_update</th>
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
                                url_recerences</th>
                        </thead>
                        <tbody>
                            @if (!empty($cve))
                                <tr>
                                    <td class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                                        style="min-width:170px;"><a class="" href="{{ url('/cve/show/' . $cve->id) }}">{{ $cve->id_cve }}</a></td>
                                    {{-- <td class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400" style="max-height:200px;overflow:hidden;display:block;">{{ $cve->description }}</td> --}}
                                    <td
                                        class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $cve->last_update }}</td>
                                    <td
                                        class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $cve->publication_date }}</td>
                                    <td class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400"
                                        style="min-width:170px;">{{ $cve->threat }}</td>
                                    <td
                                        class="border border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $cve->threat_score }}</td>
                                    <td
                                        class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                        {{ $cve->url_recerences }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>No record found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
