<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="border-bottom text-center pb-4">
                    <img src="{{ (Auth::user()->avatar=="" || Auth::user()->avatar==null)? asset('images/faces/face5.jpg'): get_image_by_upload_id(Auth::user()->avatar) }}" alt="profile" class="img-lg rounded-circle mb-3"/>
                    <div class="mb-3">
                      <h3>{{  Auth::user()->name }}</h3>
                      <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0 me-2 text-muted">{{  Auth::user()->user_type }}</h5>
                      </div>
                    </div>
                    <p class="w-75 mx-auto mb-3"> </p>

                  </div>
                  <a href="{{ route('dashboard.user.details',encrypt(Auth::user()->id)) }}" class="btn btn-primary btn-block mb-2">Preview</a>
                </div>
                <div class="col-lg-8">
                  <div class="mt-4 py-2 border-top border-bottom">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.profile.profile') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <input type="hidden" value="{{ auth()->user()->id }}" name="id"/>
                                        <input type="text" class="form-control" placeholder="Your anme" aria-label="name" name="name" value="{{ Auth::user()->name }}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Your Email" aria-label="email" name="email" value="{{ Auth::user()->email }}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Your Phone" aria-label="phone" name="phone" value="{{ Auth::user()->phone }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Change Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Your password" aria-label="password" name="password" value=""/>
                                    </div>
                                </div>
                                <button class="btn btn-success float-right">Save data</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@section('script')
    <script>
        (function($) {
        'use strict';
        $(function() {
          $('#profile-rating').barrating({
            theme: 'css-stars',
            showSelectedRating: false
          });
        });
      })(jQuery);
    </script>
@endsection

