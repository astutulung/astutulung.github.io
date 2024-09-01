@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Dashboard</h5>
            <div class="d-flex justify-content-between align-items-center row gx-5 pt-4 gap-5 gap-md-0">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
    </div>
@endsection
