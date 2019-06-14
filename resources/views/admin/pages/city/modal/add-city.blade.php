<div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">اضافه مدينه جديده</h4>
            </div>
            <form action="{{ route('admin.cities.add') }}" enctype="multipart/form-data" method="post" onsubmit="return false;">
                {!! csrf_field() !!}
                <input type="hidden" name="country_id" id="CountryID">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>اسم المدينه</label>
                            <input type="text" class="form-control" name="name" placeholder="ex:الاسكندريه">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="button" data-loading="انتظر..." class="btn btn-primary btn-flat addBTN">
                        حفظ<span class="glyphicon glyphicon-save"> </span>
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
