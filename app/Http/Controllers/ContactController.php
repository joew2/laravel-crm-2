<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with('company')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(15);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('contacts.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'user_general_note' => 'nullable|string',
            'headshot' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contact = Contact::create($request->except(['headshot']));

        // Handle headshot upload
        if ($request->hasFile('headshot')) {
            $headshotPath = $request->file('headshot')->store('contact-headshots', 'public');
            $contact->update(['headshot_path' => $headshotPath]);
        }

        return redirect()->route('contacts.show', $contact)
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $contact->load('company');
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $companies = Company::orderBy('name')->get();
        return view('contacts.edit', compact('contact', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'user_general_note' => 'nullable|string',
            'headshot' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contact->update($request->except(['headshot']));

        // Handle headshot upload
        if ($request->hasFile('headshot')) {
            // Delete old headshot if exists
            if ($contact->headshot_path) {
                Storage::disk('public')->delete($contact->headshot_path);
            }
            
            $headshotPath = $request->file('headshot')->store('contact-headshots', 'public');
            $contact->update(['headshot_path' => $headshotPath]);
        }

        return redirect()->route('contacts.show', $contact)
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        // Delete headshot if exists
        if ($contact->headshot_path) {
            Storage::disk('public')->delete($contact->headshot_path);
        }

        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    /**
     * Display contacts for a specific company.
     */
    public function companyContacts(Company $company)
    {
        $contacts = $company->contacts()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(15);

        return view('contacts.company', compact('company', 'contacts'));
    }
}
