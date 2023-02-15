@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bệnh nhân</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects" id="datatable_table">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            STT
                        </th>
                        <th style="width: 20%" class="text-center">
                            Họ và tên
                        </th>
                        <th style="width: 30%" class="text-center">
                            Địa chỉ
                        </th>
                        <th class="text-center">
                            Trạnh thái
                        </th>
                        <th style="width: 20%" class="text-center">
                        </th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($patients as $patient)
                        @if($patient->debit == 0 && $patient->treated == 0)
                            <tr>
                                <td class="text-center">
                                    {{$patient->id}}
                                </td>
                                <td class="text-center">
                                    <a>
                                        {{$patient->name}}
                                    </a>
                                    <br>
                                    <small>
                                        {{date('d-m-Y',strtotime($patient->validate))}}
                                    </small>
                                </td>
                                <td class="text-center">
                                    {{$patient->province->name}} - {{$patient->district->name}} - {{$patient->ward->name}}
                                </td>
                                <td class="text-center">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="Changetreated({{$patient->id}})">
                                        Đang điều trị
                                    </button>
                                    <form id="change-treated-{{$patient->id}}" action="{{ route('adminTreated', ['patient' => $patient->id]) }}" >
                                        @csrf
                                    </form>
                                    <button type="submit" class="btn btn-secondary btn-sm" onclick="Changedebit({{$patient->id}})">
                                        Chuyển trạng thái <hr class="m-0 border border-light"> Chưa thanh toán
                                    </button>
                                    <form id="change-debit-{{$patient->id}}" action="{{ route('adminDebit', ['patient' => $patient->id]) }}">
                                        @csrf
                                    </form>
                                </td>
                                <td class="project-actions text-right">
                                    <form action="{{ route('adminPatient.show', ['patient' => $patient->id ]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-folder">
                                            </i>
                                            Xem
                                        </button>
                                    </form>
                                    <form action="{{ route('adminPatient.edit', ['patient' => $patient->id ]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt"> 
                                        </i>
                                            Sửa
                                        </button>
                                    </form>
                                    <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deletePatient({{$patient->id}})">
                                        <i class="fas fa-trash">
                                        </i>
                                        Xóa
                                    </button>
                                    <form id="delete-form-{{$patient->id}}" action="{{ route('adminPatient.destroy', ['patient' => $patient->id ]) }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).ready(function() {
        $('#datatable_table').DataTable({
            lengthMenu: [5, 10, 20, 30, 40],
        });
    });

    function deletePatient(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Bạn chắc chắn muốn xóa bệnh nhân này',
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

    function Changetreated(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Bạn chắc chắn muốn chuyển đổi sang hoàn thành điều trị',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Chắc chắn',
            cancelButtonText: 'Không',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                event.preventDefault();
                document.getElementById('change-treated-' + id).submit();

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
    function Changedebit(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Bạn chắc chắn muốn chuyển đổi sang chưa thanh toán',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Chắc chắn',
            cancelButtonText: 'Không',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                event.preventDefault();
                document.getElementById('change-debit-' + id).submit();

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

    table.dataTable tbody tr {
        background-color: transparent !important;
    }
    .paginate_button {
      padding: 0.5em 0.5em !important;
    }
    .fa-solid {
        margin-right: 5px;
    }
</style>