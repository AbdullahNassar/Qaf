<div id="categories-wrap" class="table-layout">
    <div class="row">
        @if(sizeof($all) > 0)
        @foreach($all as $ad)
            <div class="col-md-4">
                <div class="pro-item">
                    <div class="pro-item-head">
                        <div class="pro-item-img">
                            <img src="{{url('storage/uploads/banners/'.$ad->images[0]->image)}}">
                        </div><!--End pro-item-itmg-->
                        <div class="verified" data-toggle="tooltip" data-placement="left" title="" data-original-title="موثوق">
                            <i class="fa fa-check-square-o"></i>
                        </div>
                    </div><!-- End pro-item-head -->
                    <div class="pro-item-content">
                        <div class="title-price">
                            <h3 class="title">{{$ad->name}}</h3>
                            <span class="price">{{$ad->price}} ر.س</span>
                        </div><!-- End Title-Price -->
                        <ul class="breadcrumb">
                            <li><a href="{{route('site.category',['slug' => $ad->MainCategory()->slug])}}">{{$ad->MainCategory()->name}}</a></li>
                            <li class="active">{{$ad->type['name']}}</li>
                        </ul>
                        <p>
                            {!! $ad->description !!}
                        </p>
                        <div class="pro-item--map-date">
                            <div class="pro-item--map">
                                <i class="fa fa-map-marker"></i>
                                @foreach($ad->places as $place)
                                    {{$place->name}} ,
                                @endforeach
                            </div><!--End pro-item--map-->
                            <div class="pro-item--date">
                                <i class="fa fa-clock-o"></i>
                                {{ar_date($ad->created_at->timestamp)}}
                            </div><!--End pro-item--date-->
                        </div><!--End map-date-->

                        <a href="{{route('site.ad.only',['slug'=>$ad->slug])}}" class="see-more">مشاهدة الاعلان</a>
                    </div><!-- End pro-item-Content -->
                </div><!-- End pro-item -->
            </div><!--End col-md-4-->
        @endforeach
            @else
        <div class="alert alert-danger">
            <h3>لا توجد نتائج</h3>
        </div>
        @endif
    </div><!--End row-->
</div>
@if(sizeof($all) > 0)
    {{$all->links()}}
@endif