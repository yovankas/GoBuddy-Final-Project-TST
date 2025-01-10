<?= $this->extend('plans/layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-container">
    <!-- Search Form Section -->
    <div class="search-section">
        <form action="/hotels" method="GET" class="search-form">
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
                <label>Check in</label>
                <div class="input-wrapper">
                    <span class="calendar-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M6.66667 5.83333V3.33333M13.3333 5.83333V3.33333M5.83333 8.33333H14.1667M4.16667 15.8333H15.8333C16.2754 15.8333 16.6667 15.442 16.6667 15V5.83333C16.6667 5.39131 16.2754 5 15.8333 5H4.16667C3.72464 5 3.33333 5.39131 3.33333 5.83333V15C3.33333 15.442 3.72464 15.8333 4.16667 15.8333Z" stroke="#828282" stroke-width="1.5"/>
                        </svg>
                    </span>
                    <input type="date" name="checkin" value="<?= esc($checkin ?? '') ?>" required class="form-input">
                </div>
            </div>

            <div class="form-group date-group">
                <label>Check out</label>
                <div class="input-wrapper">
                    <span class="calendar-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M6.66667 5.83333V3.33333M13.3333 5.83333V3.33333M5.83333 8.33333H14.1667M4.16667 15.8333H15.8333C16.2754 15.8333 16.6667 15.442 16.6667 15V5.83333C16.6667 5.39131 16.2754 5 15.8333 5H4.16667C3.72464 5 3.33333 5.39131 3.33333 5.83333V15C3.33333 15.442 3.72464 15.8333 4.16667 15.8333Z" stroke="#828282" stroke-width="1.5"/>
                        </svg>
                    </span>
                    <input type="date" name="checkout" value="<?= esc($checkout ?? '') ?>" required class="form-input">
                </div>
            </div>

            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>

    <!-- Hotel Results Section -->
    <div class="results-section">
        <?php if (isset($hotels) && !empty($hotels)): ?>
            <?php foreach ($hotels as $hotel): ?>
                <div class="hotel-card">
                    <div class="hotel-image">
                        <img src="<?= esc($hotel['thumbnail_url']) ?>" alt="<?= esc($hotel['name']) ?>">
                    </div>

                    <div class="hotel-details">
                        <div class="hotel-info">
                            <h3 class="hotel-name"><?= esc($hotel['name']) ?></h3>
                            <div class="hotel-rating">
                                <div class="stars">
                                    <?php
                                    $rating = floor($hotel['rating']);
                                    for ($i = 0; $i < 5; $i++):
                                    ?>
                                        <span class="star <?= $i < $rating ? 'filled' : '' ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                                <span class="review-count"><?= esc($hotel['reviewCount']) ?> reviews</span>
                            </div>
                            <p class="hotel-location"><?= esc($hotel['address']) ?></p>
                            <div class="hotel-amenities">
                                <?php foreach ($hotel['amenities'] as $amenity): ?>
                                    <span class="amenity"><?= esc($amenity) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="price-info">
                            <div class="room-info">1 room 1 day</div>
                            <div class="price">IDR <?= number_format((float)$hotel['price'], 0, ',', '.') ?></div>
                            <div class="price-note">Includes taxes and fees</div>
                            <a href="<?= esc($hotel['link']) ?>" class="book-btn" target="_blank" rel="noopener noreferrer">See details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">
                <p>No hotels found for your search criteria.</p>
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
    min-height: 100vh;
    background: #FFFFFF;
    font-family: 'Inter', sans-serif;
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
    padding: 24px 100px;
    max-width: 1440px;
    margin: 0 auto;
}

.hotel-card {
    display: flex;
    margin-bottom: 24px;
    background: #FFFFFF;
    border: 1px solid #E0E0E0;
    border-radius: 5px;
    padding: 20px;
}

.hotel-image {
    width: 385.92px;
    height: 200px;
    border-radius: 5px;
    overflow: hidden;
    margin-right: 32px;
}

.hotel-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hotel-details {
    flex: 1;
    display: flex;
    justify-content: space-between;
}

.hotel-info {
    flex: 1;
}

.hotel-name {
    font-weight: 500;
    font-size: 20px;
    line-height: 24px;
    color: #1A1A1A;
    margin-bottom: 8px;
}

.hotel-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

.stars {
    display: flex;
    gap: 2px;
}

.star {
    color: #E0E0E0;
}

.star.filled {
    color: #F2994A;
}

.review-count {
    font-size: 14px;
    color: #4F4F4F;
}

.hotel-location {
    font-weight: 500;
    font-size: 13px;
    color: #4F4F4F;
    margin-bottom: 4px;
}

.hotel-amenities {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.amenity {
    font-size: 13px;
    color: #4F4F4F;
    background: #F2F2F2;
    padding: 4px 8px;
    border-radius: 4px;
}

.price-info {
    text-align: right;
    min-width: 220px;
}

.room-info {
    font-size: 14px;
    color: #333333;
    margin-bottom: 4px;
}

.price {
    font-weight: 500;
    font-size: 32px;
    color: #333333;
    margin-bottom: 4px;
}

.price-note {
    font-size: 14px;
    color: #333333;
    margin-bottom: 16px;
}

.book-btn {
    padding: 10px 18px;
    background: #2F80ED;
    border-radius: 6px;
    border: none;
    font-weight: 500;
    font-size: 15px;
    color: #FFFFFF;
    cursor: pointer;
    width: 119px;
}

.covid-notice {
    max-width: 1240px;
    margin: 32px auto;
    padding: 16px;
    background: #FCEFCA;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.warning-icon {
    font-size: 20px;
}

.covid-notice p {
    font-size: 16px;
    color: #333333;
}

.covid-notice a {
    color: inherit;
    text-decoration: underline;
}

.copyright {
    font-size: 11px;
    color: #4F4F4F;
}

@media (max-width: 1200px) {
    .search-section,
    .results-section {
        padding: 24px;
    }

    .search-form {
        flex-direction: column;
        gap: 16px;
    }

    .input-wrapper {
        width: 100%;
    }

    .hotel-card {
        flex-direction: column;
    }

    .hotel-image {
        width: 100%;
        margin-right: 0;
        margin-bottom: 16px;
    }

    .hotel-details {
        flex-direction: column;
    }

    .price-info {
        margin-top: 16px;
        text-align: left;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const checkinInput = document.querySelector('#checkin');
    const checkoutInput = document.querySelector('#checkout');
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

        // Redirect to hotels page with search parameters
        window.location.href = `<?= base_url('hotels') ?>?${searchParams.toString()}`;
    });
});
</script>
<?= $this->endSection() ?>

