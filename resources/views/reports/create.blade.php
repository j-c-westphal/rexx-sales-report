@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('JSON importieren') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @foreach ($fields as $name => $type)
                                <div class="form-group">
                                    <label for="slug">{{ __('validation.attributes.' . $name) }}</label>

                                    <input
                                        name="{{ $name }}" id="{{ $name }}"
                                        type="{{ $type }}" value="{{ old($name) }}"
                                        class="@error($name) is-invalid @enderror
                                            @if ($type === 'file') form-control-file @else form-control @endif"
                                    >

                                    @error($name) <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary">{{ __('Importieren') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
