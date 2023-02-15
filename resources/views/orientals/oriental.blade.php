@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="card-body">
  <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
    <div class="row mb-2">
      <div class="col-sm-12 col-md-6">
        <div class="btn-group flex-wrap">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
            Thêm thuốc
          </button>

          <div class="modal fade" id="modal-default" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Thêm thuốc</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('adminStoreOriental.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="name_Oriental">Tên thuốc:</label>
                      <input type="text" class="form-control text-center" name="name_Oriental" placeholder="Tên thuốc">
                      @error('name_Oriental')
                      <span class="text-danger">Không được để trống ô này</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="note_Oriental">Chú thích</label>
                      <textarea class="form-control" rows="4" placeholder="Ghi chú ..." name="note_Oriental"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Thêm</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
          <thead>
            <tr>
              <th class="sorting text-center" aria-controls="example1" rowspan="1" colspan="1" style="width: 1%">STT</th>
              <th class="sorting sorting_asc text-center" aria-controls="example1" rowspan="1" style="width: 20%">Tên thuốc</th>
              <th class="sorting text-center" aria-controls="example1" rowspan="1" colspan="1" style="width: 30%">Chú thích</th>
              <th class="sorting text-center" aria-controls="example1" rowspan="1" colspan="1" style="width: 15%"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($storeOrientals as $storeOriental)
            <tr>
              <td class="text-center">{{$storeOriental->id}}</td>
              <td class="text-center">{{$storeOriental->name_Oriental}}</td>
              <td class="text-center">{{$storeOriental->note_Oriental}}</td>
              <td class="row text-center">
                <div class="col-md-12 col-lg-6">
                  <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteOriental({{$storeOriental->id}})">
                    <i class="fas fa-trash">
                    </i>
                    Xóa
                  </button>
                  <form id="delete-form-{{$storeOriental->id}}" action="{{ route('adminStoreOriental.destroy', ['storeOriental' => $storeOriental->id]) }}" method="post" >
                    @csrf
                    @method("DELETE")

                  </form>
                </div>
                <div class="col-md-12 col-lg-6">
                  <button type="button" class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#modal-lg-{{$storeOriental->id}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Sửa
                  </button>
                  <div class="modal fade show" id="modal-lg-{{$storeOriental->id}}" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4>Sửa thuốc</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('adminStoreOriental.update', ['storeOriental' => $storeOriental->id]) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group text-left">
                              <label for="name_Oriental">Tên thuốc:</label>
                              <input type="text" class="form-control text-center" value="{{$storeOriental->name_Oriental}}">
                            </div>
                            <div class="form-group text-left">
                              <label for="note_Oriental">Ghi chú</label>
                              <input type="number" class="form-control text-center" value="{{$storeOriental->note_Oriental}}">
                            </div>
                            <div class="form-group text-left">
                              <button type="submit" class="btn btn-info btn-sm m-1">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Sửa
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable();
  });

  function deleteOriental(id) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Bạn chắc chắn muốn xóa thuốc này',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Chắc chắn',
      cancelButtonText: 'Không',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

        event.preventDefault();
        document.getElementById('delete-form-' + id).submit();

      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Đóng',
        )
      }
    })
  }
</script>
@endsection

<style>
  .dataTables_info {
    display: none;
  }

  .dataTables_length select {
    width: 50px !important;
  }

  .dataTables_wrapper {
    padding: 15px;
  }
</style>