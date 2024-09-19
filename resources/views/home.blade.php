@extends('layouts.app')

@section('title',  __('Home'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @guest
                    <h1 class="mb-4">{{ __("The client's request form") }}</h1>
                    <form action="{{ route('leads.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="first_name">{{ __('First name') }}</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="last_name">{{ __('Last name') }}</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">{{ __('E-mail') }}</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="message">{{ __('Appeal') }}</label>
                            <textarea name="message" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                    </form>
                @else
                    <h1 class="mb-4">{{ __("Statistics on leads") }}</h1>
                    <h3>{{ __('Total Leads:') }} {{ $leads->count() }}</h3>
                    <ul>
                        @foreach ($statuses as $status)
                            <li>{{ __($status->name) }}: {{ $leads->where('status', $status->id)->count() }}</li>
                        @endforeach
                    </ul>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Edit') }}</th>
                                <th>{{ __('Delete') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $lead)
                                <tr>
                                    <td>{{ $lead->id }}</td>
                                    <td>{{ $lead->first_name }}</td>
                                    <td>{{ $lead->last_name }}</td>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->phone }}</td>
                                    <td>{{ $lead->created_at }}</td>
                                    <td>
                                        <form action="{{ route('leads.updateStatus', $lead->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="this.form.submit()">
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->id }}"
                                                        {{ $lead->status == $status->id ? 'selected' : '' }}>
                                                        {{ __($status->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('leads.delete', $lead->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endguest
            </div>
        </div>
    </div>
@endsection
