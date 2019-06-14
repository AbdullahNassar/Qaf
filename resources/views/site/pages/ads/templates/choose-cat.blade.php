@if($results && count($results)>0)
    <div class="form-group col-md-12">
        <select class="ui-select-box choose-cats" name="{{$name}}" data-type="@if($name == 'category_id') cat @else type @endif">
            <option value="0">
                @if($name == 'category_id')اختر القسم@else اختر النوع @endif
            </option>
            @foreach($results as $result)
                <option value="{{$result->id}}">{{$result->name}}</option>
            @endforeach
        </select>
    </div><!--End form-group-->
@endif