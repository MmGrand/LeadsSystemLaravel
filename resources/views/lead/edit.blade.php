@extends('layouts.app')

@section('title',  __('Edit lead'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">{{ __('Edit Lead') }}</h1>
                <form id="edit-lead-form" action="{{ route('leads.update', $lead->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="first_name">{{ __('First Name') }}</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $lead->first_name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="last_name">{{ __('Last Name') }}</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $lead->last_name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ $lead->phone }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">{{ __('E-mail') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ $lead->email }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="message">{{ __('Appeal') }}</label>
                        <textarea name="message" class="form-control" rows="4" required>{{ $lead->message }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" class="form-control" required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" {{ $lead->status == $status->id ? 'selected' : '' }}>
                                    {{ __($status->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" id="save-button" class="btn btn-success" disabled>{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('edit-lead-form');
            const saveButton = document.getElementById('save-button');
            const initialData = new FormData(form);

            form.addEventListener('input', function() {
                const currentData = new FormData(form);
                let isChanged = false;

                for (let [key, value] of currentData.entries()) {
                    if (value !== initialData.get(key)) {
                        isChanged = true;
                        break;
                    }
                }

                saveButton.disabled = !isChanged;
            });
        });
    </script>
@endsection
