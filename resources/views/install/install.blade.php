<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>FormWizard_v8</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="{{ asset('install/vendor/date-picker/css/datepicker.min.css') }}">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{ asset('install/css/style.css') }}">
        <style>
            .loader {
              background: #ffffff;
              opacity: 0.7;
              width: 100%;
              height: 100%;
              line-height: 50px;
              text-align: center;
              position: fixed;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              font-family: helvetica, arial, sans-serif;
              font-weight: 900;
              letter-spacing: 0.2em;
              z-index: 9999999;
              display:none;
            }
            .loader span {
              position: absolute;
              width: 250px;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              color: #000;
              text-transform: uppercase;
            }
            .loader span::before,
            .loader span::after {
              content: "";
              display: block;
              width: 15px;
              height: 15px;
              background: #ED5E29;
              position: absolute;
              animation: load 0.7s infinite alternate ease-in-out;
            }
            .loader span::before {
              top: 0;
            }
            .loader span::after {
              bottom: 0;
            }
            @keyframes load {
              0% {
                left: 0;
                height: 30px;
                width: 15px;
              }
              50% {
                height: 8px;
                width: 40px;
              }
              100% {
                left: 235px;
                height: 30px;
                width: 15px;
              }
            }

            .pointer{
                cursor: pointer;
            }

            </style>
	</head>
	<body>
        <input type="hidden" value="{{ csrf_token() }}" class="token"/>
        <div class="loader" ><span class="l-t">Loading...</span></div>
		<div class="wrapper">
            <form action="" id="wizard">
        		<!-- SECTION 1 -->
                <h4></h4>
                <section>
                    <h3>Basic details</h3>
                	<div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi zmdi-account"></i>
                            <input type="text" class="form-control first_name" name="first_name" placeholder="First Name">
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-account"></i>
                            <input type="text" class="form-control last_name" name="last_name" placeholder="Last Name">
                        </div>
                	</div>
                    <div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi zmdi-email"></i>
                            <input type="text" class="form-control email_id" name="email_id" placeholder="Email ID">
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-smartphone-android"></i>
                            <input type="number" class="form-control phone" name="phone" placeholder="Phone number">
                        </div>
                    </div>
                </section>

				<!-- SECTION 2 -->
                <h4></h4>
                <section>
                	<h3>Database Setup</h3>
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" class="form-control host" placeholder="Host">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" class="form-control db_name" placeholder="Database Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" class="form-control db_user" placeholder="Database User Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" class="form-control db_pass" placeholder="Password">
                        </div>
                    </div>
                    <input type="hidden" name="db_status" class="db_status"/>
                </section>

                <!-- SECTION 3 -->
                <h4></h4>
                <section>
                    <h3 style="margin-bottom: 16px;">My Cart</h3>
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" class="form-control code-etvo" placeholder="Enter Code">
                            <i class="validate" style="cursor: pointer; background:green; color:white; padding:8px; margin-right:-17px; margin-top:0px">Validate</i>
                        </div>
                    </div>
                </section>

                <!-- SECTION 4 -->
                <h4></h4>
                <section>
                    <h3>Cart Totals</h3>

                </section>
            </form>
		</div>

		<script src="{{ asset('install/js/jquery-3.3.1.min.js') }}"></script>

		<!-- JQUERY STEP -->
		<script src="{{ asset('install/js/jquery.steps.js') }}"></script>

		<script src="{{ asset('install/js/main.js') }}"></script>

        <script>
            $(document).ready(function(){
                $(".validate").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('install.validate') }}",
                        data: {code:$('.code-etvo').val(),_token: $(".token").val()},
                        success: function(data) {
                            if(data.error){
                                alert(data.description);
                            }else{
                                alert("success");
                            }
                        }
                    });
                });
                $("#wizard .actions ul li:nth-child(2) a").click(function(){
                    var first_name = $(".first_name").val();
                    var last_name = $(".last_name").val();
                    var email_id = $(".email_id").val();
                    var phone = $(".phone").val();
                    var host = $(".host").val();
                    var db_name = $(".db_name").val();
                    var db_user = $(".db_user").val();
                    var db_pass = $(".db_pass").val();


                    if(host!="" || db_name!="" || db_user!=""){
                        if( $(".db_status").val()!="connected"){
                            $(".loader").show();
                            $('.l-t').html("Checking database");
                            $.ajax({
                                type: "POST",
                                url: "{{ route('install.db.check') }}",
                                data: {code:$('.code-etvo').val(),_token: $(".token").val(),
                                first_name : $(".first_name").val(),
                                last_name : $(".last_name").val(),
                                email_id : $(".email_id").val(),
                                phone : $(".phone").val(),
                                host : $(".host").val(),
                                db_name : $(".db_name").val(),
                                db_user : $(".db_user").val(),
                                db_pass : $(".db_pass").val(),
                            },
                                success: function(data) {
                                    $('.l-t').html("Loading");
                                    $(".loader").hide();
                                    if(data.error){
                                        alert(data.message);
                                    }else{
                                        $(".db_status").val("connected");
                                        alert(data.message);
                                    }
                                }
                            });
                        }

                    }


                })
                function setup(){
                    var first_name = $(".first_name").val();
                    var last_name = $(".last_name").val();
                    var email_id = $(".email_id").val();
                    var phone = $(".phone").val();
                    var host = $(".host").val();
                    var db_name = $(".db_name").val();
                    var db_user = $(".db_user").val();
                    var db_pass = $(".db_pass").val();

                    if(first_name==""){
                        alert("all field compalsery");
                        return false;
                    }
                    if(last_name==""){
                        alert("all field compalsery");
                        return false;
                    }
                    if(email_id==""){
                        alert("all field compalsery");
                        return false;
                    }
                    if(phone==""){
                        alert("all field compalsery");
                        return false;
                    }
                    if(host==""){
                        alert("all field compalsery");
                        return false;
                    }
                    if(db_name==""){
                        alert("all field compalsery");
                        return false;
                    }
                    if(db_user==""){
                        alert("all field compalsery");
                        return false;
                    }
                    if($('.code-etvo').val()==""){
                        alert("all field compalsery");
                        return false;
                    }
                    let i=0;

                    if( $(".db_status").val()=="connected"){
                        $(".loader").show();
                        $('.l-t').html("Import databses "+i);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('install.start') }}",
                            data: {code:$('.code-etvo').val(),_token: $(".token").val(),
                            first_name : $(".first_name").val(),
                            last_name : $(".last_name").val(),
                            email_id : $(".email_id").val(),
                            phone : $(".phone").val(),
                            host : $(".host").val(),
                            db_name : $(".db_name").val(),
                            db_user : $(".db_user").val(),
                            db_pass : $(".db_pass").val(),
                        },
                            success: function(data) {
                                // $(".loader").show();
                                $('.l-t').html("Re Import databses");

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('install.start') }}",
                                    data: {code:$('.code-etvo').val(),_token: $(".token").val(),
                                    first_name : $(".first_name").val(),
                                    last_name : $(".last_name").val(),
                                    email_id : $(".email_id").val(),
                                    phone : $(".phone").val(),
                                    host : $(".host").val(),
                                    db_name : $(".db_name").val(),
                                    db_user : $(".db_user").val(),
                                    db_pass : $(".db_pass").val(),
                                },
                                    success: function(data) {
                                        // $(".loader").show();
                                        $('.l-t').html("Creating account");
                                        $(".loader").hide();
                                        // if(data.error=="0"){
                                        //     $(".loader").hide();
                                        //     alert(data.message);
                                        // }else if(data.error=="1"){
                                        //     $('.l-t').html(data.message);
                                        // }else if(data.error=="2"){
                                        //     $(".loader").hide();
                                        //     alert(data.message);
                                        // }
                                    }
                                });
                            },
                            error: function(data){
                                i++;
                                setup();
                            }
                        });
                    }else{
                        alert("Databases not connected");
                    }
                }
                $("#wizard .actions ul li:nth-child(3) a").click(function(){
                    setup();

                })
            });
        </script>

<!-- Template created and distributed by Colorlib -->
</body>
</html>
