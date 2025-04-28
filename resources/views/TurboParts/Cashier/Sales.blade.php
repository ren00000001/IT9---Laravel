<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier-Sales</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>

        .container{
            display: flex;
            min-height: 100vh;
        }

        .main-content{
            flex: 1;
            padding: 20px;
        }

        .header{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
            gap: 25px;
        }

        .user-area{
            display: flex;
            align-items: center;
        }

        .user-profile{
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-avatar{
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--normalnavlink);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

    </style>
</head>

<body>

    <header>
        <nav>
            <input type="checkbox" id="sidebar-active">
                <label for="sidebar-active" class="open-sidebar-button">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#000000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
                </label>

            <label for="sidebar-active" id="overlay"></label>
            <div class="links-container">
                <label for="sidebar-active" class="close-sidebar-button">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </label>

                <div class="nav-logo">
                    <img src="{{ asset('images/TurboParts3.png') }}" alt="">
                </div>
                
                <a class="home-link" href="{{ route('cashier.pos') }}">Point of Sale</a>
                <a href="{{ route('cashier.sales') }}">Sales</a>
                <a href="{{ route('admin.inventory') }}">Inventory</a>
                <a class="logout-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <h1>TurboParts</h1>
        </nav>
    </header>  

    <main>

        <div class="container">
            <div class="main-content">

                <div class="header">
                
                    <!--POPUP INFO------------------------------------------------>
                        <div class="popup-trigger" id="popup_svgtrigger">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                <path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                            </svg>
                        </div>

                            <div class="popup-overlay" id="popup">
                                <div class="popup-content">
                                    <button class="close-btn" aria-label="Close">&times;</button>
                                    <h2>Important Information</h2>
                                    <p>This is your pop-up content. You can put any HTML here including:</p>
                                    <ul>
                                        <li>Text paragraphs</li>
                                        <li>Images</li>
                                        <li>Forms</li>
                                        <li>Videos</li>
                                    </ul>
                                    <p>The modal will close when you click outside, press Escape, or click the close button.</p>
                                    <div style="margin-top: 20px; padding: 10px; background: #f5f5f5; border-radius: 5px;">
                                        <small>You can customize this content as needed.</small>
                                    </div>
                                </div>
                            </div>
                    <!--POPUP INFO------------------------------------------------>

                    <div id="real-time-display"></div>
                    <span>Cashier:</span>
                    <div class="user-area">
                        <div class="user-profile">
                            <div class="user-avatar">RI</div>
                            <span>Ren Indino</span>
                        </div>
                    </div>

                </div>

                <div class="page-header">
                    <div class="page-title">Sales</div>
                </div>

            </div>
        </div>
    
    </main>

    <script src="{{ asset('js/scriptForTime.js') }}" ></script>
    <script src="{{ asset('js/Popup.js') }}"></script>
    
</body>
</html>