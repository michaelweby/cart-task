@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Top 10 Products</h1>
@stop

@section('content')
    <div class="col-sm-12">
        <input class="datepicker" id="start" placeholder="Start date" value="{{ \Carbon\Carbon::now()->subMonth()->format('d/m/Y') }}">
        <input class="datepicker" id="end" placeholder="End date" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
        <button class="btn btn-success" id="filter"> Filter </button>
    </div>

    <div class="col-md-6" id="result">
    @foreach($products as $product)
        <div class="col-md-2">
            {{ $product['id'] }}
        </div>
        <div class="col-md-5">
            {{ $product['name'] }}
        </div>
        <div class="col-md-5">
            {{ $product['quantity'] }}
        </div>
    @endforeach
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script>
        $('#start').datepicker({
            dateFormat: "dd-M-yy",
        })
        $('#end').datepicker({
            dateFormat: "dd-M-yy",
        })
    </script>
    <script>
        $('#filter').on('click',function () {
            let start_date = $('#start').val();
            let end_date = $('#end').val();
            let _token = '{{ csrf_token() }}';

            $.ajax({
                type:'post',
                url:'ajax-filter-top-ten',
                data:{_token:_token,start_date:start_date,end_date:end_date},
                success:function (result) {
                    $('#result').html(result)
                }
            })
        });
    </script>
@stop
