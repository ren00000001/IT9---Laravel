<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .background-container{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .background-image{
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
        }

        .error-message{
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ff4444;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            display: flex;
            align-items: center;
            animation: fadeIn 0.3s, fadeOut 0.3s 4.7s forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; top: 0; }
            to { opacity: 1; top: 20px; }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; top: 20px; }
            to { opacity: 0; top: 0; }
        }
        
        .error-message i {
            margin-right: 10px;
        }
        
        .role-error {
            color: #ff4444;
            font-size: 12px;
            margin-top: 10px;
            display: none;
        }

        #role-error{
            margin-top: 5px;
        }
        
        .invalid-select {
            border-color: #ff4444 !important;
        }

        .container{
            background-color: rgba(255, 255, 255, 0.9);
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
            background-color: var(--normalnavlink);
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
            background-color: #5A96C7;
            color: #222;
        }

        .container button.hidden{
            background-color: transparent;
            border-color: #fff;
        }

        .container button.hidden:hover {
            background-color: #5A96C7;
            color: #222;
        }

        .container form{
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%; 
            width: 100%;
            box-sizing: border-box;
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
            background: linear-gradient(90deg, var(--headertble) 0%,rgb(34, 40, 44) 100%);
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

        .role-container{
            width: 100%;
            margin: 5px 0 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .role-label{
            font-size: 12px;
            font-weight: bold;
            color: #555;
            display: block;
            text-align: center;
        }

        .user-role{
            background-color: #f5f5f5;
            border: 1px solid #e0e0e0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
            transition: border-color 0.3s ease;
            color: #333;
        }

        .user-role:focus{
            border-color: #999;
        }

        .container .password-container{
            width: 100%;
            display: flex;
            align-items: center;
        }

        .container .password-container input{
            width: 100%;
            color: #555;
        }

        .container .password-container img{
            width: 20px;
            cursor: pointer;
        }
        
        
    </style>
</head>
<body>

    <div class="background-container">
        <img alt="background" class="background-image" src="{{ asset('images/Background.png') }}">
    </div>

    <div id="errorToast" class="error-message" style="display: none;">
        <i>⚠️</i>
        <span id="errorText"></span>
    </div>

    <div class="container" id="container">

        <div class="form-container sign-up">
            <form>
                <h1><u>About Us</u></h1>
                <div class="company-description">
                    TurboPOS is a leading provider of innovative point-of-sale systems designed specifically for the automotive parts industry. 
                    Our cutting-edge software streamlines inventory management, sales processing, and customer relationship management, 
                    helping businesses of all sizes operate more efficiently. With real-time analytics, seamless integration capabilities, 
                    and user-friendly interfaces, TurboPOS empowers retailers to focus on what matters most - growing their business. 
                    Trusted by over 1,200 shops nationwide, our solutions are built to handle the unique challenges of parts distribution.
            </div>      
            </form>
        </div>

        <div class="form-container sign-in">
            <form method="POST" action="/login" id="loginForm">
            @csrf
                <h1>Sign In</h1>
                
                <input type="email" name="email" placeholder="Email">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
      
                  <div class="password-container">
                        <input type="password" name="password" id="password" placeholder="Password">
                        <img id="show_and_hide" src="{{ asset('images/eye-close.png') }}" alt="Hide Password">
                  </div>                       

                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror

                    <div class="role-container">
                        <span class="role-label">As:</span>
                        <select class="user-role" name="user_role" id="user-role">
                            <option value="" disabled selected hidden>Select Role</option>
                            <option value="cashier">Cashier</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                        <span class="role-error" id="role-error">Please select your company role</span>
                    </div>

                <button type="submit" class="signbtn" >Sign In</button>

            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">

                <div class="toggle-panel toggle-left">

                    <div class="logo">
                        <img src="{{ asset('images/Logo2.png') }}" alt="Logo Picture">
                    </div>
                    <div class="company-name">TurboParts</div>

                    <h1>Hello there and welcome.</h1>
                    <p>It is a pleasure to have your assistance.</p>
                    <p>Keep up the good work :>.</p>
                    <button class="hidden" id="login">Go Back</button>
                </div>

                <div class="toggle-panel toggle-right">

                    <div class="logo">
                        <img src="{{ asset('images/Logo2.png') }}" alt="Logo Picture">
                    </div>
                    <div class="company-name">TurboParts</div>

                    <h1>Welcome Back!</h1>
                    <p>Enter your registered company account to access.</p>
                    <p>Click the button to know more</p>
                    <button class="hidden" id="register">About Us</button>
                </div>

            </div>
        </div>

    </div>

    <script>
        /*pag switch ug form sa login*/
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

    <script>
        /*exception handler if mag try ug login na walay ge pili na role drop down---*/
        document.getElementById('loginForm').addEventListener('submit', function(e){
            const roleSelect = document.getElementById('user-role');
            const roleError = document.getElementById('role-error');

            if(!roleSelect.value){
                e.preventDefault();
                roleSelect.classList.add('invalid-select');
                roleError.style.display = 'block';
                showError('Please select a role before signing in');
            }
        });

        function showError(message){
            const errorToast = document.getElementById('errorToast');
            const errorText = document.getElementById('errorText');

            errorText.textContent = message;
            errorToast.style.display = 'flex';

            setTimeout(() => {
                errorToast.style.display = 'none';
            }, 5000);
        }

        document.addEventListener('DOMContentLoaded', function(){
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');

            if(error){
                showError('Please use the login properly');
            }

            document.getElementById('user-role').addEventListener('change', function(){
                if(this.value){
                    this.classList.remove('invalid-select');
                    document.getElementById('role-error').style.display = 'none';
                }
            });
        });
    </script>

    <script>

        /*show and hide password*/
        let show_and_hide = document.getElementById('show_and_hide');
        let password = document.getElementById('password');
    
        show_and_hide.onclick = function(){
            if(password.type == "password"){
                password.type = "text";
                show_and_hide.src = "{{ asset('images/eye-open.png') }}";
            }
            else{
                password.type = "password";
                show_and_hide.src = "{{ asset('images/eye-close.png') }}";
            }
        }
    </script>

</body>
</html>