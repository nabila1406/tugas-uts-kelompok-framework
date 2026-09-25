<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cafe.kita - BREAD System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f1ddcb] font-sans text-[#274e3a]">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-[#45805B] text-[#FAFFC7]  flex flex-col rounded-l-none rounded-r-2xl p-5">
            <div class="mb-4 -mt-2 px-2">
                <img src="{{ asset('images/logo.jpg') }}" alt="" class="w-36 h-auto object-contain">
            </div>
            <nav class="space-y-2 flex-1">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-lg hover:bg-[#97b9d4] hover:text-[#45805B] transition">Dashboard</a>
                <a href="{{ route('categories.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-[#97b9d4] hover:text-[#45805B] transition">Categories</a>
                <a href="{{ route('menus.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-[#97b9d4] hover:text-[#45805B] transition">Menus</a>
                <a href="{{ route('customers.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-[#97b9d4] hover:text-[#45805B] transition">Customers</a>
                <a href="{{ route('orders.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-[#97b9d4] hover:text-[#45805B] transition">Orders</a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            @if (session('success'))
            <div id="success-alert" class="mb-4 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) {
                setTimeout(function() {
                    alertBox.style.transition = "opacity 0.5s ease";
                    alertBox.style.opacity = "0";
                    setTimeout(function() {
                        alertBox.remove();
                    }, 500);
                }, 3000); // Hilang setelah 3 detik
            }
        });
    </script>
</body>
</html>