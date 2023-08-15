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
                    <button type="button" class="btn bg-gradient-info btn-sm" onclick="event.preventDefault(); document.getElementById('form-generate').submit();"><i class="fa-sm fas fa-sync-alt"></i> Generate Data</button>
                    <form id="form-generate" action="{{ route('admin.data_schedules.store') }}" method="POST">
                        @csrf
                    </form>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Teacher</th>
                                <th>Classroom</th>
                                <th>Room</th>
                                <th>Course</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Created At</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration <= 9 ? '0'.$loop->iteration : $loop->iteration }}</td>
                                    <td>{{ $item->day->name }}</td>
                                    <td>{{ $item->time->time_start." - ".$item->time->time_end }}</td>
                                    <td>{{ empty($item->teacher_id) ? 'Nama Guru' : $item->teacher->name }}</td>
                                    <td>{{ $item->classroom->name }}</td>
                                    <td>{{ $item->classroom->room->name }}</td>
                                    <td>{{ $item->course->name }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>{{ $item->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                                    {{-- <td>
                                        <button type="button" class="btn bg-gradient-primary btn-sm" onclick="location.href='{{ route('admin.data_schedules.edit', $item->id) }}'"><i class="fa-sm fas fa-pencil-alt"></i></button>
                                        <button type="button" class="btn bg-gradient-danger btn-sm" onclick="event.preventDefault(); document.getElementById('form-delete-{{ $item->id }}').submit();"><i class="fa-sm fas fa-trash-alt"></i></button>
                                        <form id="form-delete-{{ $item->id }}" method="POST" action="{{ route('admin.data_schedules.destroy', $item->id) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Teacher</th>
                                <th>Classroom</th>
                                <th>Room</th>
                                <th>Course</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Created At</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->

@endsection

@section('css')
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('js')
    <!-- Datatables -->
    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "buttons": ["pdf", "print"],
                "lengthChange": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
