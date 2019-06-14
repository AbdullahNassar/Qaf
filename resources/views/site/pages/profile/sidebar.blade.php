<div class="col-md-3">
    <div class="dash-side box-item no-padding">
        <div class="dash-side-head">
            <img src="{{auth()->guard('members')->user()->image?url('storage/uploads/profile/'.auth()->guard('members')->user()->image):asset('assets/site/images/user-img.jpg')}}">
        </div><!--End dash-side-head-->
        <div class="dash-side-content">
            <ul class="dash-side-nav">
                <li @if(Request::route()->getName() == 'site.profile')class="active"@endif>
                    <a href="{{route('site.profile')}}">
                        لوحة التحكم
                    </a>
                </li>
                <li @if(Request::route()->getName() == 'site.profile.messages' ||
                        Request::route()->getName() == 'site.profile.received' ||
                        Request::route()->getName() == 'site.profile.sent')class="active"@endif>
                    <a href="{{route('site.profile.messages')}}">
                        الرسائل
                    </a>
                </li>
                <li @if(Request::route()->getName() == 'site.profile.ads')class="active"@endif>
                    <a href="{{route('site.profile.ads')}}">
                        اعلاناتى
                    </a>
                </li>

                <li @if(Request::route()->getName() == 'site.profile.favorite')class="active"@endif>
                    <a href="{{route('site.profile.favorite')}}">
                        مفضلتى
                    </a>
                </li>
                <li @if(Request::route()->getName() == 'site.profile.package')class="active"@endif>
                    <a href="{{route('site.profile.package')}}">
                        باقاتى
                    </a>
                </li>
                <li @if(Request::route()->getName() == 'site.profile.followers')class="active"@endif>
                    <a href="{{route('site.profile.followers')}}">
                        المتابعون
                    </a>
                </li>
                <li @if(Request::route()->getName() == 'site.profile.get-notification')class="active"@endif>
                    <a href="{{route('site.profile.get-notification')}}">
                        الاشعارات
                    </a>
                </li>
                <li @if(Request::route()->getName() == 'result-search')class="active"@endif>
                    <a href="{{route('result-search')}}">
                        نتائج البحث
                    </a>
                </li>
                <li @if(Request::route()->getName() == 'site.profile.settings')class="active"@endif>
                    <a href="{{route('site.profile.settings')}}">
                        الملف الشخصى
                    </a>
                </li>
                <li>
                    <a href="{{route('site.profile.closeAccount')}}">
                        اغلاق الحساب
                    </a>
                </li>
            </ul><!--End dash-side-nav-->
        </div><!--End dash-side-content-->
    </div>
    <!--End dash-side-->
</div><!--End col-md-3-->