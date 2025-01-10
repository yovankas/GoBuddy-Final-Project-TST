<?= $this->extend('plans/layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-container">
    <section class="hero-section">
        <h1 class="page-title">Plan new trip</h1>
        
        <div class="form-container">
            <form id="planForm" class="trip-form">
                <div class="form-group">
                    <label for="title">Trip Title</label>
                    <input type="text" id="title" name="title" required placeholder="Enter trip title">
                </div>
                
                <div class="date-group">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" id="destination" name="destination" required placeholder="Enter destination">
                </div>

                <div class="form-group">
                    <label for="activities">Activities</label>
                    <textarea id="activities" name="activities" required placeholder="Enter activities"></textarea>
                </div>

                <button type="submit" class="create-btn">Create trip</button>
            </form>
        </div>
    </section>

    <section class="trips-section">
        <h2 class="section-title">My trips</h2>
        <div id="plansList" class="trips-list">
            <!-- Plans will be loaded here -->
        </div>
    </section>

    <section class="trips-section">
        <h2 class="section-title">Shared trips with me</h2>
        <div id="sharedPlansList" class="trips-list">
            <!-- Shared plans will be loaded here -->
        </div>
    </section>

    <div class="covid-notice">
        <span class="warning-icon">⚠️</span>
        <p>Check the latest COVID-19 restrictions before you travel. <a href="/learn-more">Learn more</a></p>
    </div>
</div>

<style>
.page-container {
    width: 100%;
    min-height: 100vh;
    background: #F4F4F4;
    padding-bottom: 32px;
}

.hero-section {
    width: 100%;
    min-height: 442px;
    background: url('https://images8.alphacoders.com/719/719571.jpg') center/cover;
    padding-top: 25px;
    padding-bottom: 40px;
    position: relative;
}

.page-title {
    font-weight: 600;
    font-size: 32px;
    color: #FFFFFF;
    margin: 0 auto;
    max-width: 1200px;
    padding: 0 24px;
}

.form-container {
    max-width: 1200px;
    margin: 26px auto 0;
    padding: 0 24px;
    position: relative;
    z-index: 1;
}

.trip-form {
    background: #FFFFFF;
    border: 1px solid #E0E0E0;
    border-radius: 5px;
    padding: 24px;
}

.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    font-weight: 500;
    font-size: 14px;
    color: #181818;
    margin-bottom: 8px;
}

.form-group input, .form-group textarea {
    width: 100%;
    height: 44px;
    background: #F2F2F2;
    border: none;
    border-radius: 4px;
    padding: 11px 12px;
    font-size: 15px;
    color: #333333;
}

.form-group textarea {
    height: 100px;
    resize: vertical;
}

.date-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}

.create-btn {
    display: block;
    width: 116px;
    height: 40px;
    margin: 0 auto;
    background: #2F80ED;
    border: none;
    border-radius: 6px;
    color: #FFFFFF;
    font-weight: 500;
    font-size: 15px;
    cursor: pointer;
}

.trips-section {
    max-width: 1200px;
    margin: 37px auto 0;
    padding: 0 24px;
}

.section-title {
    font-weight: 600;
    font-size: 32px;
    color: #1A1A1A;
    margin-bottom: 24px;
}

.trips-list {
    background: #FFFFFF;
    border: 1px solid #E0E0E0;
    border-radius: 5px;
    padding: 20px;
}

.trip-card {
    display: grid;
    grid-template-columns: 285px 1fr;
    gap: 24px;
    padding: 20px;
    border-bottom: 1px solid #E0E0E0;
}

.trip-card:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.trip-image {
    width: 285px;
    height: 200px;
    border-radius: 5px;
    object-fit: cover;
}

.trip-details {
    display: flex;
    flex-direction: column;
}

.trip-title {
    font-weight: 500;
    font-size: 20px;
    color: #1A1A1A;
    margin-bottom: 8px;
}

.trip-date {
    font-size: 14px;
    color: #4F4F4F;
    margin-bottom: 4px;
}

.view-trip-btn {
    width: 157px;
    height: 40px;
    background: #2F80ED;
    border-radius: 6px;
    color: #FFFFFF;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: auto;
    margin-left: auto;
    font-weight: 500;
    font-size: 15px;
}

.covid-notice {
    max-width: 1200px;
    margin: 32px auto;
    padding: 16px 24px;
    background: #FCEFCA;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.covid-notice p {
    font-size: 16px;
    color: #333333;
    letter-spacing: 0.02em;
}

.covid-notice a {
    color: #2F80ED;
    text-decoration: none;
}

.trip-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 8px;
    width: 100%;
}

.trip-title {
    margin: 0;
}

.shared-count {
    font-size: 14px;
    color: #4F4F4F;
    white-space: nowrap;
}

@media (max-width: 768px) {
    .date-group {
        grid-template-columns: 1fr;
    }

    .trip-card {
        grid-template-columns: 1fr;
    }

    .trip-image {
        width: 100%;
        height: 200px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (<?= json_encode(session()->get('isLoggedIn')) ?>) {
        loadPlans();
    }
});

async function loadPlans() {
    try {
        const response = await fetch('plans', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });
        
        if (!response.ok) {
            throw new Error('Failed to fetch plans');
        }
        
        const data = await response.json();
        
        renderPlans(data.plans, 'plansList');
        renderPlans(data.sharedPlans, 'sharedPlansList');
    } catch (error) {
        console.error('Error loading plans:', error);
        document.getElementById('plansList').innerHTML = `
            <div style="text-align: center; padding: 40px; color: #FF3B30;">
                Error loading plans: ${error.message}
            </div>
        `;
        document.getElementById('sharedPlansList').innerHTML = `
            <div style="text-align: center; padding: 40px; color: #FF3B30;">
                Error loading shared plans: ${error.message}
            </div>
        `;
    }
}

function renderPlans(plans, elementId) {
    const plansElement = document.getElementById(elementId);
    if (plans && plans.length > 0) {
        const plansHTML = plans.map(plan => `
            <div class="trip-card">
                <img src="https://images5.alphacoders.com/541/541026.jpg" alt="${plan.title}" class="trip-image">
                <div class="trip-details">
                    <div class="trip-header">
                        <h3 class="trip-title">${plan.title}</h3>
                        <span class="shared-count">${(plan.shared_users || []).length - 1} shared users</span>
                    </div>
                    <p class="trip-date">Start date: ${new Date(plan.start_date).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                    <p class="trip-date">End date: ${new Date(plan.end_date).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                    <a href="plans/view/${plan.id}" class="view-trip-btn">View trip details</a>
                </div>
            </div>
        `).join('');
        
        plansElement.innerHTML = plansHTML;
    } else {
        plansElement.innerHTML = `
            <div style="text-align: center; padding: 40px; color: #4F4F4F;">
                No trips planned yet
            </div>
        `;
    }
}

document.getElementById('planForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = {
        title: document.getElementById('title').value,
        start_date: document.getElementById('start_date').value,
        end_date: document.getElementById('end_date').value,
        destination: document.getElementById('destination').value,
        activities: document.getElementById('activities').value
    };

    try {
        const response = await fetch('plans', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error('Failed to create plan');
        }

        // Reset form and reload plans immediately
        document.getElementById('planForm').reset();
        await loadPlans();
        
    } catch (error) {
        console.error('Error creating plan:', error);
        alert('Error creating plan: ' + error.message);
    }
});
</script>
<?= $this->endSection() ?>