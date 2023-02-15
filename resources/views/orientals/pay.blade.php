@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="col-12 p-0 mb-4 font-weight-bold">
        <h1>Phòng Khám Quốc Tiến</h3>
        <p>Địa chỉ: Thái Phương - Hưng Hà - Thái Bình</p>
    </div>
    <div class="row align-item-center">
        <div class="col-12">
            <p class="mb-2 font-weight-bold">Tên bệnh nhân: {{$patient->name}}</p>
        </div>
        <div class="col-12">
            <p class="mb-2 ">Nơi ở: {{$patient->province->name}} - {{$patient->district->name}} - {{$patient->ward->name}}</p>
        </div>
        <div class="col-12">
            <p class="mb-2 ">Tiền sử bệnh: {{$patient->anamnesis}}</p>
        </div>
    </div>
    <div class="mt-3">
        <p class="font-weight-bold">Bảng thuốc</p>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Tên thuốc</th>
                {{-- <th scope="col" class="text-center">Giá tiền</th> --}}
              </tr>
            </thead>
            <tbody>
            @foreach($orientals as $oriental)
                <tr>
                    <th scope="row" class="text-center">{{$oriental->id}}</th>
                    <td class="text-center">{{$oriental->storeoriental->name_Oriental}}</td>
                    {{-- <td class="text-center">{{number_format(($drug->storeDrug->money_Drug), 0)}} VND</td> --}}
                </tr>
            @endforeach
            </tbody>
          </table>
    </div>
    {{-- <div class="mt-3">
        <p class="font-weight-bold">Bảng thanh toán</p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Danh mục</th>
                <th scope="col" class="text-center">Số tiền</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="text-center"scope="row">1</th>
                <td>Số ngày điều trị ({{$patient->days->sum('quanlity_Day')}})</td>
                <td class="text-center">{{number_format($patient->days->sum('money_Day'), 0)}} VND</td>
              </tr>
              <tr>
                <th class="text-center" scope="row">2</th>
                <td>Thuốc tây ({{$patient->drugs->sum('quanlity_Drug')}}) + thuốc đông y</td>
                <td class="text-center">{{number_format(($money_Drugs), 0)}} VND</td>
              </tr>
              <tr>
                <th class="text-center" scope="row">3</th>
                <td>Tiền tạm ứng</td>
                <td class="text-center">{{number_format(($money_Advances), 0)}} VND</td>
              </tr>
              <tr>
                <th class="text-center" scope="row">4</th>
                <td>Tổng tiền cần thanh toán: </td>
                <td class="text-center">{{number_format((($patient->days->sum('money_Day')) +($money_Drugs) - ($money_Advances) ), 0)}} VND</td>
              </tr>
            </tbody>
          </table>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <p class="font-weight-bold">Ngày thanh toán: {{date('d-m-Y / H:i:s',strtotime($datePay))}}</p> 
        </div>
        <div class="col-12">
            <p>Bác sĩ điều trị: ...</p>
        </div>
    </div>
</div>
@endsection