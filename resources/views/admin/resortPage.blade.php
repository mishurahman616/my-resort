@extends('admin.layouts.app')

@section('title')
    Resort List | My Resort
@endsection 

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center py-3 bg-light rounded"> Manage Resorts</h3> 

                <table id="datatableResort" class="display">
                    <thead>
                        <tr>
                            <th data-sortable="true">Id</th>
                            <th data-sortable="true">Type</th>
                            <th data-sortable="true">Desc</th>
                            <th data-sortable="true">No. of Rooms</th>
                            <th data-sortable="true">Price</th>
                            <th data-sortable="true">Images</th>
                            <th data-sortable="true">Edit</th>
                            <th data-sortable="true">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
            
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal for delete Resort -->
<div class="modal fade" id="resortDeleteModal" tabindex="-1" aria-labelledby="resortDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resortDeleteModalLabel">Are you sure to delete?</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <h6 class="text-left ml-3 pt-2" id="resortDeleteTitle"></h6>
            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="resortDeleteConfirmation"   data-id=""  class="btn btn-danger">Delete</button>
            </div>
      </div>
    </div>
</div> <!-- Delete Resort  Modal End  -->
@endsection


@section('script')
<script>
    $(document).ready(function(){
        $('#datatableResort').DataTable({
            processing: true,
            serverSide: true,
            order:[[0, "asc"]],
            ajax:"{{url('admin/getResortData')}}",
            columns:[
                {data:'id'},
                {data:'type'},
                {data:'desc'},
                {data:'room'},
                {data:'price'},
                {data:'images'},
                {data:'edit'},
                {data:'delete'},
            ]
        })
    });

    $(document).on('click', '.deleteResort', function(event){
        event.preventDefault();
        let title = $(this).data('title');
        let id = $(this).data('id');
        $('#resortDeleteModal').modal('show');
        $('#resortDeleteTitle').html("id: "+id+" - "+title);
        $('#resortDeleteConfirmation').attr('data-id', id);
    });

    $(document).on('click', '#resortDeleteConfirmation', function () {
    var id = $('#resortDeleteConfirmation').attr('data-id');

        //calling the api with id
        deletResort(id);
    });

    /**
 * It's a function that takes an id as a parameter, and then it makes an axios post request to the
 * server, and then delete the resort with the id.
 * @param id - id
 */
function deletResort(id) {

    axios.post('/admin/deleteResort', { id: id }).then(function (response) {
        if (response.status == 200) {
            if (response.data == 1) {
                $('#resortDeleteModal').modal('hide');
                location.reload();
            } else {
                $('#resortDeleteModal').modal('hide');
                window.reload();
            }
        } else {
            $('#resortDeleteModal').modal('hide');
        }
    }).catch(function (error) {
        $('#resortDeleteModal').modal('hide');
    });

}
</script>
@endsection