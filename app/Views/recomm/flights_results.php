<?= $this->extend('plans/layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-container">
    <!-- Search Form Section -->
    <div class="search-section">
        <form action="/flights" method="GET" class="search-form">
            <div class="form-group">
                <label>Origin</label>
                <div class="input-wrapper">
                    <span class="location-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M7.5 9.16667C7.5 8.72464 7.67559 8.30072 7.98816 7.98816C8.30072 7.67559 8.72464 7.5 9.16667 7.5C9.60869 7.5 10.0326 7.67559 10.3452 7.98816C10.6577 8.30072 10.8333 8.72464 10.8333 9.16667C10.8333 9.60869 10.6577 10.0326 10.3452 10.3452C10.0326 10.6577 9.60869 10.8333 9.16667 10.8333C8.72464 10.8333 8.30072 10.6577 7.98816 10.3452C7.67559 10.0326 7.5 9.60869 7.5 9.16667Z" stroke="#828282" stroke-width="1.5"/>
                            <path d="M14.0833 9.16667C14.0833 13.75 9.16667 17.5 9.16667 17.5C9.16667 17.5 4.25 13.75 4.25 9.16667C4.25 7.76776 4.80312 6.42584 5.78454 5.44442C6.76596 4.463 8.10788 3.90988 9.50679 3.90988C10.9057 3.90988 12.2476 4.463 13.229 5.44442C14.2104 6.42584 14.7635 7.76776 14.7635 9.16667H14.0833Z" stroke="#828282" stroke-width="1.5"/>
                        </svg>
                    </span>
                    <input type="text" name="origin" value="<?= esc($origin ?? '') ?>" required placeholder="Enter origin" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label>Destination</label>
                <div class="input-wrapper">
                    <span class="location-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M7.5 9.16667C7.5 8.72464 7.67559 8.30072 7.98816 7.98816C8.30072 7.67559 8.72464 7.5 9.16667 7.5C9.60869 7.5 10.0326 7.67559 10.3452 7.98816C10.6577 8.30072 10.8333 8.72464 10.8333 9.16667C10.8333 9.60869 10.6577 10.0326 10.3452 10.3452C10.0326 10.6577 9.60869 10.8333 9.16667 10.8333C8.72464 10.8333 8.30072 10.6577 7.98816 10.3452C7.67559 10.0326 7.5 9.60869 7.5 9.16667Z" stroke="#828282" stroke-width="1.5"/>
                            <path d="M14.0833 9.16667C14.0833 13.75 9.16667 17.5 9.16667 17.5C9.16667 17.5 4.25 13.75 4.25 9.16667C4.25 7.76776 4.80312 6.42584 5.78454 5.44442C6.76596 4.463 8.10788 3.90988 9.50679 3.90988C10.9057 3.90988 12.2476 4.463 13.229 5.44442C14.2104 6.42584 14.7635 7.76776 14.7635 9.16667H14.0833Z" stroke="#828282" stroke-width="1.5"/>
                        </svg>
                    </span>
                    <input type="text" name="destination" value="<?= esc($destination ?? '') ?>" required placeholder="Enter destination" class="form-input">
                </div>
            </div>

            <div class="form-group date-group">
                <label>Depart date</label>
                <div class="input-wrapper">
                    <span class="calendar-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M6.66667 5.83333V3.33333M13.3333 5.83333V3.33333M5.83333 8.33333H14.1667M4.16667 15.8333H15.8333C16.2754 15.8333 16.6667 15.442 16.6667 15V5.83333C16.6667 5.39131 16.2754 5 15.8333 5H4.16667C3.72464 5 3.33333 5.39131 3.33333 5.83333V15C3.33333 15.442 3.72464 15.8333 4.16667 15.8333Z" stroke="#828282" stroke-width="1.5"/>
                        </svg>
                    </span>
                    <input type="date" name="departDate" value="<?= esc($departDate ?? '') ?>" required class="form-input">
                </div>
            </div>

            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>

    <!-- Flight Results Section -->
    <div class="results-section">
        <?php if (isset($flights) && !empty($flights)): ?>
            <?php foreach ($flights as $flight): ?>
            <div class="flight-card">
                <div class="airline-info">
                <div class="airline-logo" style="background-image: url('https://thumbs.dreamstime.com/b/illustration-drawing-art-flight-logo-white-background-flight-logo-180260929.jpg');"></div>
                    <h3 class="airline-name"><?= esc($flight['airline']) ?></h3>
                </div>

                <div class="flight-details">
                    <div class="time-location">
                        <div class="departure">
                            <p class="time"><?= esc($flight['departure_time']) ?></p>
                            <p class="location"><?= esc($flight['departure_airport']) ?></p>
                        </div>

                        <div class="flight-path">
                            <div class="path-line"></div>
                            <div class="path-dot"></div>
                        </div>

                        <div class="arrival">
                            <p class="time"><?= esc($flight['arrival_time']) ?></p>
                            <p class="location"><?= esc($flight['arrival_airport']) ?></p>
                        </div>
                    </div>

                    <div class="price-info">
                        <div class="price">IDR <?= number_format((float)$flight['price'], 0, ',', '.') ?></div>
                        <p class="price-note">Includes taxes and fees</p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">
                <p>No flights found for your search criteria.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- COVID Notice -->
    <div class="covid-notice">
        <span class="warning-icon">⚠️</span>
        <p>Check the latest COVID-19 restrictions before you travel. <a href="/learn-more">Learn more</a></p>
    </div>
</div>

<style>
.page-container {
    width: 100%;
    min-height: calc(100vh - 68px - 89px);
    padding: 32px 0;
}

.search-section {
    height: 300px;
    max-width: 100%;
    margin: 0 auto;
    background: url('https://images8.alphacoders.com/719/719571.jpg') no-repeat center center;
    background-size: cover;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-form {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: flex-end;
    gap: 16px;
    max-width: 1000px;
    width: 90%;
    margin: 0 auto;
}

.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-family: 'Inter', sans-serif;
    font-weight: 500;
    font-size: 14px;
    color: #4A5568;
}

.input-wrapper {
    position: relative;
    width: 100%;
}

.date-group {
    flex: 0.7;
}

.location-icon,
.calendar-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #718096;
}

