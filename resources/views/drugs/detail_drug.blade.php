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
                  <form action="{{ route('adminStoreDrug.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="name_Drug">Tên thuốc:</label>
                      <input type="text" class="form-control text-center" name="name_Drug" placeholder="Tên thuốc">
                      @error('name_Drug')
                      <span class="text-danger">Không được để trống ô này</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="money_Drug">Giá tiền:</label>
                      <input type="number" class="form-control text-center" name="money_Drug" placeholder="Giá tiền">
                      @error('money_Drug')
                      <span class="text-danger">Không được để trống ô này</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="quanlity_Drug">Số lượng:</label>
                      <input type="number" class="form-control text-center" name="quanlity_Drug" placeholder="Số lượng">
                      @error('quanlity_Drug')
                      <span class="text-danger">Không được để trống ô này</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="note_Drug">Chú thích</label>
                      <textarea class="form-control" rows="4" placeholder="Ghi chú ..." name="note_Drug"></textarea>
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
              <th class="sorting text-center" aria-controls="example1" rowspan="1" colspan="1" style="width: 19%">Giá tiền</th>
              <th class="sorting text-center" aria-controls="example1" rowspan="1" colspan="1" style="width: 15%">Số lượng</th>
              <th class="sorting text-center" aria-controls="example1" rowspan="1" colspan="1" style="width: 30%">Chú thích</th>
              <th class="sorting text-center" aria-controls="example1" rowspan="1" colspan="1" style="width: 15%"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($storeDrugs as $storeDrug)
            <tr>
              <td class="text-center">{{$storeDrug->id}}</td>
              <td class="text-center">{{$storeDrug->name_Drug}}</td>
              <td class="text-center">{{$storeDrug->money_Drug}}</td>
              <td class="text-center">{{$storeDrug->quanlity_Drug}}</td>
              <td class="text-center">{{$storeDrug->note_Drug}}</td>
              <td class="row text-center">
                <div class="col-md-12 col-lg-6">
                  <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteDrug({{$storeDrug->id}})">
                    <i class="fas fa-trash">
                    </i>
                    Xóa
                  </button>
                  <form id="delete-form-{{ $storeDrug->id }}" action="{{ route('adminStoreDrug.destroy', ['storeDrug' => $storeDrug->id]) }}" method="post">
                    @csrf
                    @method("DELETE")

                  </form>
                </div>
                <div class="col-md-12 col-lg-6">
                  <button type="button" class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#modal-lg-{{$storeDrug->id}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Sửa
                  </button>
                  <div class="modal fade show" id="modal-lg-{{$storeDrug->id}}" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4>Sửa thuốc</h4>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('adminStoreDrug.update', ['storeDrug' => $storeDrug->id]) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group text-left">
                              <label for="name_Drug">Tên thuốc:</label>
                              <input type="text" class="form-control text-center" value="{{$storeDrug->name_Drug}}">
                            </div>
                            <div class="form-group text-left">
                              <label for="money_Drug">Giá tiền:</label>
                              <input type="number" class="form-control text-center" value="{{$storeDrug->money_Drug}}">
                            </div>
                            <div class="form-group text-left">
                              <label for="note_Drug">Ghi chú</label>
                              <input type="number" class="form-control text-center" value="{{$storeDrug->note_Drug}}">
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

  function deleteDrug(id) {
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