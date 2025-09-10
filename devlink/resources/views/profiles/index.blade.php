@extends('layouts.app')

@section('content')
<h1>Perfis</h1>
<ul>
    @foreach($profiles as $profile)
        <li>
            <a href="{{ route('profiles.show', $profile) }}">
                {{ $profile->first_name }} {{ $profile->last_name }}
            </a>
        </li>
    @endforeach
</ul>

{{ $profiles->links() }}
@endsection
