@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Report Detail Transaction Order</h5>
                <div class="table-responsive">
                    <div class="mb-3">
                        <form action="{{ route('report.filter') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Date Start</label>
                                    <input type="date" name="date_start" class="form-control" value="" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Date End</label>
                                    <input type="date" name="date_end" class="form-control" value="" required>
                                </div>
                                <div class="col-sm-3 mt-8">
                                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-datatable pt-0">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Service</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($details as $detail)

                                <tr>
                                    <td>{{ $detail->order->customer->customer_name ?? 'N/A'}}</td>
                                    <td>{{ $detail->order->created_at ?? 'N/A'}}</td>
                                    <td>{{ $detail->service->service_name ?? 'N/A'}}</td>
                                    <td>{{ $detail->qty ?? 'N/A'}}</td>
                                    <td>{{ $detail->service->price ?? 'N/A'}}</td>
                                    <td>{{ $detail->subtotal ?? 'N/A'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection