<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title> 
    <link href="Admin/ui/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="Admin/ui/css/animate.css" rel="stylesheet">
    <link href="Admin/ui/css/style.css" rel="stylesheet">
    <link href="Admin/ui/css/bootstrapValidator.css" rel="stylesheet">
    <link href="Admin/ui/css/bootstrap.min.css" rel="stylesheet">
    <link href="Admin/ui/font-awesome/css/font-awesome.css" rel="stylesheet">
    <script src="Admin/ui/js/jquery-2.1.1.js"></script>
    <script src="Admin/ui/js/BootstrapValidator.js"></script>
    <script src="Admin/ui/js/plugins/sweetalert/sweetalert.min.js"></script>
</head>

<body background="Admin/ui/img/background.jpg" style="background-repeat: no-repeat; background-attachment: fixed;background-size: cover;" class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name"><img src="Admin/ui/img/logo.png" style="max-height:200px; max-width:200px;"></h1>
            </div>
            <form method="POST" id="f1" Action="#">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username"name="email" type="email" required/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password"  required/>
                </div>
                <input type="button" id="btn_lgn" value="Login" class="btn btn-primary block full-width m-b">
            </form>
        </div>
    </div>
    </body>
    </html>
    <script>
        $("document").ready(function(){
            $("#btn_lgn").click(function(){
                x= $("#f1").serialize();
            var url = "Admin/handeler/login_hndl.php?type=user_login"; //url for ajax request

                $.post(url,x,function(data,status){
                    if(data=="empty"){
                        swal(
                            'invalid',
                            'Please add The correct details'
                            )
                    }
                    else if(data=="incorrect"){
                        swal(
                            'incorrect user name or password',
                            'Please add The correct details'
                            )
                    }
                    else{
                        var url="Admin/handeler/route.php";
                        $(location).attr("href",url);
                    }
                });
            });   
        });
    </script>
