<!DOCTYPE html>
<html>
<head>
    <title>Image Upload with Vue + Laravel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="max-w-lg mx-auto mt-24">
        <h1 class="text-center text-4xl font-bold">Image Uploader</h1>
        <div id="app"></div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
