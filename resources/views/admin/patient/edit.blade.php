@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<section class="content">
      <div class="row">
            <div class="col-sm-0 col-md-1"></div>
            <div class="col-sm-12 col-md-10">
                  <div class="card card-primary">
                        <div class="card-header">
                              <h3 class="card-title">Thông tin</h3>
                              <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                          <i class="fas fa-minus"></i>
                                    </button>
                              </div>
                        </div>
                        <div class="card-body">
                              <form action="{{ route('adminPatient.update', ['patient' => $patient ]) }}" method="post">
                              @csrf
                              @method('PUT')
                                    <div class="row">
                                          <div class="col-md-12 col-lg-4 form-group">
                                                <label for="name">Họ và tên</label>
                                                <input type="text" id="name" class="form-control" name="name" value="{{$patient->name}}">
                                          </div>
                                          <div class="col-md-12 col-lg-2 form-group">
                                                <label for="age">Tuổi</label>
                                                <input id="age" class="form-control" name="age" value="{{$patient->age}}">
                                          </div>
                                          <div class="col-md-12 col-lg-3 form-group">
                                                <label for="validate">Ngày vào</label>
                                                <input type="date" name="validate" id="validate" class="form-control" value="{{$patient->validate}}">
                                          </div>
                                          <div class="col-md-12 col-lg-3 form-group">
                                                <label for="phone_number">Điện thoại</label>
                                                <input type="text" id="phone_number" class="form-control" name="phone_number" value="{{$patient->phone_number}}">
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-md-12 col-lg-12 form-group">
                                                <label for="village">Thôn - Tên nhà:</label>
                                                <input type="text" name="village" class="form-control" value="{{$patient->village}}">
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-md-12 col-lg-4 form-group">
                                                <label for="province">Thành phố - Tỉnh</label>
                                                <input type="text" value="{{$patient->province->name}}" class="form-control" disabled>
                                          </div>
                                          <div class="col-md-12 col-lg-4 form-group">
                                                <label for="district">Quận - Huyện</label>
                                                <input type="text" value="{{$patient->district->name}}" class="form-control" disabled>
                                          </div>
                                          <div class="col-md-12 col-lg-4 form-group">
                                                <label for="ward">Phường - Xã</label>
                                                <input type="text" value="{{$patient->ward->name}}" class="form-control" disabled>
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-md-12 col-lg-12 form-group">
                                                <label for="anamnesis">Tiền sử bệnh</label>
                                                <input type="text" name="anamnesis" class="form-control" value="{{$patient->anamnesis}}">
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-md-12 col-lg-12">
                                                <label for="note">Ghi chú</label>
                                                <textarea name="note" class="form-control" id="" cols="30" rows="7">{{$patient->note}}</textarea>
                                          </div>
                                    </div>
                                    <div class="row mt-2">
                                          <div class="col-md-12 form-group">
                                                <button type="submit" class="btn btn-success">Lưu lại</button>
                                          </div>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
            <div class="col-sm-0 col-md-1"></div>
      </div>
</section>
@endsection