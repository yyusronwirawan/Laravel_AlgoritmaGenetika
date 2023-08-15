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
                    <button type="button" class="btn bg-gradient-danger btn-sm" onclick="location.href='{{ route('admin.data_teachers.index') }}'"><i class="fa-sm fas fa-arrow-left"></i> Kembali</button>
                </div>
                <div class="card-body">
                    @if (!$edit)
                    <form action="{{ route('admin.data_teachers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    @else
                    <form action="{{ route('admin.data_teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $teacher->user_id }}">
                    @endif
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="name">Fullname</label>
                                <input name="name" type="name" class="form-control" placeholder="Input Your Fullname" id="name" value="{{ $edit ? $teacher->user->name : '' }}" required autofocus>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" placeholder="Input Your Email" id="email">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Input Your Password" id="password">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input name="password_confirmation" type="password" class="form-control" placeholder="Input Your Password Confirmation" id="password_confirmation">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="phone">Phone</label>
                                <input name="phone" type="text" class="form-control" id="phone" value="{{ $edit ? $teacher->phone : '' }}" required placeholder="Input Phone">
                            </div>

                            <div class="form-group col-md-4">
                                <label>Select Course</label>
                                <select name="course_id" class="form-control form-select" required>
                                    @if ($edit)
                                        <option value="{{ $course->course->id }}" selected>{{ $course->course->name }}</option>
                                    @endif
                                    @foreach ($courses as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
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
