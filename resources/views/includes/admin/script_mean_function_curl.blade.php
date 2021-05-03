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
    //crate item
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
                    $('#modal-create').modal('toggle');
                    $('#create').trigger("reset");
                    toastr.success('Create Done');
                    CreateItem(res);
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err])
                    }
                }
            });
        });
    });
    //get id for item
    function SelectItem(data) {
        id = data;

    }
    //show item in model edit
    function ShowItem(data) {
        id = data;
        url = "{{url('admin/model/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function (res) {
                ShowData(res);
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
                    $('#modal-edit').modal('toggle');
                    UpdateItem(res);
                    toastr.info('Edit Done');
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
    });
    //change status for item
    function Change_Status(data) {
        url = "{{url('admin/model/change_status/id')}}";
        url = url.replace('id', data);
        url = url.replace('model', model);
        $.ajax({
            type: "GET",
            url: url,
            success: function () {
                $(`#status-${data}:checkbox:checked`).length == 1 ? toastr.info('Active Done') : toastr.warning('Un active Done');
            }, error: function (res) {
                console.log(res);
            }
        });
    }
    //delete item
    function DeleteItem() {
        url = "{{url('admin/model/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "delete",
            url: url,
            success: function () {
                var dataDelete = document.getElementById('data-' + id);
                dataDelete.remove();
                $('#modal-delete').modal('toggle');
                toastr.warning('Delete Done');
            }, error: function (res) {
                toastr.error(res)
            }
        });
    }
    //remove item
    function RemoveItem() {
        url = "{{url('admin/model/remove/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function () {
                var dataDelete = document.getElementById('data-' + id).remove();
                $('#modal-remove').modal('toggle');
                toastr.warning('Delete Done');
            }, error: function (res) {
                toastr.error(res);
            }
        });
    }
    //restore item to index
    function RestoreItem() {
        url = "{{url('admin/model/restore/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function () {
                var dataDelete = document.getElementById('data-' + id).remove();
                $('#modal-restore').modal('toggle');
                toastr.warning('Restore Done');
            }, error: function (res) {
                toastr.error(res)
            }
        });
    }
</script>
@yield('index')
