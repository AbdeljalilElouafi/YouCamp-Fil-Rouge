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