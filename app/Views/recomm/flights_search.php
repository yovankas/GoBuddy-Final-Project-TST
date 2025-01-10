<?= $this->extend('plans/layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-container">
    <div class="hero-section">
        <h1 class="page-title">Find the perfect flights</h1>
        
        <div class="search-container">
            <form action="/flights" method="GET" class="search-form">
                <div class="form-group">
                    <label for="origin">Origin</label>
                    <div class="input-wrapper">
                        <span class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 9.16667C7.5 8.72464 7.67559 8.30072 7.98816 7.98816C8.30072 7.67559 8.72464 7.5 9.16667 7.5C9.60869 7.5 10.0326 7.67559 10.3452 7.98816C10.6577 8.30072 10.8333 8.72464 10.8333 9.16667C10.8333 9.60869 10.6577 10.0326 10.3452 10.3452C10.0326 10.6577 9.60869 10.8333 9.16667 10.8333C8.72464 10.8333 8.30072 10.6577 7.98816 10.3452C7.67559 10.0326 7.5 9.60869 7.5 9.16667Z" stroke="#828282" stroke-width="1.5"/>
                                <path d="M14.0833 9.16667C14.0833 13.75 9.16667 17.5 9.16667 17.5C9.16667 17.5 4.25 13.75 4.25 9.16667C4.25 7.76776 4.80312 6.42584 5.78454 5.44442C6.76596 4.463 8.10788 3.90988 9.50679 3.90988C10.9057 3.90988 12.2476 4.463 13.229 5.44442C14.2104 6.42584 14.7635 7.76776 14.7635 9.16667H14.0833Z" stroke="#828282" stroke-width="1.5"/>
                            </svg>
                        </span>
                        <input type="text" id="origin" name="origin" required placeholder="Enter origin" class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="destination">Destination</label>
                    <div class="input-wrapper">
                        <span class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 9.16667C7.5 8.72464 7.67559 8.30072 7.98816 7.98816C8.30072 7.67559 8.72464 7.5 9.16667 7.5C9.60869 7.5 10.0326 7.67559 10.3452 7.98816C10.6577 8.30072 10.8333 8.72464 10.8333 9.16667C10.8333 9.60869 10.6577 10.0326 10.3452 10.3452C10.0326 10.6577 9.60869 10.8333 9.16667 10.8333C8.72464 10.8333 8.30072 10.6577 7.98816 10.3452C7.67559 10.0326 7.5 9.60869 7.5 9.16667Z" stroke="#828282" stroke-width="1.5"/>
                                <path d="M14.0833 9.16667C14.0833 13.75 9.16667 17.5 9.16667 17.5C9.16667 17.5 4.25 13.75 4.25 9.16667C4.25 7.76776 4.80312 6.42584 5.78454 5.44442C6.76596 4.463 8.10788 3.90988 9.50679 3.90988C10.9057 3.90988 12.2476 4.463 13.229 5.44442C14.2104 6.42584 14.7635 7.76776 14.7635 9.16667H14.0833Z" stroke="#828282" stroke-width="1.5"/>
                            </svg>
                        </span>
                        <input type="text" id="destination" name="destination" required placeholder="Enter destination" class="form-input">
                    </div>
                </div>

                <div class="form-group date-group">
                    <label for="departDate">Depart date</label>
                    <div class="input-wrapper">
                        <span class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.66667 5.83333V3.33333M13.3333 5.83333V3.33333M5.83333 8.33333H14.1667M4.16667 15.8333H15.8333C16.2754 15.8333 16.6667 15.442 16.6667 15V5.83333C16.6667 5.39131 16.2754 5 15.8333 5H4.16667C3.72464 5 3.33333 5.39131 3.33333 5.83333V15C3.33333 15.442 3.72464 15.8333 4.16667 15.8333Z" stroke="#828282" stroke-width="1.5"/>
                            </svg>
                        </span>
                        <input type="date" id="departDate" name="departDate" required class="form-input">
                    </div>
                </div>

                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>

        <div class="covid-notice">
            <span class="warning-icon">⚠️</span>
            <p>Check the latest COVID-19 restrictions before you travel. <a href="/learn-more">Learn more</a></p>
        </div>
    </div>
</div>

<style>
.page-container {
    width: 100%;
    min-height: calc(100vh - 68px - 89px);
    background: #FFFFFF;
}

.hero-section {
    width: 100%;
    background: url('https://images8.alphacoders.com/719/719571.jpg') center/cover;
    padding: 112px 24px 32px;
    position: relative;
}

.page-title {
    font-weight: 600;
    font-size: 32px;
    line-height: 1.2;
    color: #FFFFFF;
    margin: 0 auto;
    max-width: 1200px;
    letter-spacing: 0.01em;
}

.search-container {
    max-width: 1240px;
    margin: 26px auto 0;
}

.search-form {
    background: #FFFFFF;
    box-shadow: 0px 4px 37px rgba(0, 0, 0, 0.15);
    border-radius: 8px;
    padding: 24px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.form-group {
    flex: 1 1 200px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.form-group label {
    font-weight: 500;
    font-size: 14px;
    line-height: 140%;
    letter-spacing: 0.02em;
    color: #4F4F4F;
}

.input-wrapper {
    position: relative;
    width: 100%;
}

.icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}

.form-input {
    width: 100%;
    height: 44px;
    background: #F2F2F2;
    border: none;
    border-radius: 4px;
    padding: 11px 12px 12px 42px;
    font-size: 14px;
    line-height: 140%;
    letter-spacing: 0.02em;
    color: #333333;
}

.form-input::placeholder {
    color: #333333;
}

.search-btn {
    flex: 1 1 100%;
    height: 43px;
    padding: 12px 18px;
    background: #2F80ED;
    border-radius: 6px;
    border: none;
    font-weight: 500;
    font-size: 15px;
    line-height: 20px;
    letter-spacing: 0.02em;
    color: #FFFFFF;
    cursor: pointer;
}

.covid-notice {
    max-width: 1240px;
    margin: 32px auto 0;
    padding: 16px 24px;
    background: #FCEFCA;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.warning-icon {
    font-size: 24px;
}

.covid-notice p {
    font-size: 16px;
    line-height: 140%;
    letter-spacing: 0.02em;
    color: #333333;
}

.covid-notice a {
    color: #2F80ED;
    text-decoration: none;
}

@media (min-width: 768px) {
    .hero-section {
        padding: 112px 24px 64px;
    }

    .page-title {
        font-size: 40px;
    }

    .search-form {
        padding: 32px;
    }

    .form-group {
        flex: 1 1 0;
    }

    .search-btn {
        flex: 0 0 auto;
        align-self: flex-end;
    }
}

@media (min-width: 1024px) {
    .search-form {
        flex-wrap: nowrap;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const dateInput = document.querySelector('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    dateInput.value = today;

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