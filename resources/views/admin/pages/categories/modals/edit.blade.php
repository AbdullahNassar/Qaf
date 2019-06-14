<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">تعديل القسم بـ {{ $category->name }}</h4>
        </div>
        <form action="{{ route('admin.categories.edit', ['id' => $category->id]) }}"
        enctype="multipart/form-data" method="post"
        onsubmit="return false;">
        {!! csrf_field() !!}
        <div class="modal-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label>اسم القسم</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                </div>
                @if ($category->isSub())
                    <div class="form-group col-md-4">
                        <label>القسم الرئيسي</label>
                        <select class="form-control" name="parent_id">
                            @foreach (App\Category::mains() as $main)
                                <option value="{{ $main->id }}" {{ $category->parent_id == $main->id? 'selected' : '' }}>{{ $main->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group col-md-4">
                    <label>الايقونة</label>
                    <select name="icon"  style="font-family: FontAwesome,'arial'; font-size: 16pt;"class="text-center form-control ">
                        @foreach(SMKFontAwesome\SMKFontAwesome::getArray() as $key => $value)
                            <option value="{{ $key }}" {{ $key == $category->icon? 'selected' : '' }}>{{ $value }}</option>
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