.form-input {
    width: 100%;
    height: 44px;
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 8px;
    padding: 8px 12px 8px 40px;
    font-size: 14px;
    color: #2D3748;
}

.search-btn {
    height: 44px;
    padding: 0 32px;
    background: #3182CE;
    border-radius: 8px;
    border: none;
    font-weight: 500;
    font-size: 14px;
    color: #FFFFFF;
    cursor: pointer;
    transition: background-color 0.2s;
}

.search-btn:hover {
    background: #2C5282;
}

.results-section {
    max-width: 1000px;
    margin: 32px auto;
    padding: 0 24px;
}

.flight-card {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.airline-info {
    display: flex;
    align-items: center;
    gap: 16px;
}

.airline-logo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
}

.airline-name {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 16px;
    color: #2D3748;
}

.flight-details {
    display: flex;
    align-items: center;
    gap: 48px;
}

.time-location {
    display: flex;
    align-items: center;
    gap: 32px;
}

.departure,
.arrival {
    text-align: center;
}

.time {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 24px;
    color: #2D3748;
    margin-bottom: 4px;
}

.location {
    font-size: 14px;
    color: #718096;
}

.flight-path {
    position: relative;
    width: 120px;
    height: 2px;
    background: #E2E8F0;
}

.path-dot {
    display: none;
}

.price-info {
    text-align: right;
    min-width: 200px;
}

.price {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 24px;
    color: #2D3748;
    margin-bottom: 4px;
}

.price-note {
    font-size: 12px;
    color: #718096;
}

.covid-notice {
    max-width: 1000px;
    margin: 32px auto;
    padding: 16px 24px;
    background: #FFF5F5;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.warning-icon {
    font-size: 20px;
}

.covid-notice p {
    font-size: 14px;
    color: #4A5568;
}

.covid-notice a {
    color: #3182CE;
    text-decoration: none;
}

.no-results {
    text-align: center;
    padding: 48px;
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    color: #718096;
}

@media (max-width: 768px) {
    .search-form {
        flex-direction: column;
        gap: 16px;
    }
    
    .flight-card {
        flex-direction: column;
        gap: 24px;
        text-align: center;
    }
    
    .flight-details {
        flex-direction: column;
        gap: 24px;
    }
    
    .price-info {
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const dateInput = document.querySelector('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];

    // Handle form submission
    const form = document.querySelector('.search-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const searchParams = new URLSearchParams();
        
        for (let [key, value] of formData.entries()) {
            searchParams.append(key, value);
        }

        // Redirect to flights page with search parameters
        window.location.href = `<?= base_url('flights') ?>?${searchParams.toString()}`;
    });
});
</script>
<?= $this->endSection() ?>

