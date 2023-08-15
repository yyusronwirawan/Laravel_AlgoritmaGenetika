@extends('layouts.dashboard.base')

@section('css')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('') }}plugins/summernote/summernote-bs4.min.css">
@endsection

@section('js')
<!-- Summernote -->
<script src="{{ asset('') }}plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        // Summernote
        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endsection

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
                    <button type="button" class="btn bg-gradient-danger btn-sm" onclick="location.href='{{ route('admin.data_kandidat.index') }}'"><i class="fa-sm fas fa-arrow-left"></i> Kembali</button>
                </div>
                <div class="card-body">
                    @if (!$edit)
                    <form action="{{ route('admin.data_kandidat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    @else
                    <form action="{{ route('admin.data_kandidat.update', $kandidat->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    @endif
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Nama">Nama</label>
                                <input type="text" name="name" class="form-control" id="Nama" value="{{ $edit ? $kandidat->name : '' }}" required placeholder="Masukan Nama">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Foto Profile">Foto Profile</label>
                                <input type="file" name="thumbnail" class="form-control" id="Foto Profile" placeholder="Masukan Foto Profile">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" id="jabatan" value="{{ $edit ? $kandidat->jabatan : '' }}" required placeholder="Masukan Jabatan">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control" id="jurusan" value="{{ $edit ? $kandidat->jurusan : '' }}" required placeholder="Masukan Jurusan">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kelas">Kelas</label>
                                <input type="text" name="kelas" class="form-control" id="kelas" value="{{ $edit ? $kandidat->kelas : '' }}" required placeholder="Masukan Kelas">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="visi">Visi</label>
                                <textarea name="visi" class="summernote" required>{!! $edit ? $kandidat->visi : '' !!}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="misi">Misi</label>
                                <textarea name="misi" class="summernote" required>{!! $edit ? $kandidat->misi : '' !!}</textarea>
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
