<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget">
                    <div class="widget-title">
                        <h3 class="title has-before">من نحن</h3>
                    </div><!--End widget-title-->
                    <div class="widget-content">
                        <p>
                            {{$settings->description}}
                        </p>
                        <ul class="contact-list">
                            @foreach($contacts as $contact)
                                <li>
                                    <i class="fa {{$contact->icon}}"></i>
                                    <p>{{$contact->title}} : {{$contact->content}}</p>
                                </li>
                            @endforeach
                        </ul><!--End social-list-->
                    </div><!--End widget-content-->
                </div><!--End widget-->
            </div><!--End col-md-4-->
            <div class="col-md-4">
                <div class="widget">
                    <div class="widget-title">
                        <h3 class="title has-before">روابط سريعة</h3>
                    </div><!--End widget-title-->
                    <div class="widget-content">
                        <ul class="important-links list-second">
                            <li>
                                <a href="#">الاعلان فى الموقع </a>
                            </li>
                            <li>
                                <a href="#">الاعلان فى الموقع </a>
                            </li>
                            <li>
                                <a href="#">شروط الاستخدام</a>
                            </li>
                            <li>
                                <a href="#">شروط الاستخدام</a>
                            </li>
                            <li>
                                <a href="#">سياسة الخصوصية</a>
                            </li>
                            <li>
                                <a href="#">سياسة الخصوصية</a>
                            </li>
                            <li>
                                <a href="#">مساعدة</a>
                            </li>
                            <li>
                                <a href="#">مساعدة</a>
                            </li>
                            <li>
                                <a href="#">سؤال وجواب</a>
                            </li>
                            <li>
                                <a href="#">سؤال و جواب</a>
                            </li>
                        </ul><!--End important-links-->
                    </div><!--End widget-content-->
                </div><!--End widget-->
            </div><!--End col-md-4-->
            <div class="col-md-4">
                <div class="widget">
                    <div class="widget-title">
                        <h3 class="title has-before">ابق على تواصل معنا</h3>
                    </div><!--End widget-title-->
                    <div class="widget-content">
                        <form class="subscribe-form" action="{{route('site.subscribe')}}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <input type="email" name="email" class="form-control" placeholder="ادخل بريدك الالكتروني">

                            <button type="submit" class="custom-btn">اشترك</button>
                        </form><!--End subscribe-form-->
                        <ul class="social-list">
                            @if(!empty($settings->facebook))
                            <li>
                                <a href="{{$settings->facebook}}">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            @endif
                            @if(!empty($settings->twitter))
                            <li>
                                <a href="{{$settings->twitter}}">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            @endif
                            @if(!empty($settings->google))
                            <li>
                                <a href="{{$settings->google}}">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            @endif
                            @if(!empty($settings->youtube))
                            <li>
                                <a href="{{$settings->youtube}}">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div><!--End widget-content-->
                </div><!--End widget-->
            </div><!--End col-md-4-->
        </div><!--End row-->
    </div><!--End container-->
</footer><!--End footer-->
<div class="footer-copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                © جميع الحقوق محفوظة لـ
                <a href="{{route('site.home')}}">قاف</a>
                2016
            </div>
            <div class="col-sm-6 text-right">
                تصميم وتطوير
                <a href="">upureka</a>
            </div>
        </div><!--End Row-->
    </div><!--End Container-->
</div><!--End footer-copyright-->