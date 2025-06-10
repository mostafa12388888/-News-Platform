@extends('layouts.dashboard.app')
@section('title')
Contact
@endsection
@section('body')
    <h2 class="text-center">Show Contact : {{ $contact->name }}</h2>
    <br />

    <div class="card-body shadow">
        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Name: {{ $contact->name }}" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="contact Name: {{ $contact->title }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Email: {{ $contact->email }}" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Phone : {{ $contact->phone }}" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <p class=""> {{ $contact->body }}</p>
                </div>
            </div>


        </div>
        <br />
        <a href="javascript:void(0)"
            onclick="if(confirm('are you sure delete :{{ $contact->name }}'))document.getElementById('deletecontact').submit()"
            class="btn btn-primary">Delete <i class="fa fa-trash"></i></a>
        <a href="{{ route('admin.contact.status', $contact->id) }}" class="btn btn-info">{{$contact->status?"Block":"Active"}}</a>
        <a href="mailto:{{$contact->email}}?subject=Re:{{urlEncode($contact->title)}}" class="btn btn-info">Reply <i class="fa fa-reply"></i></a>
        <form id="deletecontact" action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
