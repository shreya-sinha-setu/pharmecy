@extends('admin.layouts.app')
@section('title','Categories')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Categories</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addCategoriesModal"><i
                            class="fa fa-plus"></i> Add Categories</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Categoriess -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_Categories">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>
                    <!-- /Categoriess-->
                </div>
            </div>
        </div>
    </div>

    </div>
    <div id="addCategoriesModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Categories</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="add_Categories_form" enctype="multipart/form-data">
                        @csrf
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label>Category Name</label>
                                    <input class="form-control" type="text" name="name" id="name">
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="add_Categories_btn" type="submit"
                                    name="form_submit" value="submit">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add end -->

    <div id="editCategoryModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Categories</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_Categories_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label>Category Name</label>
                                    <input class="form-control" type="text" name="name" id="category_name">
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="edit_Categories_btn" type="submit"
                                    name="form_submit" value="submit">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".sidebar-categories").addClass('active');
    });    
</script>
    <script>
        $(function () {
            // add new Categories ajax request
            $("#add_Categories_form").submit(function (e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_Categories_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('categories.store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'Categories Added Successfully!',
                                'success'
                            )
                            fetchAllCategories();
                        }
                        $("#add_Categories_btn").text('Add Categories');
                        $("#add_Categories_form")[0].reset();
                        $("#addCategoriesModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Add categories fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                })
            });


            // edit Categories ajax request
            $(document).on('click', '.editIcon', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('categories.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $("#id").val(response.id);
                        $("#category_name").val(response.name);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Edit categories fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }

                });
            });

            // update Categories ajax request
            $("#edit_Categories_form").submit(function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                const fd = new FormData(this);
                $("#edit_Categories_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('categories.update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Updated!',
                                'Categories Updated Successfully!',
                                'success'
                            )
                            fetchAllCategories();
                        }
                        $("#edit_Categories_btn").text('Update Categories');
                        $("#edit_Categories_form")[0].reset();
                        $("#editCategoryModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Update categories fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }

                });
            });

            // delete Categories ajax request
            $(document).on('click', '.deleteIcon', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete this category?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('categories.delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function (response) {
                                // console.log('success',response);
                                if(response.status == 'error'){
                                    // console.log("test");
                                    Swal.fire(
                                    'Category delete fails!',
                                    response.message,
                                    'error'
                                )
                                }else{
                                    // console.log("test2");
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )}
                                fetchAllCategories();
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // console.log('error',error);
                                // alert(xhr.status);
                                Swal.fire(
                                    'Category delete fails!',
                                    thrownError,
                                    'error'
                                )
                                
                                // alert(thrownError);
                            }
                        });
                    }
                })
            });

            // fetch all Categories ajax request
            fetchAllCategories();

            function fetchAllCategories() {
                $.ajax({
                    url: '{{ route('categories.fetchAll') }}',
                    method: 'get',
                    success: function (response) {
                        $("#show_all_Categories").html(response);
                        $("table").DataTable({
                            // order: [0, 'desc']
                        });
                    }
                });
            }
        });
    </script>
@endsection
