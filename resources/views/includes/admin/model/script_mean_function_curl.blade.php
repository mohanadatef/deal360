<script>
    $('#modal-create').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select").val('').end()
            .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    });
    $('#modal-edit').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select").val('').end()
            .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    });
    //header ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //global variable
    var id,url,model = window.location.href.split('admin/').pop().split('/')[0];
    //create item
    $(document).ready(function () {
        $("#create").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('admin/model')}}";
            url = url.replace('model', model);
            $.ajax({
                type: "post",
                url: url,
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    $('#body').append(res);
                    $('#modal-create').modal('toggle');
                    $('#create').trigger("reset");
                    toastr.success('{{trans('lang.Create_Done')}}');
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err])
                    }
                }
            });
        });
    });
    //get id for item
    function selectItem(data) {
        id = data;
    }
    //show item in model edit
    function showItem(data) {
        id = data;
        url = "{{url('admin/model/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function (res) {
                showData(res);
                $(`#openModael${res.id}`).click();
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }
    //edit data
    $(document).ready(function () {
        $("#edit").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('admin/model/id')}}";
            url = url.replace('id', id);
            url = url.replace('model', model);
            $.ajax({
                type: "post",
                url: url,
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    updateItem(res);
                    $('#modal-edit').modal('toggle');
                    toastr.info('{{trans('lang.Edit_Done')}}');
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
    });
    //change status for item
    function changeStatus(data) {
        url = "{{url('admin/model/change_status/id')}}";
        url = url.replace('id', data);
        url = url.replace('model', model);
        $.ajax({
            type: "GET",
            url: url,
            success: function () {
                $(`#status-${data}:checkbox:checked`).length == 1 ? toastr.info('{{trans('lang.Active_Done')}}') : toastr.warning('{{trans('lang.Un_Active_Done')}}');
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }
    //delete item
    function deleteItem() {
        url = "{{url('admin/model/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "delete",
            url: url,
            success: function () {
                document.getElementById('data-' + id).remove();
                $('#modal-delete').modal('toggle');
                toastr.warning('{{trans('lang.Delete_Done')}}');
            },error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }
    //remove item
    function removeItem() {
        url = "{{url('admin/model/remove/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function () {
                document.getElementById('data-' + id).remove();
                $('#modal-remove').modal('toggle');
                toastr.warning('{{trans('lang.Delete_Done')}}');
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }
    //restore item to index
    function restoreItem() {
        url = "{{url('admin/model/restore/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function () {
                document.getElementById('data-' + id).remove();
                $('#modal-restore').modal('toggle');
                toastr.warning('{{trans('lang.Restore_Done')}}');
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }
</script>
@yield('curl')
