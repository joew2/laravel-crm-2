<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $company->name }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('companies.edit', $company) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Company
                </a>
                <a href="{{ route('contacts.create') }}?company_id={{ $company->id }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Contact
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Company Header -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-start space-x-6">
                        @if($company->logo_path)
                            <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="w-24 h-24 rounded-lg object-cover">
                        @else
                            <div class="w-24 h-24 bg-gray-300 rounded-lg flex items-center justify-center">
                                <span class="text-gray-600 font-semibold text-2xl">{{ substr($company->name, 0, 1) }}</span>
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $company->name }}</h1>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    @if($company->email)
                                        <div class="flex items-center text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <a href="mailto:{{ $company->email }}" class="hover:text-blue-600">{{ $company->email }}</a>
                                        </div>
                                    @endif
                                    
                                    @if($company->phone)
                                        <div class="flex items-center text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <a href="tel:{{ $company->phone }}" class="hover:text-blue-600">{{ $company->phone }}</a>
                                        </div>
                                    @endif
                                    
                                    @if($company->website)
                                        <div class="flex items-center text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                            </svg>
                                            <a href="{{ $company->website }}" target="_blank" class="hover:text-blue-600">{{ $company->website }}</a>
                                        </div>
                                    @endif
                                </div>
                                
                                <div>
                                    @if($company->full_address)
                                        <div class="flex items-start text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>{{ $company->full_address }}</span>
                                        </div>
                                    @endif
                                    
                                    <div class="text-sm text-gray-500">
                                        <p>Created: {{ $company->created_at->format('M j, Y') }}</p>
                                        <p>Updated: {{ $company->updated_at->format('M j, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            @if($company->notes)
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                    <h3 class="font-medium text-gray-900 mb-2">Notes</h3>
                                    <p class="text-gray-700">{{ $company->notes }}</p>
                                </div>
                            @endif

                            @if($company->categories->count() > 0)
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                    <h3 class="font-medium text-gray-900 mb-3">Categories</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($company->categories as $category)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium shadow-sm" 
                                                  style="background-color: {{ $category->color }}20; color: {{ $category->color }}; border: 1px solid {{ $category->color }}40;">
                                                <div class="w-2 h-2 rounded-full mr-2" style="background-color: {{ $category->color }}"></div>
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Files -->
            @if($company->files->count() > 0)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Company Files</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($company->files as $file)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            @if($file->isImage())
                                                <svg class="w-8 h-8 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            @elseif($file->isDocument())
                                                <svg class="w-8 h-8 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-8 h-8 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            @endif
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $file->original_name }}</p>
                                                <p class="text-xs text-gray-500">{{ $file->human_file_size }}</p>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ $file->file_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                            <form action="{{ route('companies.files.delete', ['company' => $company, 'file' => $file]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this file?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    @if($file->description)
                                        <p class="text-xs text-gray-600">{{ $file->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Company Contacts -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Contacts ({{ $company->contacts->count() }})</h3>
                        <a href="{{ route('companies.contacts', $company) }}" class="text-blue-600 hover:text-blue-800 text-sm">View All Contacts</a>
                    </div>
                    
                    @if($company->contacts->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($company->contacts->take(6) as $contact)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex items-center space-x-3">
                                        @if($contact->headshot_path)
                                            <img src="{{ $contact->headshot_url }}" alt="{{ $contact->full_name }}" class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                                <span class="text-gray-600 font-semibold text-sm">{{ substr($contact->first_name, 0, 1) }}{{ substr($contact->last_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $contact->full_name }}</p>
                                            @if($contact->job_title)
                                                <p class="text-xs text-gray-500 truncate">{{ $contact->job_title }}</p>
                                            @endif
                                            @if($contact->email)
                                                <p class="text-xs text-gray-500 truncate">{{ $contact->email }}</p>
                                            @endif
                                        </div>
                                        
                                        <a href="{{ route('contacts.show', $contact) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($company->contacts->count() > 6)
                            <div class="mt-4 text-center">
                                <a href="{{ route('companies.contacts', $company) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View all {{ $company->contacts->count() }} contacts →
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No contacts</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by adding contacts to this company.</p>
                            <div class="mt-6">
                                <a href="{{ route('contacts.create') }}?company_id={{ $company->id }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add Contact
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
