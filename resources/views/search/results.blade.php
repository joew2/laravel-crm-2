<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Search Results
                </h2>
                @if(isset($query))
                    <p class="text-sm text-gray-600 mt-1">
                        Found {{ $contacts->total() }} result(s) for "{{ $query }}"
                    </p>
                @endif
            </div>
            <a href="{{ route('search.advanced') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                </svg>
                Advanced Search
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if($contacts->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Info</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($contacts as $contact)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($contact->headshot_path)
                                                        <img src="{{ $contact->headshot_url }}" alt="{{ $contact->full_name }}" class="w-10 h-10 rounded-full object-cover mr-3">
                                                    @else
                                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                                            <span class="text-gray-600 font-semibold text-sm">{{ substr($contact->first_name, 0, 1) }}{{ substr($contact->last_name, 0, 1) }}</span>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $contact->full_name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $contact->first_name }} {{ $contact->last_name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($contact->company->logo_path)
                                                        <img src="{{ $contact->company->logo_url }}" alt="{{ $contact->company->name }}" class="w-8 h-8 rounded-full object-cover mr-2">
                                                    @else
                                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                                                            <span class="text-gray-600 font-semibold text-xs">{{ substr($contact->company->name, 0, 1) }}</span>
                                                        </div>
                                                    @endif
                                                    <a href="{{ route('companies.show', $contact->company) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                                        {{ $contact->company->name }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    @if($contact->email)
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                            </svg>
                                                            <a href="mailto:{{ $contact->email }}" class="hover:text-blue-600">{{ $contact->email }}</a>
                                                        </div>
                                                    @endif
                                                    @if($contact->phone)
                                                        <div class="flex items-center mt-1">
                                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                            </svg>
                                                            <a href="tel:{{ $contact->phone }}" class="hover:text-blue-600">{{ $contact->phone }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    @if($contact->job_title)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            {{ $contact->job_title }}
                                                        </span>
                                                    @else
                                                        <span class="text-gray-400">No title</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('contacts.show', $contact) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                    <a href="{{ route('contacts.edit', $contact) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $contacts->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No results found</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                @if(isset($query))
                                    No contacts or companies found matching "{{ $query }}".
                                @else
                                    No contacts found with the specified criteria.
                                @endif
                            </p>
                            <div class="mt-6 space-x-3">
                                <a href="{{ route('search.advanced') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Try Advanced Search
                                </a>
                                <a href="{{ route('contacts.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    View All Contacts
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
