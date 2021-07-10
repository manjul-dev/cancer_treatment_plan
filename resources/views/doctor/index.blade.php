@extends('doctor.layout')

@section('content')
<div class="container-fluid">
    <table class="table mdl-data-table table-bordered" id="doctorPlan" style="width: 100%;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>State</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#doctorPlan').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("doctor.index") }}',
                columns: [                    
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'city', name: 'city'},
                    { data: 'state', name: 'state'},
                    { data: 'phone', name: 'phone'},
                    { data: 'action', name: 'action'},
                ]
            });
        });
    </script>    
@endsection