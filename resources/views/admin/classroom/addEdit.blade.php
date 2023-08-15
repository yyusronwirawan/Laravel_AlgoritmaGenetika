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
                    <button type="button" class="btn bg-gradient-danger btn-sm" onclick="location.href='{{ route('admin.data_classrooms.index') }}'"><i class="fa-sm fas fa-arrow-left"></i> Kembali</button>
                </div>
                <div class="card-body">
                    @if (!$edit)
                    <form action="{{ route('admin.data_classrooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    @else
                    <form action="{{ route('admin.data_classrooms.update', $classroom->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    @endif
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Select Room</label>
                                <select name="room_id" class="form-control form-select" required>
                                    <option selected="selected" value="{{ $edit ? $classroom->room_id : '' }}">{{ $edit ? $classroom->room->name : 'Select Room' }}</option>
                                    @foreach ($room as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Nama">Nama</label>
                                <input type="text" name="name" class="form-control" id="Nama" value="{{ $edit ? $classroom->name : '' }}" required placeholder="Input Name">
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
