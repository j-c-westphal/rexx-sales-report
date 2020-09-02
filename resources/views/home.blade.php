@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Report auswählen') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="list-group">
                        @foreach ($reports as $report)
                            <a class="list-group-item list-group-item-action"
                               href="{{ route('reports.show', $report->id) }}">
                                #{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }} {{ $report->slug }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
