<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    /**
     * Perform a general search across contacts and companies.
     */
    public function generalSearch(Request $request)
    {
        $query = $request->get('q', '');
        
        if (empty($query)) {
            return redirect()->back();
        }

        // Search in contacts with company information
        $contacts = Contact::with('company')
            ->where(function (Builder $q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('phone', 'like', "%{$query}%")
                  ->orWhere('job_title', 'like', "%{$query}%")
                  ->orWhereHas('company', function (Builder $companyQuery) use ($query) {
                      $companyQuery->where('name', 'like', "%{$query}%");
                  });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(15);

        return view('search.results', compact('contacts', 'query'));
    }

    /**
     * Show the advanced search form.
     */
    public function advancedSearch()
    {
        return view('search.advanced');
    }

    /**
     * Perform an advanced search with multiple filters.
     */
    public function advancedSearchResults(Request $request)
    {
        $query = Contact::with('company');

        // Apply filters if provided
        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', "%{$request->first_name}%");
        }

        if ($request->filled('last_name')) {
            $query->where('last_name', 'like', "%{$request->last_name}%");
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', "%{$request->phone}%");
        }

        if ($request->filled('job_title')) {
            $query->where('job_title', 'like', "%{$request->job_title}%");
        }

        if ($request->filled('company_name')) {
            $query->whereHas('company', function (Builder $companyQuery) use ($request) {
                $companyQuery->where('name', 'like', "%{$request->company_name}%");
            });
        }

        if ($request->filled('city')) {
            $query->whereHas('company', function (Builder $companyQuery) use ($request) {
                $companyQuery->where('city', 'like', "%{$request->city}%");
            });
        }

        if ($request->filled('state')) {
            $query->whereHas('company', function (Builder $companyQuery) use ($request) {
                $companyQuery->where('state', 'like', "%{$request->state}%");
            });
        }

        if ($request->filled('country')) {
            $query->whereHas('company', function (Builder $companyQuery) use ($request) {
                $companyQuery->where('country', 'like', "%{$request->country}%");
            });
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'last_name');
        $sortOrder = $request->get('sort_order', 'asc');
        
        if ($sortBy === 'company_name') {
            $query->join('companies', 'contacts.company_id', '=', 'companies.id')
                  ->orderBy('companies.name', $sortOrder)
                  ->orderBy('contacts.last_name', 'asc')
                  ->orderBy('contacts.first_name', 'asc')
                  ->select('contacts.*');
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $contacts = $query->paginate(15)->withQueryString();

        return view('search.results', compact('contacts'));
    }
}
