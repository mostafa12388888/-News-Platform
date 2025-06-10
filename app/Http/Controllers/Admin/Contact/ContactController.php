<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(Request $request)
    {

        $contacts = Contact::when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
                $q->where('title', 'like', '%' . $request->keyword . '%');
                $q->where('body', 'like', '%' . $request->keyword . '%');
            });
        })->when(!is_null($request->status), function ($query) use ($request) {
            $query->where('status', $request->status);
        })
            ->orderBy($request->searchValue ?? 'id', $request->order ?? 'desc')
            ->paginate($request->number ?? 10);
        return view('Admin.Contacts.index', compact('contacts'));
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 1]);
        return view('Admin.Contacts.show', compact('contact'));
    }
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        Session::flash('success', "Contact has Deleted Successfully");
        return redirect()->route('admin.contacts.index');
    }
}
