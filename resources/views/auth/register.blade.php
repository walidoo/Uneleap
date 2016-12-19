<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Registration</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.min.css') }}" >
        <link rel="stylesheet" href="{{ URL::asset('public/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/css/form-elements.css') }}" >
        <link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.css" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


        <link rel="shortcut icon" href="images/favicon.ico">
        <script src="{{ URL::asset('public/js/jquery-1.11.1.min.js') }}"></script> 
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <style>
            .panel-back {

                background-color: #7D4165;
                -webkit-animation-name: example; /* Chrome, Safari, Opera */
                -webkit-animation-duration: 20s; /* Chrome, Safari, Opera */
                animation-name: example;
                animation-duration: 20s;
            }

            /* Chrome, Safari, Opera */
            @-webkit-keyframes example {
                from {background-color: #7E6D35;}
                to {background-color: #7D4165;}
            }

            /* Standard syntax */
            @keyframes example {
                from {background-color: #7E6D35;}
                to {background-color:#7D4165; }
            }
        </style>
        <style>

            .passstrength {
                color:red;
                font-family:verdana;
                font-size:10px;
                font-weight:bold;
            }   

            .ok {
                color:green;
                font-family:verdana;
                font-size:10px;
                font-weight:bold;
            }
            .alert {
                color:orange;
                font-family:verdana;
                font-size:10px;
                font-weight:bold;
            }   

            .error{
                color:orange;
                font-family:verdana;
                font-size:10px;
                font-weight:bold;
            }
            ::-webkit-input-placeholder {
                color: #eee;
            }

            :-moz-placeholder { /* Firefox 18- */
                color: #eee;
            }

            ::-moz-placeholder {  /* Firefox 19+ */
                color: #eee;
            }

            :-ms-input-placeholder {
                color: #eee;
            }

            .reg-width{
                width:800px;    
            }

            @media screen and (min-width: 980px) /* Desktop */ {
                .reg-width{
                    width:98%;  
                }

            }       

            @media screen  and (max-width: 979px) /* Tablet */ {
                .reg-width{
                    width:80%;  
                }

            }

            @media screen and (max-width: 500px) /* Mobile */ {

                .reg-width{
                    width:70%;  
                }
                .inner-bg
                {
                    width:70%;  
                }
                .col-sm-6
                {
                    width:70%;  
                }

                .col-sm-offset-3
                {
                    width:70%;  
                }


            }
        </style>


    </head>

    <body class="register">



        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container" style="width:800px">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">

                        </div>
                    </div>
                    <div class="row reg-width">
                        <div class="col-sm-7 col-sm-offset-3 " style=" background-color: #407F76">

                            <form  action="{{ url('/register') }}" role="form" id="registerForm" method="post" >

                                <div class="registerFormContainer">
                                    <div  align="center">
                                        <img  src="{{URL::asset('public/images/icon.png')}}">
                                    </div>
                                    {{ csrf_field() }}

                                    <div class="form-bottom" style=" background-color: #407F76">

                                        <div class="form-top-left">
                                            <label>
                                                <input type="radio" name="user_type" value="1" checked/>Student
                                            </label>&nbsp; &nbsp; 
                                            <label>
                                                <input type="radio" name="user_type" value="2"/>Faculty
                                            </label>&nbsp; &nbsp; 
                                            <label>
                                                <input type="radio" name="user_type" value="3"/>Guest
                                            </label>
                                        </div>       
                                        <br><br><br>        
                                        <div class="form-group  form-group-sm">
                                            <label class="sr-only" for="form-first-name">Full name</label>
                                            <input type="text" name="name" placeholder="Full Name..."  class="form-control validate[required]"  id="name">
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <input type="text" name='user_name' placeholder="User Name" class="form-control" id="post_title">
                                            @if ($errors->has('user_name'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('user_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="sr-only" for="form-last-name">Password</label>
                                            <input id="password"  type="password" name="password" placeholder="password..."   class="validate[required,minSize[6]] form-last-nfame form-control" ><span id="passstrength" class='passstrength'></span>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="sr-only" for="form-last-name">Confirm password</label>
                                            <input type="password"  id="confirm_password" placeholder="Confirm password..."   name="password_confirmation"   class="form-last-name form-control  validate[required,equals[password]]" ><span id="cn_passstrength" class='passstrength'></span>
                                            @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="sr-only" for="form-email">country</label>
                                            @include('pages.common.countriesWithOutMultiSelect')
                                        </div>
                                        <div class="form-group form-group-sm" >
                                            <label class="sr-only" for="form-email">Gender</label>
                                            <select class="form-control validate[required]"  name='gender'  id='gender' data-style="btn-info">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>

                                            </select>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="sr-only" for="form-email">Email</label>
                                            <input type="text" name="email" placeholder="Email..." class="form-email form-control validate[required,custom[email]]" id="email">
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>                  
                                        <div id="studentForm">
                                            <!--awais !-->
                                            <div class="form-group form-group-sm">
                                                <label class="sr-only" >University</label>
                                                <select data-placeholder="Choose a university..." name="university" class="chosen-select form-control validate[required] js-data-example-ajax">
                                                <option value="1">Alexandria</option>
                                                </select> 
                                            </div>

                                            <div class="form-group form-group-sm">
                                                <label class="sr-only" >student id </label>
                                                <input type="text" name="university_id" placeholder="student id..."  class="form-control validate[required]" id="student_id">
                                                <span id="no-results"></span>
                                            </div>   
                                            <div class="form-group form-group-sm">
                                                <label class="sr-only" for="form-repeat-password">Major</label>
                                                <select id="coursesList" data-placeholder="Choose  Major Course..." name="degree" class="chosen-select form-control validate[required]">
                                                <option value="1">Computer Science</option>
                                                </select>  
                                            </div>
                                            <div class="form-group  form-group-sm">
                                                <label class="sr-only" for="form-password">Student Type</label>
                                                <select class="form-control validate[required]"  name='type' data-style="btn-info" id='type_guest'>
                                                    <option value="">Select Type</option>
                                                    <option value="Alumni">Alumni</option>
                                                    <option value="graduate">Under-Graduate</option>
                                                    <option value="Post-graduate">Post-graduate</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div id="facultyForm" style="display:none">

                                            <div class="form-group form-group-sm">
                                                <label class="sr-only" >University</label>
                                                <select  style="width: 100%;" data-placeholder="Choose a university..." name="university" class="chosen-select form-control validate[required] js-data-example-ajax">
                                                </select> 
                                            </div>
                                            <div class="form-group  form-group-sm">
                                                <label class="sr-only" for="form-password">faculty id</label>
                                                <input type="text" name="university_id" placeholder="faculty id..." class="validate[required] form-password form-control" id="faculty_id">
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="sr-only" for="form-repeat-password">Major</label>
                                                <select id="coursesListFaculty" data-placeholder="Choose  Major Course..." name="degree" class="chosen-select form-control validate[required]">
                                                </select>  
                                            </div>
                                            <div class="form-group  form-group-sm">
                                                <label class="sr-only" for="form-password">Title</label>
                                                <input type="text" name="job_title" placeholder="Job Title..." class="validate[required] form-password form-control" id="job_title">
                                            </div>
                                        </div>

                                        <div id="guestForm" style="display:none">
                                            <div class="form-group  form-group-sm">
                                                <label class="sr-only" for="form-password">Description</label>
                                                <input type="text" name="description" placeholder="Description..." class="validate[required] form-control" id="description">
                                            </div>
                                            <div class="form-group  form-group-sm">
                                                <label class="sr-only" for="form-password">User Type</label>
                                                <select class="form-control validate[required]"  name='type' data-style="btn-info" id='type_guest'>
                                                    <option value="">Select Type</option>
                                                    <option value="High school">High school</option>
                                                    <option value="Company/sponsor">Company/sponsor </option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="formFooter" style="margin-left: 10%;width: 85%;">
                                            <div class="form-group  form-group-sm">
                                                <span style="color: #ffffff;">
                                                    <label class="sr-only" for="form-password"></label>
                                                    <input id="termsCheck" type="checkbox" data-reverse>
                                                    <span style="color:#000;">Check to confirm you have read and accepted the </span><span><a style="color:#19b9e7;text-decoration: underline;" href="/user/termsOfServices" target="_blank">Terms of Service</a>.</span> 
                                                </span>
                                            </div> 
                                            <button onClick="submitRegisterForm()" type="button" class="btn">Sign me up!</button>
                                            <div class="sign-in-old-user">
                                                <p>You already signed up!</p>
                                                <button   onClick="previous();" class="btn">Sign in here!</button>
                                        </div>
                                        <br><br>
                                    </div>  
                                </div>          
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>



        <script  src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

        <script src="{{ URL::asset('public/js/bootstrap.min.js') }}" ></script>
        <script  src="{{ URL::asset('public/js/jquery.backstretch.min.js') }}" ></script>
        <script  src="{{ URL::asset('public/js/retina-1.1.0.min.js') }}" ></script>
        <script  src="{{ URL::asset('public/js/scripts.js') }}" ></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    </body>

</html>
<script>

function previous()
{
    window.location = "/login";
}
function submitRegisterForm()
{
    if($('#termsCheck').is(':checked'))
    {
        $("#registerForm").submit();
    }else{
        alert("Pleas Confirm that you have Read Terms & Conditions");
    }
}
$(document).ready(function () {

    $("#registerForm").validationEngine();
    $('#facultyForm :input').attr('disabled', 'disabled');
    $('#guestForm :input').attr('disabled', 'disabled');
    $('input[type=radio][name=user_type]').change(function () {

        if (this.value == "2") {
            $("#studentForm").fadeOut("slow");
            $("#guestForm").fadeOut("slow");
            $("#facultyForm").fadeIn("slow");
            $('#facultyForm :input').removeAttr('disabled');
            $('#studentForm :input').attr('disabled', 'disabled');
            $('#guestForm :input').attr('disabled', 'disabled');
            $("#coursesListFaculty").select2({
                ajax: {
                    url: '/courses/coursesList',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });
        }
        else if (this.value == "3") {
            $("#facultyForm").fadeOut("slow");
            $("#studentForm").fadeOut("slow");
            $("#guestForm").fadeIn("slow");
            $('#guestForm :input').removeAttr('disabled');
            $('#studentForm :input').attr('disabled', 'disabled');
            $('#facultyForm :input').attr('disabled', 'disabled');
        }
        else if (this.value == "1") {
            $("#facultyForm").fadeOut("slow");
            $("#guestForm").fadeOut("slow");
            $("#studentForm").fadeIn("slow");
            $('#studentForm :input').removeAttr('disabled');
            $('#facultyForm :input').attr('disabled', 'disabled');
            $('#guestForm :input').attr('disabled', 'disabled');
        }
    });
});

$(".js-data-example-ajax").select2({
    ajax: {
        url: '/universities/list',
        dataType: 'json',
        data: function (params) {
            return {
                term: params.term || '',
                page: params.page || 1
            }
        },
        cache: true
    }
});
$("#coursesList").select2({
    ajax: {
        url: '/courses/coursesList',
        dataType: 'json',
        data: function (params) {
            return {
                term: params.term || '',
                page: params.page || 1
            }
        },
        cache: true
    }
});

</script>