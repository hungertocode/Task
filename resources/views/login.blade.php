<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/login.css">

</head>

<body>
    <div id="box">
        <div class="card">
            <div class="card__face card__face--front">
              <h2>Admin Login</h2>
              @if(session('error'))
              <div class="error-alert">{{session('error')}}</div>
              @endif
               <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="input-container">
                    <div class="icon-wrapper"><i class="fa fa-user"></i></div>
                    <input name="email" required="required" placeholder="Username" maxlength="255" type="text" id="UserUsername">
                </div>
                <div class="input-container">
                    <div class="icon-wrapper"><i class="fa fa-lock"></i></div>
                    <input name="password" required="required" placeholder="Password" type="password" id="UserPassword">
                </div>
                <div class="input-container">
                    <input type="checkbox" id="checkbox" name="remember" value="Remember Me?">
                    <label for="checkbox">Remember Me?</label>
                </div>
                <div class="input-container">
                    <input class="b-sign" type="submit" value="Sign in">
                </div>
            </form>
            </div>
            <!-- <div class="card__face card__face--back">
                <div class="i-more">
                    <i class="fa fa-ellipsis-h"></i>
                </div>
                <div>Need help?</div>
                <button onclick="" type="" class='b-support' title='Forgot Password?'> Forgot Password?</button>
                <button onclick="" type="submit" class='b-support' title='Contact Support'> Contact Support</button>
                <a onclick="" class='b-cta' title='Sign up now!'> CREATE ACCOUNT</a>
            </div> -->
        </div>
    </div>



</body>

</html>