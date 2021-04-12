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
                <div class="card-header">
                <button type="submit" class="btn btn-danger multi-delete" disabled="false"  data-toggle="modal" data-target="#DelModal"
                        title="Delete"> Delete selected post</button>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th width="5%">SL#</th>
                                    <th width="10%">Title</th>
                                    <th width="25%">Post's Link</th>
                                    <th width="15%">Comment</th>
                                    <th width="25%">Comment's Link</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($post as $k => $p)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $p->id }}" class="checked-post">
                                    </td>
                                    <td>{{ $k + 1 }}</td>
                                    <td style="width: 15%; max-width: 15%" class="crawal_comment"><b>{!! strip_tags($p->title) !!}</b></td>
                                    <td style="width:3%"><a href="{{ $p->title_link}}" style="color:blue">{!! Str::limit(strip_tags($p->title_link),20) !!}</a></td>
                                    <td style="width:60%; max-width:50%;" class="crawal_comment">{!!strip_tags($p->comment) !!}
                                    </td>
                                    <td style="width:3%"><a href="{{$p->comment_link}}" style="color:blue">{!! Str::limit(strip_tags($p->comment_link),20) !!}</a></td>
                                    <td style="width: 14%">
                                        <a href="{{ route('f319.edit' , $p->id) }}" class="btn btn-sm btn-primary bold uppercase" title="Edit"><i class="fa fa-edit"></i> </a>
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
                <strong>Are you sure want to delete selected rows ?</strong>
            </div>

            <div class="modal-footer">
                <form method="post" class="form-inline" action="{{ route('f319.delete') }}">
                    <input type="hidden" name="ids" class="delete_ids">
                    {!! csrf_field() !!}
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
    $('.checked-post').click(function () {
        let ids = '';
        if ($('.checked-post:checkbox:checked').length > 0) {
            $('.multi-delete').prop('disabled', false);
            $('.checked-post:checked').each(function () {
                if (jQuery(this).is(":checked")) {
                    var id = jQuery(this).val();
                    ids = ids + id + '-'
                }
            })
        } else {
            $('.multi-delete').prop('disabled', true);
        }
        $('.delete_ids').val(ids)
    })
    $(document).ready(function() {
        $(document).on("click", '.delete_button', function(e) {
            var id = $(this).data('id');
            $(".abir_id").val(id);
        });
        $('#table').DataTable({
            searching: true,
            columnDefs: [{
                targets: 0,
                sortable: false
            }, ],
        })
    });
</script>
@endsection
