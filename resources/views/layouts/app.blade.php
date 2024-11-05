<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minh Shop</title>
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome để sử dụng các biểu tượng -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <!-- Nội dung header -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="http://localhost:8000/admin/dashboard">Minh Shop</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <!-- Kiểm tra xem người dùng đã đăng nhập chưa -->
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard"></a>
                        </li>
                        <li class="nav-item">
                            <!-- Form đăng xuất -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Đăng Xuất
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng Nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng Ký</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
    <footer>
        <!-- Nội dung footer -->
    </footer>

    <!-- Add your JavaScript files here -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jQuery, Popper.js, và Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
