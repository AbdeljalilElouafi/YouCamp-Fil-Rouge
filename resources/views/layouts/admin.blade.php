<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouCamp Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a2a3a 0%, #0f172a 100%);
            background-image: url('/api/placeholder/1920/1080') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
        }
        .logo-font {
            font-family: 'Cabin Sketch', cursive;
        }
        .sidebar {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        .sidebar:hover {
            transform: translateX(5px);
        }
        .nav-item {
            position: relative;
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 5px 0;
            overflow: hidden;
        }
        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: all 0.5s ease;
        }
        .nav-item:hover::before {
            left: 100%;
        }
        .nav-item:hover {
            background: rgba(255, 103, 0, 0.8);
            box-shadow: 0 4px 20px rgba(255, 103, 0, 0.4);
            transform: translateY(-2px);
        }
        .nav-item.active {
            background: rgba(255, 103, 0, 0.8);
            box-shadow: 0 4px 20px rgba(255, 103, 0, 0.4);
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .card-gradient-1 {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.4) 0%, rgba(45, 212, 191, 0.4) 100%);
        }
        .card-gradient-2 {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.4) 0%, rgba(234, 179, 8, 0.4) 100%);
        }
        .card-gradient-3 {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.4) 0%, rgba(217, 70, 239, 0.4) 100%);
        }
        .card-gradient-4 {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.4) 0%, rgba(6, 182, 212, 0.4) 100%);
        }
        .header {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .main-content {
            background: transparent;
        }
        .number-counter {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(to right, #ff6700, #ffa500);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 103, 0, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 103, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 103, 0, 0);
            }
        }
        .fire-icon {
            position: relative;
            display: inline-block;
        }
        .fire-icon::after {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: radial-gradient(circle, rgba(255, 103, 0, 0.6) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            animation: flicker 3s infinite alternate;
        }
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .chart-container {
            position: relative;
            margin: auto;
            width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>
    <!-- Admin Dashboard Layout -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-72 space-y-6 py-7 px-4 overflow-y-auto">
            <div class="logo-font text-3xl font-bold text-center mb-8 text-white flex items-center justify-center">
                <span class="fire-icon mr-2"><i class="fas fa-campground text-orange-500"></i></span>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-yellow-300">YouCamp</span>
            </div>
            <nav>
                <ul class="space-y-3">
                    <li class="nav-item active">
                        <a href="#" class="flex items-center px-4 py-3 text-white">
                            <i class="fas fa-tachometer-alt mr-3 text-xl"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="flex items-center px-4 py-3 text-white">
                            <i class="fas fa-users mr-3 text-xl"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="flex items-center px-4 py-3 text-white">
                            <i class="fas fa-user-tie mr-3 text-xl"></i>
                            <span>Gérants</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="flex items-center px-4 py-3 text-white">
                            <i class="fas fa-folder-open mr-3 text-xl"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="flex items-center px-4 py-3 text-white">
                            <i class="fas fa-tags mr-3 text-xl"></i>
                            <span>Tags</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="flex items-center px-4 py-3 text-white">
                            <i class="fas fa-newspaper mr-3 text-xl"></i>
                            <span>Posts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="flex items-center px-4 py-3 text-white">
                            <i class="fas fa-chart-line mr-3 text-xl"></i>
                            <span>Statistics</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="mt-auto pt-10">
                <div class="card p-4 text-white text-center">
                    <div class="text-sm font-medium opacity-70">Current Season</div>
                    <div class="text-xl font-bold mt-1">Summer 2025</div>
                    <div class="mt-2 text-xs opacity-70">Peak camping season!</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="header shadow-lg z-10">
                <div class="flex items-center justify-between py-4 px-6">
                    <div class="flex items-center">
                        <h1 class="text-3xl font-bold text-white logo-font">
                            Adventure Dashboard
                        </h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="bg-gray-800 text-white border-0 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                        </div>
                        <div class="relative pulse">
                            <i class="fas fa-bell text-white text-xl cursor-pointer"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 rounded-full w-4 h-4 flex items-center justify-center text-xs text-white">3</span>
                        </div>
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" alt="Admin" class="w-10 h-10 rounded-full border-2 border-orange-500">
                            <span class="ml-2 text-white">Admin User</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="main-content flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="container mx-auto">
                    <!-- Dashboard Overview -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="card card-gradient-1 p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium text-white opacity-90">Total Campsites</h3>
                                    <p class="number-counter">347</p>
                                </div>
                                <div class="bg-indigo-600 rounded-lg p-3 text-white">
                                    <i class="fas fa-campground text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-white text-sm">
                                <span class="text-green-400"><i class="fas fa-arrow-up mr-1"></i>12%</span> from last month
                            </div>
                        </div>
                        
                        <div class="card card-gradient-2 p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium text-white opacity-90">Active Users</h3>
                                    <p class="number-counter">8,942</p>
                                </div>
                                <div class="bg-orange-600 rounded-lg p-3 text-white">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-white text-sm">
                                <span class="text-green-400"><i class="fas fa-arrow-up mr-1"></i>18%</span> from last month
                            </div>
                        </div>
                        
                        <div class="card card-gradient-3 p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium text-white opacity-90">Reservations</h3>
                                    <p class="number-counter">1,259</p>
                                </div>
                                <div class="bg-purple-600 rounded-lg p-3 text-white">
                                    <i class="fas fa-calendar-check text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-white text-sm">
                                <span class="text-green-400"><i class="fas fa-arrow-up mr-1"></i>24%</span> from last month
                            </div>
                        </div>
                        
                        <div class="card card-gradient-4 p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium text-white opacity-90">Revenue</h3>
                                    <p class="number-counter">$86.5K</p>
                                </div>
                                <div class="bg-blue-600 rounded-lg p-3 text-white">
                                    <i class="fas fa-dollar-sign text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-white text-sm">
                                <span class="text-green-400"><i class="fas fa-arrow-up mr-1"></i>32%</span> from last month
                            </div>
                        </div>
                    </div>
                    
                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div class="card p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Reservation Trends</h3>
                            <div class="chart-container">
                                <canvas id="reservationChart"></canvas>
                            </div>
                        </div>
                        
                        <div class="card p-6">
                            <h3 class="text-xl font-bold text-white mb-4">User Demographics</h3>
                            <div class="chart-container">
                                <canvas id="demographicsChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="card p-6 lg:col-span-2">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-bold text-white">Recent Bookings</h3>
                                <a href="#" class="text-orange-400 hover:text-orange-300">View All</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-left text-white text-opacity-70 pb-3">User</th>
                                            <th class="text-left text-white text-opacity-70 pb-3">Campsite</th>
                                            <th class="text-left text-white text-opacity-70 pb-3">Date</th>
                                            <th class="text-left text-white text-opacity-70 pb-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-700">
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <img src="/api/placeholder/30/30" alt="User" class="w-8 h-8 rounded-full mr-3">
                                                    <span class="text-white">Emma Watson</span>
                                                </div>
                                            </td>
                                            <td class="py-3 text-white">Lakeside Paradise</td>
                                            <td class="py-3 text-white">Feb 25, 2025</td>
                                            <td class="py-3">
                                                <span class="px-2 py-1 rounded-full text-xs bg-green-500 text-white">Confirmed</span>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-700">
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <img src="/api/placeholder/30/30" alt="User" class="w-8 h-8 rounded-full mr-3">
                                                    <span class="text-white">John Smith</span>
                                                </div>
                                            </td>
                                            <td class="py-3 text-white">Mountain View</td>
                                            <td class="py-3 text-white">Feb 24, 2025</td>
                                            <td class="py-3">
                                                <span class="px-2 py-1 rounded-full text-xs bg-yellow-500 text-white">Pending</span>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-700">
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <img src="/api/placeholder/30/30" alt="User" class="w-8 h-8 rounded-full mr-3">
                                                    <span class="text-white">Sarah Johnson</span>
                                                </div>
                                            </td>
                                            <td class="py-3 text-white">Forest Retreat</td>
                                            <td class="py-3 text-white">Feb 23, 2025</td>
                                            <td class="py-3">
                                                <span class="px-2 py-1 rounded-full text-xs bg-green-500 text-white">Confirmed</span>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-700">
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <img src="/api/placeholder/30/30" alt="User" class="w-8 h-8 rounded-full mr-3">
                                                    <span class="text-white">Michael Brown</span>
                                                </div>
                                            </td>
                                            <td class="py-3 text-white">Riverside Camp</td>
                                            <td class="py-3 text-white">Feb 22, 2025</td>
                                            <td class="py-3">
                                                <span class="px-2 py-1 rounded-full text-xs bg-red-500 text-white">Cancelled</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-bold text-white">Top Campsites</h3>
                                <a href="#" class="text-orange-400 hover:text-orange-300">View All</a>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/60/40" alt="Campsite" class="w-16 h-12 rounded-lg object-cover mr-3">
                                    <div>
                                        <h4 class="text-white font-medium">Lakeside Paradise</h4>
                                        <div class="flex items-center text-yellow-400 text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span class="ml-1 text-white text-opacity-70">(4.8)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <img src="/api/placeholder/60/40" alt="Campsite" class="w-16 h-12 rounded-lg object-cover mr-3">
                                    <div>
                                        <h4 class="text-white font-medium">Mountain View</h4>
                                        <div class="flex items-center text-yellow-400 text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-white text-opacity-70">(4.9)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <img src="/api/placeholder/60/40" alt="Campsite" class="w-16 h-12 rounded-lg object-cover mr-3">
                                    <div>
                                        <h4 class="text-white font-medium">Forest Retreat</h4>
                                        <div class="flex items-center text-yellow-400 text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span class="ml-1 text-white text-opacity-70">(4.1)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <img src="/api/placeholder/60/40" alt="Campsite" class="w-16 h-12 rounded-lg object-cover mr-3">
                                    <div>
                                        <h4 class="text-white font-medium">Riverside Camp</h4>
                                        <div class="flex items-center text-yellow-400 text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span class="ml-1 text-white text-opacity-70">(4.0)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Reservation Chart
            const resCtx = document.getElementById('reservationChart').getContext('2d');
            const reservationChart = new Chart(resCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Reservations',
                        data: [456, 479, 324, 569, 702, 836, 983],
                        backgroundColor: 'rgba(255, 103, 0, 0.2)',
                        borderColor: 'rgba(255, 103, 0, 1)',
                        borderWidth: 3,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(255, 103, 0, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(255, 103, 0, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    }
                }
            });
            
            // Demographics Chart
            const demoCtx = document.getElementById('demographicsChart').getContext('2d');
            const demographicsChart = new Chart(demoCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Families', 'Couples', 'Solo Campers', 'Groups'],
                    datasets: [{
                        data: [45, 25, 15, 15],
                        backgroundColor: [
                            'rgba(255, 103, 0, 0.8)',
                            'rgba(79, 70, 229, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 103, 0, 1)',
                            'rgba(79, 70, 229, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(245, 158, 11, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: 'rgba(255, 255, 255, 0.7)',
                                padding: 20,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });
            
            // Animate number counters
            const counters = document.querySelectorAll('.number-counter');
            counters.forEach(counter => {
                const target = parseFloat(counter.innerText.replace(/,|\$|K/g, ''));
                const suffix = counter.innerText.includes('$') ? '$' : '';
                const kSuffix = counter.innerText.includes('K') ? 'K' : '';
                const comma = counter.innerText.includes(',') ? true : false;
                
                let count = 0;
                const updateCounter = () => {
                    const increment = target / 100;
                    if (count < target) {
                        count += increment;
                        if (count > target) count = target;
                        
                        let displayValue = count;
                        if (comma) displayValue = displayValue.toLocaleString();
                        counter.innerText = suffix + displayValue + kSuffix;
                        setTimeout(updateCounter, 10);
                    }
                };
                
                updateCounter();
            });
            
            // Add some animation effects to nav items
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, 100 * index);
            });
            
            // Add hover effects to cards
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>