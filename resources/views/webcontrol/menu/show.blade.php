@extends('layouts.dashboard')
@section('style')
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
                            <table class="table table-striped table-bordered table-hover" id="sample_1">

                                <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="10%">Name</th>
                                    <th width="25%">Title</th>
                                    <th width="10%">Image</th>
                                    <th width="40%">Description</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($menus as $k => $menu)
                                    <tr>
                                        <td>{{ $k +1 }}</td>
                                        <td><b>{{ $menu->name  }}</b></td>
                                        <td style="width: 25%"><b>{!! Str::limit(strip_tags($menu->title),40) !!}</b></td>
                                        <td>
                                            @if(is_null($menu->image))
                                                <img style="width:100%;" class="img-responsive"
                                                     src="{{ asset('images/no-image.png') }}">
                                            @else
                                                <img style="width:100%;" class="img-responsive"
                                                     src="{{ asset('images/post') }}/{{ $menu->image }}">
                                            @endif
                                        </td>
                                        <td style="width: 35%">{!! Str::limit(strip_tags($menu->description),40) !!}</td>
                                        <td style="width: 14%">
                                            <a href="{{ route('menu.edit' , $menu->id) }}"
                                               class="btn btn-sm btn-primary bold uppercase" title="Edit"><i
                                                    class="fa fa-edit"></i> </a>
                                            <button type="button"
                                                    class="btn btn-sm btn-danger bold uppercase delete_button"
                                                    data-toggle="modal" data-target="#DelModal"
                                                    data-id="{{ $menu->id }}" title="Delete">
                                                <i class='fa fa-trash'></i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="text-right">
                            {{$testimonial->links('basic.pagination')}}
                        </div> --}}
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
                        <form method="post" class="form-inline" action="{{ route('menu.delete') }}">
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

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });

        });
    </script>
@endsection
