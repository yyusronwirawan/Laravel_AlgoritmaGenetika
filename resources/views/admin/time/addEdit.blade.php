@extends('layouts.dashboard.base')

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">{{ $title }}</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    </div>
    <!-- /.col -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn bg-gradient-danger btn-sm" onclick="location.href='{{ route('admin.data_times.index') }}'"><i class="fa-sm fas fa-arrow-left"></i> Kembali</button>
                </div>
                <div class="card-body">
                    @if (!$edit)
                    <form action="{{ route('admin.data_times.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    @else
                    <form action="{{ route('admin.data_times.update', $time->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    @endif
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="time_start">Time Start</label>
                                <input type="time" name="time_start" class="form-control" id="time-input" step="3600" @if ($edit) value="{{ $time->time_start }}" @endif>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time_end">Time End</label>
                                <input type="time" name="time_end" class="form-control" id="time-input" step="3600" @if ($edit) value="{{ $time->time_end }}" @endif>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection

@section('js')
    <script>
        const timeInput = document.getElementById('time-input');
        const timeValue = timeInput.value;
        console.log('Time input value:', timeValue);
    </script>
@endsection
