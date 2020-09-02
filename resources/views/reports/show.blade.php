@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ $report->slug }}</div>

                    <div class="card-body">
                        <table id="sales" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Verkaufsdatum</th>
                                <th></th>
                                <th>Käufer Name</th>
                                <th>Käufer E-Mail</th>
                                <th>Produkt ID</th>
                                <th>Produkt Name</th>
                                <th>Produkt Preis</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($report->sales as $sale)
                                <tr>
                                    <td>{{ $sale->sale_id }}</td>
                                    <td>{{ $sale->sale_date_formated }}</td>
                                    <td>{{ $sale->sale_date_unix }}</td>
                                    <td>{{ $sale->customer_name }}</td>
                                    <td>{{ $sale->customer_mail }}</td>
                                    <td>{{ $sale->product_id }}</td>
                                    <td>{{ $sale->product_name }}</td>
                                    <td>{{ $sale->product_price }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{ __('Summe') }}: <span></span></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
