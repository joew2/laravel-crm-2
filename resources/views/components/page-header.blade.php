@props(['title', 'showSearch' => true])

<div class="space-y-4">
    <!-- Desktop Layout -->
    <div class="hidden md:flex justify-between items-center">
        <!-- Page Title (Left Side) -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>

        <!-- Search and Filter (Right Side) -->
        @if($showSearch)
            <div class="flex items-center space-x-3">
                <!-- General Search -->
                <form action="{{ route('search.general') }}" method="GET" class="flex items-center">
                    <div class="relative">
                        <input type="text" 
                               name="q" 
                               placeholder="Search contacts & companies..." 
                               class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ request('q') }}"
                               aria-label="Search contacts and companies">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Search
                    </button>
                </form>
                
                <!-- Advanced Search Filter Icon -->
                <a href="{{ route('search.advanced') }}" 
                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                   aria-label="Advanced search filters">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                    </svg>
                </a>
            </div>
        @endif

        <!-- Page Actions (Right Side) -->
        <div class="flex items-center space-x-3">
            {{ $slot }}
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="md:hidden space-y-3">
        <!-- Page Title -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>

        <!-- Search (Mobile) -->
        @if($showSearch)
            <div class="space-y-2">
                <form action="{{ route('search.general') }}" method="GET" class="flex items-center">
                    <div class="relative flex-1">
                        <input type="text" 
                               name="q" 
                               placeholder="Search contacts & companies..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ request('q') }}"
                               aria-label="Search contacts and companies">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Search
                    </button>
                </form>
                
                <!-- Advanced Search Link (Mobile) -->
                <div class="flex justify-end">
                    <a href="{{ route('search.advanced') }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                       aria-label="Advanced search filters">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                        </svg>
                        Advanced Search
                    </a>
                </div>
            </div>
        @endif

        <!-- Page Actions (Mobile) -->
        <div class="flex justify-end">
            {{ $slot }}
        </div>
    </div>
</div>
