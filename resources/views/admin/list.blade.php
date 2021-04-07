@extends('layouts.dashboard')
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />

@endsection
@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $page_title }}</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-chevron-left"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-times close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($staffs as $k => $staff)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td><b>{{ $staff->name  }}</b></td>
                                        <td><b>{{ $staff->email  }}</b></td>
                                        <td>
                                            @if(is_null($staff->image))
                                                <img style="width:15%;" class="img-responsive"
                                                     src="{{ asset('images/no-image.png') }}">
                                            @else
                                                <img style="width:15%;" class="img-responsive"
                                                     src="{{ asset('images/admin') }}/{{ $staff->image }}">
                                            @endif
                                        </td>
                                        <td>{{ $staff->phone }}</td>
                                        <td>{{ config('role')[$staff->role_id] }}</td>
                                        <td style="width: 14%">
                                            <a href="{{ route('staff.edit' , $staff->id) }}"
                                               class="btn btn-sm btn-primary bold uppercase" title="Edit"><i
                                                    class="fa fa-edit"></i> </a>

                                            <button type="button"
                                                    class="btn btn-sm btn-danger bold uppercase delete_button"
                                                    data-toggle="modal" data-target="#DelModal"
                                                    data-id="{{ $staff->id }}" title="Delete">
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class='fa fa-exclamation-triangle'></i> Confirmation !
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" class="form-inline" action="{{ route('staff.delete') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
                            Close
                        </button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src=" https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });

        });
        $(document).ready(function() {
            $('#table').DataTable(
                {
                    searching:true,
                    columnDefs : [
                        { targets: 0, sortable: false},
                    ],
                }
            );
        } );
    </script>
@endsection
