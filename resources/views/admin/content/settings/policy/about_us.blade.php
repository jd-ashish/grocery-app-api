@section('style')

@endsection
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(['Dashboard', 'POLICY', 'About Us']) }}
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <a href="{{ route('about_us') }}" target="__blank">
                            <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                                <i class="mdi mdi-link-variant text-muted"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('privacy.policy.save') }}">
            @csrf
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About Us</h4>
                            <input name="key" value="about_us" type="hidden" />
                            <textarea class="PageContent" id="PageContent" name="val">{!! (setting("about_us")) !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 grid-margin stretch-card"></div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="template-demo float-right">
                                <button type="submit" class="btn btn-outline-primary btn-icon-text load">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
</div>


@section('script')
<script src="https://www.maniyarbangles.com/public/js/tiny_editor.js"></script>
<script>
        (function($) {
  'use strict';

  /*Tinymce editor*/
  if ($(".PageContent").length) {
    tinymce.init({
      selector: '.PageContent',
      height: 500,
      theme: 'silver',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
      ],
      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
      image_advtab: true,
      templates: [{
          title: 'Test template 1',
          content: 'Test 1'
        },
        {
          title: 'Test template 2',
          content: 'Test 2'
        }
      ],
      content_css: []
    });
  }

})(jQuery);
    </script>
@endsection
