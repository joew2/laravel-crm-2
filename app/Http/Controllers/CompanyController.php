<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyFile;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with(['categories'])
            ->withCount('contacts')
            ->orderBy('name')
            ->paginate(15);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        return view('companies.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $company = Company::create($request->except(['logo', 'files', 'categories']));

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company-logos', 'public');
            $company->update(['logo_path' => $logoPath]);
        }

        // Handle multiple file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->store('company-files', 'public');
                
                CompanyFile::create([
                    'company_id' => $company->id,
                    'file_name' => $file->hashName(),
                    'file_path' => $filePath,
                    'file_type' => $file->getClientOriginalExtension(),
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        // Handle categories
        if ($request->has('categories')) {
            $company->categories()->sync($request->categories);
        }

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company->load(['contacts', 'files', 'categories']);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $categories = Category::active()->orderBy('name')->get();
        $company->load('categories');
        return view('companies.edit', compact('company', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $company->update($request->except(['logo', 'files', 'categories']));

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo_path) {
                Storage::disk('public')->delete($company->logo_path);
            }
            
            $logoPath = $request->file('logo')->store('company-logos', 'public');
            $company->update(['logo_path' => $logoPath]);
        }

        // Handle additional file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->store('company-files', 'public');
                
                CompanyFile::create([
                    'company_id' => $company->id,
                    'file_name' => $file->hashName(),
                    'file_path' => $filePath,
                    'file_type' => $file->getClientOriginalExtension(),
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        // Handle categories
        $company->categories()->sync($request->categories ?? []);

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // Delete logo if exists
        if ($company->logo_path) {
            Storage::disk('public')->delete($company->logo_path);
        }

        // Delete all company files
        foreach ($company->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }

        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    /**
     * Delete a specific file from the company.
     */
    public function deleteFile(Company $company, CompanyFile $file)
    {
        if ($file->company_id !== $company->id) {
            abort(403);
        }

        Storage::disk('public')->delete($file->file_path);
        $file->delete();

        return redirect()->back()
            ->with('success', 'File deleted successfully.');
    }

    /**
     * Sync categories for a company.
     */
    public function syncCategories(Request $request, Company $company)
    {
        $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $company->categories()->sync($request->categories ?? []);

        return response()->json([
            'message' => 'Categories updated successfully',
            'categories' => $company->fresh()->categories
        ]);
    }
}
