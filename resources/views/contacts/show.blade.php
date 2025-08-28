<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $contact->full_name }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('contacts.edit', $contact) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Contact
                </a>
                <a href="{{ route('companies.show', $contact->company) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    View Company
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

            <!-- Contact Header -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-start space-x-6">
                        @if($contact->headshot_path)
                            <img src="{{ $contact->headshot_url }}" alt="{{ $contact->full_name }}" class="w-24 h-24 rounded-lg object-cover">
                        @else
                            <div class="w-24 h-24 bg-gray-300 rounded-lg flex items-center justify-center">
                                <span class="text-gray-600 font-semibold text-2xl">{{ substr($contact->first_name, 0, 1) }}{{ substr($contact->last_name, 0, 1) }}</span>
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $contact->full_name }}</h1>
                            
                            @if($contact->job_title)
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-4">
                                    {{ $contact->job_title }}
                                </div>
                            @endif
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    @if($contact->email)
                                        <div class="flex items-center text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <a href="mailto:{{ $contact->email }}" class="hover:text-blue-600">{{ $contact->email }}</a>
                                        </div>
                                    @endif
                                    
                                    @if($contact->phone)
                                        <div class="flex items-center text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <a href="tel:{{ $contact->phone }}" class="hover:text-blue-600">{{ $contact->phone }}</a>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="text-sm text-gray-500">
                                    <p>Created: {{ $contact->created_at->format('M j, Y') }}</p>
                                    <p>Updated: {{ $contact->updated_at->format('M j, Y') }}</p>
                                </div>
                            </div>
                            
                            @if($contact->user_general_note)
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                    <h3 class="font-medium text-gray-900 mb-2">Notes</h3>
                                    <p class="text-gray-700">{{ $contact->user_general_note }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Information -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>
                    
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center space-x-4">
                            @if($contact->company->logo_path)
                                <img src="{{ $contact->company->logo_url }}" alt="{{ $contact->company->name }}" class="w-16 h-16 rounded-lg object-cover">
                            @else
                                <div class="w-16 h-16 bg-gray-300 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-600 font-semibold text-lg">{{ substr($contact->company->name, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <div class="flex-1">
                                <h4 class="text-lg font-medium text-gray-900">{{ $contact->company->name }}</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                    <div>
                                        @if($contact->company->email)
                                            <div class="flex items-center text-sm text-gray-600 mb-1">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                <a href="mailto:{{ $contact->company->email }}" class="hover:text-blue-600">{{ $contact->company->email }}</a>
                                            </div>
                                        @endif
                                        
                                        @if($contact->company->phone)
                                            <div class="flex items-center text-sm text-gray-600 mb-1">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                                <a href="tel:{{ $contact->company->phone }}" class="hover:text-blue-600">{{ $contact->company->phone }}</a>
                                            </div>
                                        @endif
                                        
                                        @if($contact->company->website)
                                            <div class="flex items-center text-sm text-gray-600 mb-1">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                </svg>
                                                <a href="{{ $contact->company->website }}" target="_blank" class="hover:text-blue-600">{{ $contact->company->website }}</a>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div>
                                        @if($contact->company->full_address)
                                            <div class="flex items-start text-sm text-gray-600 mb-1">
                                                <svg class="w-4 h-4 mr-1 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span>{{ $contact->company->full_address }}</span>
                                            </div>
                                        @endif
                                        
                                        <div class="text-sm text-gray-500 mt-2">
                                            <p>{{ $contact->company->contacts->count() }} total contacts</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('companies.show', $contact->company) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View Company
                                </a>
                                <a href="{{ route('companies.contacts', $contact->company) }}" class="inline-flex items-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View All Contacts
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
