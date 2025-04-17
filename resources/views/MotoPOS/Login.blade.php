<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            background-color: #f0f0f0;
            background: linear-gradient(to right, #e0e0e0, #d0d0d0);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container{
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px; 
        }

        .container p{
            font-size: 16px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .toggle-panel p + p{
            font-size: 12px;
            margin: 45px 0px 5px;
            color: whitesmoke;
        }

        .toggle-panel h1 + p{
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .container span{
            font-size: 12px;
            color: #555;
            margin-top: -5px;
            margin-bottom: 15px;
        }

        .container a{
            color: #444;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px; 
            transition: color 0.3s ease;
        }

        .container a:hover {
            color: #222;
        }

        .container button{
            background-color: #333;
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .container button:hover {
            background-color: #222;
        }

        .container button.hidden{
            background-color: transparent;
            border-color: #fff;
        }

        .container button.hidden:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .container form{
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%; 
        }

        .container h1 {
            color: #333;
            margin-bottom: 15px;
            margin-top: 10px;
        }

        .container input{
            background-color: #f5f5f5;
            border: 1px solid #e0e0e0;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .container input:focus {
            border-color: #999;
        }
        
        .form-container{
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;   
        }

        .sign-in{
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in{
            transform: translateX(100%);
        }        

        .sign-up{
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up{
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s; 
        }

        @keyframes move{
            0%, 49.99%{
                opacity: 0;
                z-index: 1;
            }

            50%, 100%{
                opacity: 1;
                z-index: 5;
            }
        }

        .social-icons{
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .social-icons a{         
            border-radius: 20%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 35px;
            height: 35px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background-color: #f5f5f5;
        }

        .toggle-container{
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 150px 0 0 100px;
            z-index: 1000; 
        }

        .container.active .toggle-container{
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        .toggle{
            background-color: #333;
            height: 100%;
            background: linear-gradient(135deg, #444, #222);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle{
            transform: translateX(50%);
        }        

        .toggle-panel{
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left{
            transform: translateX(-200%);
        }

        .container.active .toggle-left{
            transform: translateX(0);
        }

        .toggle-right{
            right: 0;
            transform: translateX(0)
        }

        .container.active .toggle-right{
            transform: translateX(200%);
        }

        .toggle-container h1{
            color: white;
        }

        .signbtn{
            color: white;
        }

        .logo{
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
            background-color: #eae7e7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo img{
            width: 100px;
            height: 100px;
        }

        .company-name {
            color: white;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <div class="container" id="container">

        <div class="form-container sign-up">
            <form>
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icons">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                            <path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                            </svg>
                    </a>
                    <a href="#" class="icons">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                            <path fill="#3F51B5" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"></path><path fill="#FFF" d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z"></path>
                            </svg>
                    </a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="Name">
                <input type="tel" placeholder="Phone Number">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <button>Sign Up</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form method="POST" action="/login">
            @csrf
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icons">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                            <path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                            </svg>
                    </a>
                    <a href="#" class="icons">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                            <path fill="#3F51B5" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"></path><path fill="#FFF" d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z"></path>
                            </svg>
                    </a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                <input type="password" name="password"  placeholder="Password">
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                <a href="#"><u>Forgot Your Password</u></a>
                <button>Sign In</button>
                <button type="button" class="signbtn" onclick="location.href='/dashboard'">Admin</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">

                <div class="toggle-panel toggle-left">

                    <div class="logo">
                        <img src="{{ asset('images/Logo2.png') }}" alt="Logo Picture">
                    </div>
                    <div class="company-name">MotoPOS</div>

                    <h1>Hello There.</h1>
                    <p>Register your account details to have access in the site.</p>
                    <p>Just sign in your registered account if you already have one.</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>

                <div class="toggle-panel toggle-right">

                    <div class="logo">
                        <img src="{{ asset('images/Logo2.png') }}" alt="Logo Picture">
                    </div>
                    <div class="company-name">MotoPOS</div>

                    <h1>Welcome Back!</h1>
                    <p>Enter your registered account to have access in the site.</p>
                    <p>If you do not have an account please sign up for one.</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>

            </div>
        </div>

    </div>

    <script>
        const container = document.getElementById('container');
        const registerButton = document.getElementById('register');
        const loginButton = document.getElementById('login');

        registerButton.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginButton.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
    
</body>
</html>