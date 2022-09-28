 <!-- Modal Import-->
 <div class="modal fade" id="modal-import-data-transaksi" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h6 class="modal-title" id="importModalLabel">Import Data Transaksi</h6>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             </div>
             <div class="modal-body">
                 <div class="row clearfix">
                     <div class="col-md-12 col-sm-12 ">
                         <div class="pd-20 height-100-p">
                             <form method="POST" action="{{ route('import.transaksi') }}"
                                 enctype="multipart/form-data">
                                 @csrf
                                 <div class="row">
                                     <div class="col-md-12 col-sm-12">
                                         <div class="form-group">
                                             {{-- <label>Custom file input</label> --}}
                                             <div class="custom-file">
                                                 <input id="inputGroupFile02" type="file" name="file" required
                                                     class="custom-file-input">
                                                 <label class="custom-file-label">Pilih File (.xlsx)</label>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <button class="btn btn-primary btn-block btn-sm" type="submit">Import</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--End Modal Import-->
