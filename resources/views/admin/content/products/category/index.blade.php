<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(array("Dashboard","Products","Category")) }}
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                            <i class="mdi mdi-download text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-clock-outline text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-plus text-muted"></i>
                        </button>
                        <a href="{{ route('product.category.create') }}" class="btn btn-primary mt-2 mt-xl-0">Create Category</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Category list</h4>
                        <div class="table-responsive pt-3">
                            <table id="table" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ get_image_by_upload_id($item->upload_id) }}" height="50" width="50"></td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td style="cursor: pointer">
                                                @php
                                                    $arr = array();
                                                    $arr[] = array(
                                                        "route" => route('product.category.delete',$item->id),
                                                        "name" => "Delete category",
                                                        "name2" => $item->name,
                                                        "id" => $item->id,
                                                        "isLink" => false,
                                                        "isDelete" => true,
                                                        "icon" => '<i class="mdi mdi-delete-forever text-danger"></i>',
                                                    );
                                                    echo table_more($arr);
                                                @endphp
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

    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
</div>


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable();



        });
    </script>
@endsection
