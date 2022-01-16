 <!-- The Modal -->
 <div class="modal fade myModal mt-5">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header bg-danger text-white">
                 <h4 class="modal-title delete_form_title">Modal Heading</h4>
                 <button type="button" class="close" model-iid=".myModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>

             <!-- Modal body -->
             <div class="modal-body">
                 <form class="form-controll delete_form" method="post">
                     @csrf
                     <h4 class="pb-5 text-center mt-5">Are you sure ?</h4>
                     <button type="submit" class="btn btn-danger float-right load delete_form_btn_name">Delete now</button>
                 </form>

             </div>

         </div>
     </div>
 </div>

  <!-- The Modal -->
  <div class="modal fade myModal-dynamic mt-5">
    <div class="modal-dialog modal-lg">
        <div class="modal-content dy_content_modal">



        </div>
    </div>
</div>





 <div class="modal fade" id="media_upload_modal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Media Uploads</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                         <a class="nav-link active" id="upload_media_image" data-toggle="tab" href="#upload_files"
                             role="tab" aria-selected="true">Upload Files</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" data-toggle="tab" href="#media_library" role="tab"
                             id="load_all_media_images" aria-controls="media_library" aria-selected="false">Media
                             Library</a>
                     </li>
                 </ul>
                 <div class="tab-content">
                     <div class="tab-pane fade show active" id="upload_files" role="tabpanel">
                         <div class="dropzone-form-wrapper">
                             <form action="{{ route('media.upload') }}" method="post" id="placeholderfForm"
                                 class="dropzone" enctype="multipart/form-data">
                                 @csrf
                             </form>
                         </div>
                     </div>
                     <div class="tab-pane fade" id="media_library" role="tabpanel">
                         <div class="all-uploaded-images">

                             <div class="main-content-area-wrap">
                                 {{-- <div class="image-preloader-wrapper">
                                     <div class="lds-spinner">
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                         <div></div>
                                     </div>
                                 </div> --}}
                                 <ul class="media-uploader-image-list">
                                 </ul>
                                 <div class="media-uploader-image-info">
                                     <div class="img-wrapper">
                                         <img src="" alt="">
                                     </div>
                                     <div class="img-info">
                                         <h5 class="img-title"></h5>
                                         <ul class="img-meta" style="display: none">
                                             <li class="date"></li>
                                             <li class="dimension"></li>
                                             <li class="size"></li>
                                             <li class="image_id" style="display:none;"></li>
                                             <li class="imgsrc"></li>
                                             <li class="imgalt">
                                                 <div class="img-alt-wrap float-left">
                                                     {{-- <input type="text" name="img_alt_tag">
                                                     <button class="btn btn-xs btn-success img_alt_submit_btn mt-2"><i class="mdi mdi-marker-check"></i></button> --}}

                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="img_alt_tag" placeholder="update tag">
                                                        <div class="btn btn-xs btn-success img_alt_submit_btn input-group-append pointer" style="height: 40px; color:white">
                                                          <span ><i class="mdi mdi-marker-check mt-5 " ></i></span>
                                                        </div>
                                                    </div>

                                                    <a tabindex="0"
                                                        class="btn btn-danger btn-xs mb-3 mr-1 pointer media_library_image_delete_btn text-white float-right mt-2"
                                                        style="display: none">
                                                        <i class=" mdi mdi-delete-forever "></i>
                                                    </a>
                                                 </div>


                                             </li>
                                         </ul>

                                     </div>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary media_upload_modal_submit_btn" class="close" data-dismiss="modal" aria-label="Close" style="display: none">Set
                     Image</button>
             </div>
         </div>
     </div>
 </div>
