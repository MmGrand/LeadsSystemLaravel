@if (isset($errors) && $errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-0" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
