@extends('admin.layouts.app')

@section('title')
 Resort Images | My Resort
@endsection



@section('content')
<div class="container">
    <div class="row">
        <div class="col">        
            <h3 class="text-center py-3 bg-light rounded"> Resorts Images</h3> 
            @if(Session::has('fail'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('fail')}}
            </div>
          @elseif(Session::has('success'))
            <div class="alert alert-success" role="alert">
              {{Session::get('success')}}
            </div>
          @endif
        </div>
    </div>
    <div class="row">

            @foreach ($images as $image)
            <div class="card col-md-3">
              <div class="card-body">
                <img class="card-img-top" src="{{$image->link}}" alt="Card image cap">
              </div>
              <div class="card-footer">
                <button class="deleteResortImage" data-id="{{$image->id}}">delete</button>

              </div>
            </div>
            @endforeach

            <div class="card col-md-3">
                <form action="{{route('admin.addResortImages')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <label for="images">Add Images</label>
                        <input class="form-control p-1"  type="file" multiple="multiple" id="images" name="images[]" accept="image/*" > <br/>
                        <input type="hidden" name='resort_id' value="{{$resortId}}">
                        @error('images')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                        @enderror 
                    </div>
                    <div class="card-footer mt-4">
                        <button class="addResortImage float-right btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
    </div>
  </div>


      <!-- Modal for delete Resort Image -->
<div class="modal fade" id="resortImageDeleteModal" tabindex="-1" aria-labelledby="resortImageDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resortImageDeleteModalLabel">Are you sure to delete?</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button id="resortImageDeleteConfirmation"   data-id=""  class="btn btn-danger">Delete</button>
            </div>
      </div>
    </div>
</div> <!-- Delete Resort Image Modal End  -->
@endsection




@section('script')
<script>
        $(document).on('click', '.deleteResortImage', function(event){
        event.preventDefault();
        let id = $(this).data('id');
        $('#resortImageDeleteModal').modal('show');
        $('#resortImageDeleteConfirmation').attr('data-id', id);
    });

    $(document).on('click', '#resortImageDeleteConfirmation', function () {
    var id = $('#resortImageDeleteConfirmation').attr('data-id');

        //calling the api with id
        deletResortImage(id);
    });

    function deletResortImage(id) {
        axios.post('/admin/deleteResortImage', { id: id }).then(function (response) {
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#resortImageDeleteModal').modal('hide');
                    location.reload();
                } else {
                    $('#resortImageDeleteModal').modal('hide');
                    window.reload();
                }
            } else {
                $('#resortImageDeleteModal').modal('hide');
            }
        }).catch(function (error) {
            $('#resortImageDeleteModal').modal('hide');
        });

    }
</script>
@endsection