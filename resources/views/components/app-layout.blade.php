<!-- resources/views/components/app-layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Default Title' }}</title>
    <!-- Add any other common head elements (CSS, JS, etc.) here -->
</head>
<body class="bg-gray-100">
    <!-- Optionally include a common navigation bar or sidebar -->
    @include('layouts.navigation') <!-- This is an example of including a navigation component -->

    <!-- Main content area -->
    <main>
        {{ $slot }}  <!-- This is where the page-specific content will be rendered -->
    </main>

    <!-- Optionally include a footer -->
    @include('layouts.footer')
</body>
</html>
