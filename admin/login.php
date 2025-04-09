<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'Mutaali2') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">PPDB 2025</h2>
        <p class="text-center text-gray-500 mb-4">Login to administrator account</p>
        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-center"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" class="space-y-4">
            <div>
                <label class="block font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter your username" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Login</button>
        </form>
        <p class="text-center text-gray-500 mt-6 text-sm">© 2025 PPDB Admin. All rights reserved.</p>
    </div>
</body>
</html>