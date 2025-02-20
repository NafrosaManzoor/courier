@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->type == 1)
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <h3>{{ $totalBranches }}</h3>
                        <p>Total Branches</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <h3>{{ $totalParcels }}</h3>
                        <p>Total Parcels</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-boxes"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="small-box bg-light shadow-sm border">
                    <div class="inner">
                        <h3>{{ $totalStaff }}</h3>
                        <p>Total Staff</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <hr>
            @foreach($statusCounts as $status => $count)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="small-box bg-light shadow-sm border">
                        <div class="inner">
                            <h3>{{ $count }}</h3>
                            <p>{{ $status }}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-boxes"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    Welcome {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
