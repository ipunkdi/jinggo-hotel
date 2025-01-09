@extends('layouts.email')

@section('content')
<div>
    <h2 class="text-xl font-semibold text-gray-800">Hello, {{ $user->email }}</h2>
    <p class="mt-4 text-gray-600">
        Thank you for registering. Please click the button below to verify your account:
    </p>
    <a href="{{ $link_verifikasi }}" 
    class="inline-block mt-6 px-6 py-3 bg-amber-600 text-white font-medium text-sm rounded shadow hover:bg-amber-700 transition">
        Join now
    </a>
</div>
@endsection
