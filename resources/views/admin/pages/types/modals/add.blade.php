<div class="modal fade" id="add-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">اضافه فئة جديدة</h4>
            </div>
            <form action="{{ route('admin.types.add') }}"
                enctype="multipart/form-data" method="post"
                onsubmit="return false;">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>اسم الفئة</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label>القسم الرئيسي</label>
                            <select class="form-control" name="category_id">
                                @foreach (App\Category::mains() as $main)
                                    <option value="{{ $main->id }}">{{ $main->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>الايقونة</label>
                            <select name="icon"  style="font-family: FontAwesome,'arial'; font-size: 16pt;"class="text-center form-control ">
                              @foreach(SMKFontAwesome\SMKFontAwesome::getArray() as $key => $value)
                                  <option value="{{ $key }}">{{ $value }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="button" data-loading="انتظر..." class="btn btn-primary ajax-submit btn-flat">
                        حفظ<span class="glyphicon glyphicon-save"> </span>
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
