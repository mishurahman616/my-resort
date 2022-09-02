@extends('admin.layouts.app')

@section('title')
    Admins List | My Resort
@endsection 

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center py-3 bg-light rounded"> Existing Admins</h3> 

                <table id="datatable" class="display">
                    <thead>
                        <tr>
                            <th data-sortable="true">Id</th>
                            <th data-sortable="true">Name</th>
                            <th data-sortable="true">Email</th>
                            <th data-sortable="true">Mobile</th>
                            <th data-sortable="true">Address</th>
                            <th data-sortable="true">Added By</th>
                            <th data-sortable="true">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('script')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order:[[0, "asc"]],
            ajax:"{{url('admin/adminsData')}}",
            columns:[
                {data:'id'},
                {data:'name'},
                {data:'email'},
                {data:'mobile'},
                {data:'address'},
                {data:'addedByAdmin'},
                {data:'created_at'},
            ]
        })
    });
</script>
@endsection