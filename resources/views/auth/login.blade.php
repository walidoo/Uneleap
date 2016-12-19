<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.min.css') }}" >
        <link rel="stylesheet" href="{{ URL::asset('public/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/css/form-elements.css') }}" >
        <link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}" >
        <link rel="canonical" href="http://www.bootstraptoggle.com">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/styles/github.min.css" rel="stylesheet" >
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap-toggle.min.css') }}" >
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.css" type="text/css"/>
        <script  src="{{ URL::asset('public/js/jquery-1.11.1.min.js') }}"  ></script>
        <script  src="{{ URL::asset('public/js/functions.js') }}" ></script>

    </head>

    <body class="login-page" style="background-color: #ffffff">


        <!-- Top content -->
        <div class="top-content" align="center">
            
            <div class="inner-bg">
                <div class="container" align="center">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">

                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-*-*"></div>
                        <div class="col-*-*"></div>
                        <div class="col-*-*"></div>
                    </div>
                    
                    
                    <div class="row " >
                        <div class="col-sm-4 col-sm-offset-4 form-box  text-center" style="background-color:#fff;border-radius: 24px;">

                             <form  id="loginForm" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}  
                        

                                <fieldset>
                                    <!--div style="float:right; font-size: 90%; position: relative; top:-10px"><i class='fa fa-language' style="color:black; margin-right:5px; size: 25px; font-size: 25px;"> </i><a href="#" style="font-size: medium; color:#000"   data-toggle="modal" data-target="#myModal">Language</a></div!-->
                                    <div class="form-top" style="background-color:#fff;" >
                                        <div class="form-top-left">

                                            </br>
                                            <p></p>
                                        </div>

                                    </div>
                                    <div  align="center">
                                        <img  src="{{URL::asset('public/images/icon.png')}}">
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" role="dialog" >
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Select Language</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><select class="input-medium bfh-languages form-control input-xlarge  " data-language="en">
                                                            <option value="--Select--">--Select--</option><option value="om">Afaan Oromoo</option><option value="aa">Afaraf</option><option value="af">Afrikaans</option><option value="ak">Akan</option><option value="an">Aragonés</option><option value="ig">Asụsụ Igbo</option><option value="gn">Avañe'ẽ</option><option value="ae">Avesta</option><option value="ay">Aymar Aru</option><option value="az">Azərbaycan Dili</option><option value="id">Bahasa Indonesia</option><option value="ms">Bahasa Melayu</option><option value="bm">Bamanankan</option><option value="jv">Basa Jawa</option><option value="su">Basa Sunda</option><option value="bi">Bislama</option><option value="bs">Bosanski Jezik</option><option value="br">Brezhoneg</option><option value="ca">Català</option><option value="ch">Chamoru</option><option value="ny">Chicheŵa</option><option value="sn">Chishona</option><option value="co">Corsu</option><option value="cy">Cymraeg</option><option value="da">Dansk</option><option value="se">Davvisámegiella</option><option value="de">Deutsch</option><option value="nv">Diné Bizaad</option><option value="et">Eesti</option><option value="na">Ekakairũ Naoero</option><option value="en">English</option><option value="es">Español</option><option value="eo">Esperanto</option><option value="eu">Euskara</option><option value="ee">Eʋegbe</option><option value="to">Faka Tonga</option><option value="mg">Fiteny Malagasy</option><option value="fr">Français</option><option value="fy">Frysk</option><option value="ff">Fulfulde</option><option value="fo">Føroyskt</option><option value="ga">Gaeilge</option><option value="gv">Gaelg</option><option value="sm">Gagana Fa'a Samoa</option><option value="gl">Galego</option><option value="sq">Gjuha Shqipe</option><option value="gd">Gàidhlig</option><option value="ki">Gĩkũyũ</option><option value="ha">Hausa</option><option value="ho">Hiri Motu</option><option value="hr">Hrvatski Jezik</option><option value="io">Ido</option><option value="rw">Ikinyarwanda</option><option value="rn">Ikirundi</option><option value="ia">Interlingua</option><option value="nd">Isindebele</option><option value="nr">Isindebele</option><option value="xh">Isixhosa</option><option value="zu">Isizulu</option><option value="it">Italiano</option><option value="ik">Iñupiaq</option><option value="pl">Język Polski</option><option value="mh">Kajin M̧ajeļ</option><option value="kl">Kalaallisut</option><option value="kr">Kanuri</option><option value="kw">Kernewek</option><option value="kg">Kikongo</option><option value="sw">Kiswahili</option><option value="ht">Kreyòl Ayisyen</option><option value="kj">Kuanyama</option><option value="ku">Kurdî</option><option value="la">Latine</option><option value="lv">Latviešu Valoda</option><option value="lt">Lietuvių Kalba</option><option value="ro">Limba Română</option><option value="li">Limburgs</option><option value="ln">Lingála</option><option value="lg">Luganda</option><option value="lb">Lëtzebuergesch</option><option value="hu">Magyar</option><option value="mt">Malti</option><option value="nl">Nederlands</option><option value="no">Norsk</option><option value="nb">Norsk Bokmål</option><option value="nn">Norsk Nynorsk</option><option value="uz">O'zbek</option><option value="oc">Occitan</option><option value="ie">Interlingue</option><option value="hz">Otjiherero</option><option value="ng">Owambo</option><option value="pt">Português</option><option value="ty">Reo Tahiti</option><option value="rm">Rumantsch Grischun</option><option value="qu">Runa Simi</option><option value="sc">Sardu</option><option value="za">Saɯ Cueŋƅ</option><option value="st">Sesotho</option><option value="tn">Setswana</option><option value="ss">Siswati</option><option value="sl">Slovenski Jezik</option><option value="sk">Slovenčina</option><option value="so">Soomaaliga</option><option value="fi">Suomi</option><option value="sv">Svenska</option><option value="mi">Te Reo Māori</option><option value="vi">Tiếng Việt</option><option value="lu">Tshiluba</option><option value="ve">Tshivenḓa</option><option value="tw">Twi</option><option value="tk">Türkmen</option><option value="tr">Türkçe</option><option value="ug">Uyƣurqə</option><option value="vo">Volapük</option><option value="fj">Vosa Vakaviti</option><option value="wa">Walon</option><option value="tl">Wikang Tagalog</option><option value="wo">Wollof</option><option value="ts">Xitsonga</option><option value="yo">Yorùbá</option><option value="sg">Yângâ Tî Sängö</option><option value="is">ÍSlenska</option><option value="cs">čEština</option><option value="el">ελληνικά</option><option value="av">авар мацӀ</option><option value="ab">аҧсуа бызшәа</option><option value="ba">башҡорт теле</option><option value="be">беларуская мова</option><option value="bg">български език</option><option value="os">ирон æвзаг</option><option value="kv">коми кыв</option><option value="ky">Кыргызча</option><option value="mk">македонски јазик</option><option value="mn">монгол</option><option value="ce">нохчийн мотт</option><option value="ru">русский язык</option><option value="sr">српски језик</option><option value="tt">татар теле</option><option value="tg">тоҷикӣ</option><option value="uk">українська мова</option><option value="cv">чӑваш чӗлхи</option><option value="cu">ѩзыкъ словѣньскъ</option><option value="kk">қазақ тілі</option><option value="hy">Հայերեն</option><option value="yi">ייִדיש</option><option value="he">עברית</option><option value="ur">اردو</option><option value="ar">العربية</option><option value="fa">فارسی</option><option value="ps">پښتو</option><option value="ks">कश्मीरी</option><option value="ne">नेपाली</option><option value="pi">पाऴि</option><option value="bh">भोजपुरी</option><option value="mr">मराठी</option><option value="sa">संस्कृतम्</option><option value="sd">सिन्धी</option><option value="hi">हिन्दी</option><option value="as">অসমীয়া</option><option value="bn">বাংলা</option><option value="pa">ਪੰਜਾਬੀ</option><option value="gu">ગુજરાતી</option><option value="or">ଓଡ଼ିଆ</option><option value="ta">தமிழ்</option><option value="te">తెలుగు</option><option value="kn">ಕನ್ನಡ</option><option value="ml">മലയാളം</option><option value="si">සිංහල</option><option value="th">ไทย</option><option value="lo">ພາສາລາວ</option><option value="bo">བོད་ཡིག</option><option value="dz">རྫོང་ཁ</option><option value="my">ဗမာစာ</option><option value="ka">ქართული</option><option value="ti">ትግርኛ</option><option value="am">አማርኛ</option><option value="iu">ᐃᓄᒃᑎᑐᑦ</option><option value="oj">ᐊᓂᔑᓈᐯᒧᐎᓐ</option><option value="cr">ᓀᐦᐃᔭᐍᐏᐣ</option><option value="km">ខ្មែរ</option><option value="zh">中文&nbsp;(Zhōngwén)</option><option value="ja">日本語&nbsp;(にほんご)</option><option value="ii">ꆈꌠ꒿ Nuosuhxop</option><option value="ko">한국어&nbsp;(韓國語)</option>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Modal -->

                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif

                                    @if ($message = Session::get('warning'))
                                        <div class="alert alert-warning">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif

                                    <div class="form-bottom" style="background-color:#fff;" >
                                    <div id="messagebox" style="background-color:#F00; color:#FFF; font-size:18px; font-weight:800" align="center"></div>
                                    
                                        <div class="form-group">
                                        <div class="">
                                            <label class="sr-only" for="form-first-name">Email ID</label>
                                            <input type="text"  name="user_name" value="{{ old('user_name') }}" id="user_name" placeholder="User Name" class="form-first-name form-control validate[required]">
                                            @if ($errors->has('user_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('user_name') }}</strong>
                                                </span>
                                            @endif
                                                <span class="help-block">
                                                    <strong></strong>
                                                </span>
                                            
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="">
                                            <label class="sr-only" for="form-last-name">Password</label>
                                            <input type="password"    name="password" placeholder="Password" class="form-last-name form-control validate[required,minSize[6]]" id="user_password">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                          
                                                <span class="help-block">
                                                    <strong></strong>
                                                </span>
                                           


                                            </br>

                                            <div class="">
                                                <button type="submit" class="btn btn-warning  btn-block " style="border-radius: 24px; font-weight: 700; background-color: #e67e22 " >Sign In</button>
                                            </div>


                                            </br>






                                                <div class="form-footer">
                                                    <div class="row">
                                                        <div class="col-xs-12">

                                                            <input  style="margin-left:0px" checked data-toggle="toggle" data-style="ios"   data-on="Save" data-off="Not Saved"  name="remember" id="remember" data-onstyle="success" data-offstyle="danger" type="checkbox" >
                                                            <a id="forgot_from_1" href="/user/forgotPassword" style=" font-size: 13px;  margin-left:-10px; letter-spacing:-1px " class='btn btn-link'>Forgot password?</a>|<a  href="{{ url('/register') }}" class='btn btn-link' style=" font-size: 13px; letter-spacing:-1px ">New Account</a>|<a  href="/user/needHelp" class='btn btn-link' style=" font-size: 13px; letter-spacing:-1px ">Need Help?</a>
                                                        </div>
                                                    </div>

                                        </div>
                                        <div class="clearfix"></div>

                                        <div >

                                        </div>

                                    </div>



                                </fieldset>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>



<script type="text/javascript">

$(document).ready(function() {
      $("#loginForm").validationEngine();
});
</script>

        <!-- Javascript -->
        
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script  src="{{ URL::asset('public/js/bootstrap.min.js') }}"  ></script>
        <script  src="{{ URL::asset('public/js/jquery.backstretch.min.js') }}" ></script>
        <script  src="{{ URL::asset('public/js/retina-1.1.0.min.js') }}" ></script>
        <script  src="{{ URL::asset('public/js/scripts.js') }}" ></script>
        <script  src="{{ URL::asset('public/js/placeholder.js') }}" ></script>
        <script  src="{{ URL::asset('public/js/bootstrap-toggle.js') }}" ></script>
     

    </body>

</html>