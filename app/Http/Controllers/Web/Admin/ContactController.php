<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()
            ->paginate(12);

        return view(
            'admin.contacts.index',
            compact('contacts')
        );
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'designation' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'profile' => [
                'nullable',
                File::image()->max(2048),
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $profilePath = null;

        if ($request->hasFile('profile')) {

            $profilePath = $request
                ->file('profile')
                ->store('contacts', 'public');
        }

        Contact::create([
            'name' => $validated['name'],
            'designation' => $validated['designation'],
            'phone' => $validated['phone'],
            'profile' => $profilePath,
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.contacts.index')
            ->with(
                'success',
                'Contact created successfully.'
            );
    }

    public function show(Contact $contact)
    {
        return view(
            'admin.contacts.show',
            compact('contact')
        );
    }

    public function edit(Contact $contact)
    {
        return view(
            'admin.contacts.edit',
            compact('contact')
        );
    }

    public function update(
        Request $request,
        Contact $contact
    ) {

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'designation' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'profile' => [
                'nullable',
                File::image()->max(2048),
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $data = [
            'name' => $validated['name'],
            'designation' => $validated['designation'],
            'phone' => $validated['phone'],
            'status' => $request->boolean('status'),
        ];

        if ($request->hasFile('profile')) {

            $data['profile'] = $request
                ->file('profile')
                ->store('contacts', 'public');
        }

        $contact->update($data);

        return redirect()
            ->route('admin.contacts.index')
            ->with(
                'success',
                'Contact updated successfully.'
            );
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with(
                'success',
                'Contact deleted successfully.'
            );
    }
}