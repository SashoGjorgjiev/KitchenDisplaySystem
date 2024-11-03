<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchen Display System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .button-animate {
            background-color: #16a34a;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .button-animateReg {
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .button-animate:hover {
            background-color: #14b400;
            transform: scale(1.10);
            transition: transform 0.4s ease;
        }

        .button-animateReg:hover {
            background-color: #16a34a;
            transform: scale(1.10);
            transition: transform 0.4s ease;



        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="max-w-lg w-full px-6 py-8 bg-white shadow-lg rounded-lg text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Your Custom Kitchen Display System</h1>
        <p class="text-gray-600 mb-8">Your one-stop solution for amazing features. Join us to get started!</p>

        @auth
        <p class="text-gray-700 mb-4">Welcome back, {{ Auth::user()->name }}!</p>
        <a href="{{ url('/dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Go to Dashboard</a>
        @else
        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold button-animate py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</a>
            <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white button-animateReg font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</a>
        </div>
        @endauth
    </div>

</body>

</html>