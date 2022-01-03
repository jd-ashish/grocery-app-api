<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(['Dashboard', 'Settings', 'Image Slider']) }}
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <a href="{{ route('upload.slider-image') }}" class="btn btn-primary mt-2 mt-xl-0"><span
                                class="mdi mdi-folder-multiple-image"></span> Upload image
                            slider</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User list</h4>
                        <div class="table-responsive pt-3">
                            <table id="table" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Total Slider Image</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slider as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ get_image_by_upload_id(explode('|', $item->image)[0]) }}"
                                                    width="50">{{ $item->name }}</td>

                                            <td> {{ count(explode('|', $item->image)) }} </td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td style="cursor: pointer">
                                                @php
                                                    $arr = [];
                                                    $arr[] = [
                                                        'route' => route('delete.slider.image', encrypt($item->id)),
                                                        'name' => 'Delete slider',
                                                        'name2' => '',
                                                        'id' => $item->id,
                                                        'isLink' => false,
                                                        'isDelete' => true,
                                                        'icon' => '<i class="mdi mdi-delete-forever text-danger"></i>',
                                                    ];
                                                    $arr[] = [
                                                        'route' => route('edit.slider.image', encrypt($item->id)),
                                                        'name' => 'Edit Slider',
                                                        'name2' => '',
                                                        'id' => $item->id,
                                                        'isLink' => true,
                                                        'isDelete' => false,
                                                        'icon' => '<i class="mdi mdi-tooltip-edit text-success"></i>',
                                                    ];
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
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection
