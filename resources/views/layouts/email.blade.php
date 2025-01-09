<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Email Notification' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white border border-gray-200 shadow-md rounded-lg p-6">
        <header class="mb-6 text-center">
            <img src="/images/logo-jinggo-h.png" alt="Jinggo Hotel Logo" class="mx-auto mb-4 w-20 h-20 object-contain">
            <h1 class="text-2xl font-bold text-amber-600">Hotel Poliwangi Jinggo</h1>
        </header>
        
        @yield('content')
        
        <footer class="mt-6 border-t pt-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Hotel Poliwangi Jinggo. All rights reserved.
        </footer>
    </div>
</body>
</html>
