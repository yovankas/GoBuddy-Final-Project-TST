<?= $this->extend('plans/layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-container">
    <!-- Back Navigation -->
    <div class="back-nav">
        <a href="<?= base_url('plans/view/' . $plan['id']) ?>" class="back-link">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20 12H4M4 12L10 18M4 12L10 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Back to trips</span>
        </a>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title"><?= $plan['title'] ?></h1>
            <div class="date-group">
                <p class="date">Start date: <?= date('l, F j, Y', strtotime($plan['start_date'])) ?></p>
                <p class="date">End date: <?= date('l, F j, Y', strtotime($plan['end_date'])) ?></p>
            </div>
        </div>
    </div>


    <!-- Edit Form Section -->
    <section class="edit-section">
        <h2 class="section-title">Edit trip</h2>
        <div class="edit-form-container">
            <form id="editForm" class="edit-form">
                <div class="form-group">
                    <label>Destination :</label>
                    <input type="text" name="destination" class="form-input" value="<?= $plan['destination'] ?>">
                </div>

                <div class="form-group">
                    <label>Activities :</label>
                    <input type="text" name="activities" class="form-input" value="<?= $plan['activities'] ?>">
                </div>

                <div class="form-group">
                    <label>Shared users :</label>
                    <div class="shared-users-list">
                        <?php foreach ($plan['shared_users'] as $email): ?>
                        <div class="shared-user-item">
                            <input type="text" class="form-input" value="<?= $email ?>" readonly>
                            <button type="button" class="remove-btn" onclick="showModal('Are you sure you want to remove this user?', '<?= base_url('plans/remove-user/' . $plan['id'] . '/' . urlencode($email)) ?>')">
                            Remove
                            </button>
                        </div>
                        <?php endforeach; ?>
                        <div class="add-user-section">
                            <input type="email" id="newUserEmail" class="form-input" placeholder="Enter email address">
                            <button type="button" id="addUserBtn" class="add-btn">Add user</button>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?= base_url('plans/view/' . $plan['id']) ?>" class="cancel-btn">Cancel</a>
                    <button type="submit" class="save-btn">Save changes</button>
                </div>
            </form>
        </div>
    </section>

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
    background: #F4F4F4;
    padding-bottom: 32px;
}

.back-nav {
    padding: 24px 100px;
}

.back-link {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: #1B1F2D;
    font-size: 18px;
    font-weight: 500;
    letter-spacing: 0.02em;
}

.hero-section {
    width: 100%;
    height: 164px;
    background: linear-gradient(0deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.2)), url('https://images8.alphacoders.com/719/719571.jpg') center/cover;
    margin-bottom: 40px;
}

.hero-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 24px 100px;
}

.hero-title {
    margin-top: -0px;
    font-size: 40px;
    font-weight: 700;
    color: #FFFFFF;
    margin-bottom: 16px;
    letter-spacing: 0.01em;
}

.date-group {
    display: flex;
    gap: 66px;
}

.date {
    font-size: 14px;
    color: #FFFFFF;
    letter-spacing: 0.01em;
}

.section-title {
    font-size: 32px;
    font-weight: 600;
    color: #1A1A1A;
    letter-spacing: 0.01em;
    margin-bottom: 24px;
}

.edit-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 100px;
    margin-bottom: 40px;
}

.edit-form-container {
    background: #FFFFFF;
    border: 1px solid #E0E0E0;
    border-radius: 5px;
    padding: 24px;
}

.edit-form {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-size: 16px;
    color: #4F4F4F;
    letter-spacing: 0.01em;
}

.form-input {
    height: 44px;
    background: #F2F2F2;
    border: none;
    border-radius: 4px;
    padding: 11px 12px;
    font-size: 15px;
    color: #1A1A1A;
    letter-spacing: 0.02em;
}

.shared-users-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.shared-user-item {
    display: flex;
    gap: 16px;
    align-items: center;
}

.add-user-section {
    display: flex;
    gap: 16px;
    align-items: center;
}

.remove-btn {
    padding: 10px 18px;
    background: rgba(255, 59, 48, 0.7);
    border: none;
    border-radius: 6px;
    color: #FFFFFF;
    font-size: 13px;
    font-weight: 500; AC
    cursor: pointer;
    letter-spacing: 0.02em;
    width: 85px;
}

.add-btn {
    padding: 10px 18px;
    background: #2F80ED;
    border: none;
    border-radius: 6px;
    color: #FFFFFF;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    letter-spacing: 0.02em;
    width: 85px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
    margin-top: 24px;
}

.cancel-btn {
    padding: 10px 18px;
    background: #FF3B30;
    border: none;
    border-radius: 6px;
    color: #FFFFFF;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    width: 101px;
}

.save-btn {
    padding: 10px 18px;
    background: #2F80ED;
    border: none;
    border-radius: 6px;
    color: #FFFFFF;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    width: 140px;
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

.modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            max-width: 400px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal h3 {
            margin-bottom: 1rem;
        }

        .modal-buttons {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

@media (max-width: 768px) {
    .back-nav,
    .hero-content,
    .edit-section {
        padding: 0 24px;
    }

    .shared-user-item,
    .add-user-section {
        flex-direction: column;
        align-items: stretch;
    }

    .remove-btn,
    .add-btn {
        width: 100%;
    }

    .form-actions {
        flex-direction: column;
    }

    .cancel-btn,
    .save-btn {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editForm');
    const addUserBtn = document.getElementById('addUserBtn');
    const newUserEmail = document.getElementById('newUserEmail');

    // Handle form submission
    editForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = {
            destination: editForm.querySelector('[name="destination"]').value,
            activities: editForm.querySelector('[name="activities"]').value
        };

        try {
            const response = await fetch('<?= base_url('plans/' . $plan['id'] . '/update') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error('Update failed');
            }

            window.location.href = '<?= base_url('plans/view/' . $plan['id']) ?>';
        } catch (error) {
            alert('Error updating plan: ' + error.message);
        }
    });

    // Handle add user
    addUserBtn.addEventListener('click', async () => {
        const email = newUserEmail.value;
        if (!email) return;

        try {
            const response = await fetch('<?= base_url('plans/' . $plan['id'] . '/users') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ email })
            });

            const data = await response.json();

            if (response.ok) {
                window.location.reload();
            } else {
                alert(data.messages || 'Failed to add user');
            }
        } catch (error) {
            alert('Error adding user: ' + error.message);
        }
    });

});
</script>

    <!-- Modal -->
    <div class="modal" id="confirmationModal">
        <div class="modal-content">
            <h3 id="modalMessage">Are you sure?</h3>
            <div class="modal-buttons">
                <button class="btn btn-cancel" onclick="hideModal()">Cancel</button>
                <a href="#" id="modalConfirmButton" class="btn btn-delete">Delete</a>
            </div>
        </div>
    </div>

    <script>
        function showModal(message, confirmUrl) {
            document.getElementById('modalMessage').innerText = message;
            document.getElementById('modalConfirmButton').setAttribute('href', confirmUrl);
            document.getElementById('confirmationModal').style.display = 'flex';
        }

        function hideModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }
    </script>

<?= $this->endSection() ?>
