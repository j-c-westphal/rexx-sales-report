@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ $report->slug }}</div>

                    <div class="card-body" id="report-wrap">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="startDate">{{ __('Datum von') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="startDate">
                                </div>
                                <div class="form-group">
                                    <label for="endDate">{{ __('Datum bis') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="endDate">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer">{{ __('Käufer') }}</label>
                                    <select class="form-control form-control-sm" id="customer">
                                        <option value="">Alle</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer }}">{{ $customer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer">{{ __('Produkt') }}</label>
                                    <select class="form-control form-control-sm" id="product">
                                        <option value="0">Alle</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product['ref'] }}">{{ $product['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

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
                                    <td>{{ $sale->product->ref }}</td>
                                    <td>{{ $sale->product->name }}</td>
                                    <td>{{ $sale->product->price }}</td>
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

                        <div class="d-flex justify-content-center align-items-center" id="loader">
                            <div class="spinner-grow">
                                <span class="sr-only">{{ __('Wird geladen...') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
