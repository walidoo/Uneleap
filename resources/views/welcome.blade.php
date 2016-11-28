<!DOCTYPE html>
<html><head>
        <title>Uneleap</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src="http://www.goat1000.com/js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{ URL::asset('public/js/jquery.tagcanvas.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" type="text/javascript"></script>
        <script type="text/javascript">

window.addEventListener('load', function () {
    TagCanvas.Start('myCanvas', 'tags', {
        textColour: '#ff0000',
        reverse: true,
        depth: 0.5,
        maxSpeed: 0.03,
        centreImage: '/images/google.png'
    });
    startRes();
    var c = document.getElementById("myCanvas")
    c.height = 600;
    c.width = 600;





}, false);
function startRes() {



    //c.height =h/1.2;
    //c.width = w/2.2;


    TagCanvas.Start('myCanvas', 'tags', {
        initial: [0, 0.1],
        textColour: '#ff0000',
        reverse: true,
        depth: 0.5,
        maxSpeed: 0.03,
        centreImage: '/images/google.png'

    });
}





        </script>
        <style>

            @media screen and (min-width: 980px) /* Desktop */ {
                body {

                }
            }

            @media screen  and (max-width: 979px) /* Tablet */ {
                #myCanvas{

                    margin-top:120px;
                    width: 100%;
                }

            }

            @media screen and (max-width: 500px) /* Mobile */ {

                #myCanvas{

                    margin-top:100px;
                    width: 98%;
                }

            }
        </style>
    </head>
    <body>
        <div class="container"  >
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <div id="myCanvasContainer"  >
                            <canvas   width=600px height=600px  id="myCanvas" >
                                <p>Anything in here will be replaced on browsers that support the canvas element</p>
                            </canvas>
                        </div>
                        <div id="tags">
                            <ul>
                                <li><a href="{{ url('/login') }}"><img  src="{{URL::asset('public/images/abacus.png')}}"      alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img  src="{{URL::asset('public/images/alarm-clock.png')}}" alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img  src="{{URL::asset('public/images/biology.png')}}"    alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img  src="{{URL::asset('public/images/brainstorm.png')}}" alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img  src="{{URL::asset('public/images/graduate.png')}}"   alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img src="{{URL::asset('public/images/id-card.png')}}"     alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img src="{{URL::asset('public/images/law.png')}}"         alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img src="{{URL::asset('public/images/notebook.png')}}"    alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img src="{{URL::asset('public/images/printer.png')}}"     alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img src="{{URL::asset('public/images/video-chat.png')}}"  alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img src="{{URL::asset('public/images/violin.png')}}"      alt="" /></a></li>
                                <li><a href="{{ url('/login') }}"><img src="{{URL::asset('public/images/workspace.png')}}"   alt="" /></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
    </body>
</html>