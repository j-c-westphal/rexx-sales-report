<?php

namespace App\Http\Controllers;

use App\Report;
use App\Sale;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        define('VERSION_IS_LOWER', -1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.create', ['fields' => [
            'slug' => 'text',
            'file' => 'file'
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required',
            'file' => 'required|file|mimetypes:text/plain'
        ]);

        $sales = json_decode($request->file->get(), true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return redirect()->route('reports.create')
                ->withErrors(['Beim Lesen der JSON Daten ist ein Fehler aufgetreten.']);
        }

        $report = Report::create(['slug' => $request->slug]);

        foreach ($sales as $sale) {
            if (VERSION_IS_LOWER === version_compare($sale['version'], '1.0.17+60')) {
                $date = Carbon::parse($sale['sale_date'], 'Europe/Berlin')->setTimezone('UTC');
            } else {
                $date = Carbon::parse($sale['sale_date'], 'UTC');
            }

            $sale['sale_date'] = $date->toDateTimeString();

            $sale = collect($sale)->except(['product_id', 'product_name', 'product_price'])->toArray();
            $product = collect($sale)->only(['product_id', 'product_name', 'product_price'])->toArray();

            $report->sales()->create($sale)->product()->firstOrCreate($product);
        }

        return redirect()->route('reports.create')
            ->with('success', 'Sales Report erfolgreich importiert.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $customers = $report->sales()->pluck('customer_name')->unique();
        $products = Product::select('ref', 'name')->distinct()->get()->toArray();

        return view('reports.show', compact('report', 'customers', 'products'));
    }
}
