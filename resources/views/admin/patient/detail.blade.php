  @extends('adminlte::page')

  @section('title', 'Dashboard')

  @section('content_header')

  @stop
  @section('content')
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-3">
                  <div class="card card-primary card-outline">
                      <div class="card-body boxChecked-profile">
                          <h3 class="profile-username text-center">{{$patient->name}}</h3>
                          <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                  <b>Tuổi</b>
                                  <p class="float-right">{{$patient->age}}</p>
                              </li>
                              <li class="list-group-item">
                                  <b>Điện thoại</b>
                                  <p class="float-right">{{$patient->phone_number}}</p>
                              </li>
                              <li class="list-group-item">
                                  <b>Ngày vào</b>
                                  <p class="float-right">{{date('d-m-Y',strtotime($patient->validate))}}</p>
                              </li>
                          </ul>
                      </div>
                  </div>

                  <div class="card card-primary">
                      <div class="card-header">
                          <h3 class="card-title">Địa chỉ</h3>
                      </div>
                      <div class="card-body">
                          <strong><i class="fas fa-book mr-2"></i>Thành phố / Tỉnh</strong>
                          <p class="text-muted mt-2">
                              {{$patient->province->name}}
                          </p>
                          <hr>
                          <strong><i class="fas fa-map-marker-alt mr-2"></i>Quận / huyện</strong>
                          <p class="text-muted mt-2">{{$patient->district->name}}</p>
                          <hr>
                          <strong><i class="fas fa-pencil-alt mr-2"></i>Phường / xã</strong>
                          <p class="text-muted mt-2">
                              {{$patient->ward->name}}
                          </p>
                          <hr>
                          <strong><i class="far fa-file-alt mr-2"></i>Số nhà(Nếu có)</strong>
                          <p class="text-muted mt-2">{{$patient->village}}</p>
                      </div>
                  </div>
              </div>

              <div class="col-md-9">
                  <div class="card">
                      <div class="card-header p-2">
                          <ul class="nav nav-pills">
                              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Tiền sử bệnh</a></li>
                              <li class="nav-item"><a class="nav-link" href="#drugs" data-toggle="tab">Thuốc tây ({{$patient->drugs->sum('quanlity_Drug')}})</a></li>
                              <li class="nav-item"><a class="nav-link" href="#orientals" data-toggle="tab">Thuốc đông y</a></li>
                              <li class="nav-item"><a class="nav-link" href="#days" data-toggle="tab">Ngày điều trị ({{$patient->days->sum('quanlity_Day')}})</a></li>
                              <li class="nav-item"><a class="nav-link" href="#advance" data-toggle="tab">Tạm ứng ({{$patient->advances->sum('quanlity_Advance')}})</a></li>
                              <li class="nav-item"><a class="nav-link" href="#pdf" data-toggle="tab">Hóa đơn</a></li>
                          </ul>
                      </div>
                      <div class="card-body">
                          <div class="tab-content">
                              <div class="active tab-pane" id="activity">
                                  <div class="activity-1">
                                      <h4 class="activity-header">Tiền sử bệnh</h4>
                                      <div class="activity-body">
                                          {{$patient->anamnesis}}
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="activity-2">
                                      <h4 class="activity-header">Ghi chú</h4>
                                      <div class="activity-body">
                                          {{$patient->note}}
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="activity-3">
                                      <h4 class="activity-header mb-3">Hình ảnh</h4>
                                      <div class="activity-body">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-activity">
                                                      Thêm hình ảnh
                                                  </button>
                                              </div>
                                          </div>
                                          <div class="modal fade show" id="modal-activity" aria-modal="true" role="dialog">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h4 class="modal-title">Thêm hình ảnh</h4>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <form action="{{route('adminPhoto.store')}}" method="post" enctype="multipart/form-data">
                                                              @csrf
                                                              <div class="form-group">
                                                                  <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                                              </div>
                                                              <div class="form-group">
                                                                  <input type="file" id="files" name="image">
                                                              </div>
                                                              <div class="form-group mt-3">
                                                                  <button type="submit" class="btn btn-group btn-primary">Thêm</button>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="activity-footer mt-3">
                                          <div class="row justify-content-between">
                                              @foreach($photos as $photo)
                                              <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                                                  <img src="{{ asset('storage/images/'.$photo->name_Photo) }}" alt="" width="200px" height="200px">
                                              </div>
                                              @endforeach
                                          </div>
                                      </div>
                                  </div>
                              </div>


                              {{-- Thuốc tây y --}}
                              <div class="tab-pane" id="drugs">
                                  <div class="Drug">
                                      <div class="col-12">
                                          <div class="row align-items-center">
                                              <div class="col-md-2">
                                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default-1">
                                                      Thêm thuốc
                                                  </button>
                                              </div>
                                              <div class="col-md-10">
                                                  <span class="bg-success p-2 text-white">Tổng tiền thuốc: <strong id="sumMoney"></strong><b> VND</b></span>
                                              </div>
                                          </div>

                                          <div class="modal fade show" id="modal-default-1" aria-modal="true" role="dialog">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h4 class="modal-title">Thêm thuốc</h4>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <form action="{{route('adminDrug.store')}}" method="post">
                                                              @csrf
                                                              <div class="form-group">
                                                                  <input type="hidden" name="quanlity_Drug" value="1">
                                                                  <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="name_Drug">Tên thuốc:</label>
                                                                  <select class="form-control select2" style="width: 100%;" name="storedrug_ids[]" multiple="multiple" data-placeholder="Chọn thuốc">
                                                                      @foreach($storeDrugs as $storeDrug)
                                                                      <option value="{{$storeDrug->id}}">{{$storeDrug->name_Drug}}</option>
                                                                      @endforeach
                                                                  </select>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="validate_Drug">Vào ngày</label>
                                                                  <input type="date" class="form-control" id="validate_Drug" name="validate_Drug" value="{{$dateDay->toDateString()}}">
                                                              </div>
                                                              <div class="form-group">
                                                                  <button type="submit" class="btn btn-group btn-primary">Thêm</button>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <hr>
                                      {{-- @foreach($drugs as $drug)
                      <div class="row mt-2 p-2 align-items-center">
                        <div class="col-md-3">
                            <span>Ngày sử dụng: </span><strong>{{date('d-m-Y',strtotime($drug->validate_Drug))}}</strong>
                                  </div>
                                  <div class="col-md-3">
                                      <span>Tên thuốc: </span><strong>{{$drug->storedrug->name_Drug}}</strong>
                                  </div>
                                  <div class="col-md-3 text-center">
                                      <span>Giá tiền: </span><strong>{{number_format($drug->storedrug->money_Drug, 0)}} VND</strong>
                                      <div style="display: none" class="nummberMoney">{{ $drug->storedrug->money_Drug }}</div>
                                  </div>
                                  <div class="col-md-3 text-center">
                                      <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteDrug({{$drug->id}})">
                                          <i class="fas fa-trash">
                                          </i>
                                          Xóa
                                      </button>
                                      <form id="delete-form-{{$drug->id}}" action="{{ route('adminDrug.destroy', ['drug' => $drug->id ]) }}" method="post">
                                          @csrf
                                          @method("DELETE")
                                      </form>
                                  </div>
                              </div>
                              <hr>
                              @endforeach
                              <div>
                                  {{$drugs->links()}}
                              </div> --}}
                              <div class="card">
                                  <div class="card-body p-0">
                                      <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                          <div class="row">
                                              <div class="col-sm-12">
                                                  <table id="tableDrug" class="display">
                                                      <thead>
                                                          <tr>
                                                              <th class="sorting sorting_asc text-center" rowspan="1" colspan="1" aria-sort="ascending">Ngày sử dụng</th>
                                                              <th class="sorting text-center" rowspan="1" colspan="1">Tên thuốc</th>
                                                              <th class="sorting text-center" rowspan="1" colspan="1"></th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                          @foreach($drugs as $drug)
                                                          <div style="display: none" class="nummberMoney">{{ $drug->storedrug->money_Drug }}</div>
                                                          <tr class="odd">
                                                              <td class="text-center">{{date('d-m-Y',strtotime($drug->validate_Drug))}}</td>
                                                              <td class="text-center">{{$drug->storedrug->name_Drug}}</td>
                                                              <td class="text-center">
                                                                  <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteDrug({{$drug->id}})">
                                                                      <i class="fas fa-trash">
                                                                      </i>
                                                                      Xóa
                                                                  </button>
                                                                  <form id="delete-form-{{$drug->id}}" action="{{ route('adminDrug.destroy', ['drug' => $drug->id ]) }}" method="post">
                                                                      @csrf
                                                                      @method("DELETE")
                                                                  </form>
                                                              </td>
                                                          </tr>
                                                          @endforeach
                                                  </table>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div>
                              </div>
                          </div>
                      </div>
                      {{-- Thuốc đông y --}}
                      <div class="tab-pane" id="orientals">
                          <div>
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-example-modal-lg">
                                  Thêm thuốc
                              </button>

                              {{-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#deleteArrayOriental" id="deletebtnOriental">
                                <i class="fas fa-trash"></i>
                                Xóa thuốc
                              </button> --}}

                              {{-- <div class="modal fade" id="deleteArrayOriental">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa những loại thuốc này trong bảng thuốc đông y</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <ul class="list-group" id="dataOriental">
                                        
                                      </ul>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                      <form action="" method="post">
                                        <input type="hidden" name="oriental[]">
                                        <button type="submit" class="btn btn-primary">Xóa</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div> --}}

                              <div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h4 class="modal-title">Thêm thuốc</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">×</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <form action="{{ route('adminOriental.store')}}" method="POST">
                                                  @csrf
                                                  <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                                  <table class="table text-center">
                                                      <thead class="thead">
                                                          <tr>
                                                              <th scope="col">Tên thuốc</th>
                                                              <th scope="col">Khối lượng(g)</th>
                                                              <th scope="col">
                                                                  <button type="button" class="btn btn-success addRow">+</button>
                                                              </th>
                                                          </tr>
                                                      </thead>
                                                      <tbody class="tbody">
                                                          <tr>
                                                              <td>
                                                                  <select class="form-control select2" style="width: 100%;" name="storeoriental_id[]">
                                                                      @foreach($storeOrientals as $storeOriental)
                                                                      <option value="{{$storeOriental->id}}">{{$storeOriental->name_Oriental}}</option>
                                                                      @endforeach
                                                                  </select>
                                                              </td>
                                                              <td>
                                                                  <input type="number" name="weight_Oriental[]" style="width: 100%;" class="form-control text-center">
                                                              </td>
                                                              <td>
                                                                  <button type="button" class="btn btn-danger deleteRow">-</button>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                                  <div class="form-group mt-4">
                                                      <button type="submit" class="btn btn-primary">Tạo đơn thuốc</button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="mt-3">
                              <div class="card">
                                  <table class="display" id="table-oriental" style="width:100%">
                                      <thead>
                                          <tr>
                                              <th scope="col" class="text-center">Tên thuốc</th>
                                              <th scope="col" class="text-center">Cân nặng</th>
                                              <th scope="col" class="text-center">Ngày thêm</th>
                                              <th scope="col" class="text-center"></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach($orientals as $oriental)
                                          <tr>
                                              <td class="text-center name_Oriental">{{$oriental->storeoriental->name_Oriental}}</td>
                                              <td class="text-center">{{$oriental->weight_Oriental}}</td>
                                              <td class="text-center">{{date('d-m-Y', strtotime($oriental->validate_Oriental))}}</td>
                                              <td class="text-center">
                                                <form action="{{ route('adminOriental.destroy', ['oriental' => $oriental->id])}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                  <button type="submit" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Xóa</button>                                             
                                                </form>
                                              </td>
                                          </tr>
                                          @endforeach   
                                      </tbody>
                                  </table>
                                    <div class="row">
                                        <div class="col-md-12 button-group">
                                            <form action="{{ route('orientalPay', ['patient' => $patient->id]) }}">
                                                <button type="submit" class="btn btn-group btn-sm bg-info p-2">Xem đơn thuốc</button>
                                            </form>
                                        </div>
                                    </div>
                              </div>
                          </div>
                      </div>

                      {{-- Ngày điều trị --}}
                      <div class="tab-pane" id="days">
                          <div class="Drug">
                              <div class="col-12">
                                  <div class="row align-items-center">
                                      <div class="col-md-2">
                                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default-day">
                                              Thêm ngày
                                          </button>
                                      </div>
                                      <div class="col-md-10">
                                          @if($patient->days->sum('money_Day') != 0)
                                          <span class="bg-success p-2">Tổng tiền ngày điều trị: <strong>{{number_format($patient->days->sum('money_Day'), 0)}}</strong><b> VND</b></span>
                                          @endif
                                      </div>
                                  </div>


                                  <div class="modal fade show" id="modal-default-day" aria-modal="true" role="dialog">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Thêm ngày</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <form action="{{ route('adminDay.store') }}" method="post">
                                                      @csrf
                                                      <div class="form-group">
                                                          <input type="hidden" name="quanlity_Day" value="1">
                                                          <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="name_Drug">Tên thuốc:</label>
                                                          <select class="form-control text-center" style="width: 100%;" name="money_Day" placeholder="Chọn số tiền">
                                                              <option value="100000">100.000 VND</option>
                                                              <option value="90000">90.000 VND</option>
                                                              <option value="80000">80.000 VND</option>
                                                              <option value="70000">70.000 VND</option>
                                                          </select>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="validate_Drug">Ngày điều trị:</label>
                                                          <input type="date" class="form-control text-center" id="validate_Day" name="validate_Day" placeholder="Ngày điều trị" value="{{$dateDay->toDateString()}}">
                                                      </div>
                                                      <div class="form-group">
                                                          <button type="submit" class="btn btn-group btn-primary">Thêm</button>
                                                      </div>
                                                  </form>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <hr>
                              {{-- @foreach($days as $day)
                <div class="row mt-2 p-2 align-items-center">
                  <div class="col-md-3 text-center">
                    <span>Ngày điều trị:</span><strong> {{date('d-m-Y',strtotime($day->validate_Day))}}</strong>
                          </div>
                          <div class="col-md-3 text-center">
                              <span>Giá tiền: </span><strong> {{number_format($day->money_Day, 0)}} VND</strong>
                          </div>
                          <div class="col-md-3 text-center">
                              <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteDrug({{$day->id}})">
                                  <i class="fas fa-trash">
                                  </i>
                                  Xóa
                              </button>
                              <form id="delete-form-{{$day->id}}" action="{{ route('adminDay.destroy', ['day' => $day->id ]) }}" method="post">
                                  @csrf
                                  @method("DELETE")
                              </form>
                          </div>
                      </div>
                      <hr>
                      @endforeach --}}
                      <div class="card">
                          <div class="card-body p-0">
                              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <table id="tableDay" class="display" aria-describedby="example2_info">
                                              <thead>
                                                  <tr>
                                                      <th class="sorting sorting_asc text-center" rowspan="1" colspan="1" aria-sort="ascending">Ngày điều trị</th>
                                                      <th class="sorting text-center" rowspan="1" colspan="1">Giá tiền</th>
                                                      <th class="sorting text-center" rowspan="1" colspan="1"></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach($days as $day)
                                                  <tr class="odd">
                                                      <td class="text-center">{{date('d-m-Y',strtotime($day->validate_Day))}}</td>
                                                      <td class="text-center">{{number_format($day->money_Day, 0)}} VND</td>
                                                      <td class="text-center"><button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteDrug({{$day->id}})">
                                                              <i class="fas fa-trash">
                                                              </i>
                                                              Xóa
                                                          </button>
                                                          <form id="delete-form-{{$day->id}}" action="{{ route('adminDay.destroy', ['day' => $day->id ]) }}" method="post">
                                                              @csrf
                                                              @method("DELETE")
                                                          </form>
                                                      </td>
                                                  </tr>
                                                  @endforeach
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              {{-- Tiền tạm ứng --}}
              <div class="tab-pane" id="advance">
                  <div class="advance">
                      <div class="col-12">
                          <div class="row align-items-center">
                              <div class="col-md-2">
                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default-advance">
                                      Tạm ứng tiền
                                  </button>
                              </div>
                              <div class="col-md-10">
                                  @if($patient->advances->sum('money_Advance') != 0)
                                  <span class="bg-success p-2">Tổng tiền tạm ứng: <strong>{{number_format($patient->advances->sum('money_Advance'), 0)}}</strong><b> VND</b></span>
                                  <div style="display: none" class="moneyQuery">{{$patient->advances->sum('money_Advance')}}</div>
                                  @endif
                              </div>
                          </div>

                          <div class="modal fade show" id="modal-default-advance" aria-modal="true" role="dialog">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Tạm ứng tiền</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form action="{{ route('adminAdvance.store') }}" method="post">
                                              @csrf
                                              <div class="form-group">
                                                  <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                                  <input type="hidden" name="quanlity_Advance" value="1">
                                              </div>
                                              <div class="form-group">
                                                  <label for="name_Drug">Tiền tạm ứng:</label>
                                                  <input type="number" class="form-control text-center" name="money_Advance" placeholder="Số tiền tạm ứng">
                                              </div>
                                              <div class="form-group">
                                                  <label for="validate_Drug">Ngày thêm:</label>
                                                  <input type="date" class="form-control text-center" id="validate_Advance" name="validate_Advance" value="{{$dateDay->toDateString()}}">
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" class="btn btn-group btn-primary">Thêm</button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>
                      @foreach($patient->advances as $advance)
                      <div class="row mt-2 p-2 align-items-center">
                          <div class="col-md-3 text-center">
                              <span>Ngày ứng tiền:</span><strong> {{date('d-m-Y',strtotime($advance->validate_Advance))}}</strong>
                          </div>
                          <div class="col-md-3 text-center">
                              <span>Giá tiền: </span><strong> {{number_format($advance->money_Advance, 0)}} VND</strong>
                          </div>
                          <div class="col-md-3 text-center">
                              <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteDrug({{$advance->id}})">
                                  <i class="fas fa-trash">
                                  </i>
                                  Xóa
                              </button>
                              <form id="delete-form-{{$advance->id}}" action="{{ route('adminAdvance.destroy', ['advance' => $advance->id ]) }}" method="post">
                                  @csrf
                                  @method("DELETE")
                              </form>
                          </div>
                      </div>
                      <hr>
                      @endforeach
                  </div>
              </div>

              {{-- PDF --}}

              <div class="tab-pane" id="pdf">
                  <div class="PDF">
                      <div class="col-12">
                          <div class="row">
                              <form action="{{route('adminPdf', ['patient' => $patient->id])}}">
                                  @csrf
                                  <div class="form-group">
                                      <input type="hidden" name="totalMoney_Drugs" id="money_Drugs">
                                      <input type="hidden" name="totalMoney_Advances" id="money_Advances">
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-group btn-info">Xem hóa đơn</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </div>
      </div>
      </div>
      </div>
  </section>
  @endsection

  @section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script>
      $(document).ready(function() {
          $('.select2').select2();
          $('#tableDrug').DataTable({
              lengthMenu: [3, 5, 7, 9],
          });
          $('#tableDay').DataTable({
              lengthMenu: [3, 5, 7, 9],
          });
          $('#table-oriental').DataTable({
          });
      });


      $('thead').on('click', '.addRow', function() {
          var tr =
              "<tr>" +
              "<td>" + "<select class='form-control select3' style='width: 100%;' name='storeoriental_id[]'>" +
              "@foreach($storeOrientals as $storeOriental)" +
              "<option class='text-center' value='{{$storeOriental->id}}'>{{$storeOriental->name_Oriental}}</option>" +
              "@endforeach" +
              "</select>" +
              "</td>" +
              "<td><input type='number' name='weight_Oriental[]' style='width: 100%;' class='form-control text-center'></td>" +
              "<td><button class='btn btn-danger deleteRow'>-</button></td>" +
              "</tr>"
          $('.tbody').append(tr);
          $('.select3').select2();
      })
      $('tbody').on('click', '.deleteRow', function() {
          $(this).parent().parent().remove();
      })

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

      const deleteOriental = document.querySelector('#deletebtnOriental');
      deleteOriental.addEventListener('click', () => 
      {

      })

      var arrayOriental = document.querySelectorAll('.orientalValue');
      var nameOriental = document.querySelectorAll('.name_Oriental');
      // var dataOriental = document.querySelector('.dataOriental')

      // var arrayOrientalChecked = [];
      //   arrayOriental.forEach((e) => {
      //       e.addEventListener('change', (event) => {
      //           if(event.target.checked) {
      //               let arrayTarget = event.target.value;
      //               arrayOrientalChecked.push(arrayTarget);

      //               console.log(arrayOrientalChecked[)
      //           }
      //       })
      //   });
			

			// Array Oriental // 

			// var information = {};
			// information['letters'] = [];
			// function checkOriental() {
			// 	var arrayOrientalChecked =  Array.from(document.getElementsByName("arrayOriental"));
				
			// 	for (let i = 0; i < arrayOrientalChecked.length; i++) {
			// 		var sbVal = arrayOrientalChecked[i].value;

			// 		if (arrayOrientalChecked[i].checked && information.letters.indexOf(sbVal) < 0) {
			// 			information.letters.push(arrayOrientalChecked[i].value);
			// 			continue;
			// 		}

			// 		if (arrayOrientalChecked[i].checked === false && information.letters.indexOf(sbVal) >= 0) {
			// 			var j = information.letters.indexOf(sbVal);
			// 			information.letters.splice(j, 1);
			// 		}
			// 	}
			// 	// console.log(information.letters)

			// 	// let showArrayOriental = information.letters.join(', ');
            //     // console.log(information.letters);

			// 	let list_Oriental = information.letters.join(', ');
            //     document.getElementById("dataOriental").innerHTML = list_Oriental;
            //     console.log(list_Oriental.id)
			// }


			// var boxChecked = document.getElementsByName("arrayOriental");
			// if (boxChecked[0].addEventListener) {
			// 	for (var i = 0; i < boxChecked.length; i++) {
			// 		boxChecked[i].addEventListener("change", checkOriental, false);
			// 	}
			// } else if (boxChecked[0].attachEvent) {
			// 	for (var i = 0; i < boxChecked.length; i++) {
			// 		boxChecked[i].attachEvent("onchange", checkOriental);
			// 	}
			// }
		// End Array Oriental

			

	  const dataMoney = document.querySelectorAll('.nummberMoney');
      var sumMopney = 0
      for (var i = 0; i < dataMoney.length; i++) {
          sumMopney = sumMopney + parseFloat(dataMoney[i].childNodes[0].nodeValue);
      }
      var formatMoney = sumMopney.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
      document.getElementById('sumMoney').innerHTML = formatMoney;
      document.getElementById('money_Drugs').value = sumMopney;

      var moneyAdvances = document.querySelector('.moneyQuery').innerHTML;
      document.getElementById('money_Advances').value = moneyAdvances

  </script>
  @endsection

  @section('css')
  <style>
      .dataTables_info {
          display: none;
      }

      .dataTables_length select {
          width: 50px !important;
      }

      .dataTables_wrapper {
          padding: 10px;
      }

      #tableDrug_wrapper {
          padding: 0px;
      }

      table.dataTable tbody tr {
          background-color: transparent !important;
      }

      .paginate_button {
          padding: 0.5em 0.5em !important;
      }
  </style>
  @endsection