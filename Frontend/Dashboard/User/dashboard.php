<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-900 text-white p-5 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-bold mb-6">User Dashboard</h2>
                <ul>
                    <li class="mb-4"><a href="#" class="hover:text-gray-300">🏠 Home</a></li>
                    <li class="mb-4"><a href="#" class="hover:text-gray-300">📊 Analytics</a></li>
                    <li class="mb-4"><a href="#" class="hover:text-gray-300">⚙️ Settings</a></li>
                </ul>
            </div>
            <button onclick="logout()" class="bg-red-500 px-4 py-2 rounded-md">🚪 Logout</button>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Welcome, User</h1>
                <button onclick="toggleDarkMode()" class="bg-gray-800 text-white px-3 py-1 rounded-md">🌙 Dark Mode</button>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-3 gap-6 mt-6">
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h2 class="text-xl font-bold">📁 120 Files</h2>
                </div>
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h2 class="text-xl font-bold">✅ 45 Tasks Completed</h2>
                </div>
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h2 class="text-xl font-bold">🔔 3 New Notifications</h2>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mt-8 bg-white p-6 shadow-md rounded-lg">
                <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
                <ul>
                    <li class="mb-2">✅ Task "Update Profile" Completed</li>
                    <li class="mb-2">📥 New Message Received</li>
                    <li class="mb-2">🔄 System Update Applied</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
function toggleDarkMode() {
document.body.classList.toggle('bg-gray-900');
document.body.classList.toggle('text-white');
}
    </script>
</body>
</html>
