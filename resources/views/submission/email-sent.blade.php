<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Submission Confirmation - EBO Staff Survey</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f4f6f8 0%, #e8eff7 100%);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 700px;
            margin: 20px;
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #0a58ca, #00A448);
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #00A448 0%, #0a58ca 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 5px 15px rgba(0, 164, 72, 0.2);
        }

        .success-icon i {
            font-size: 48px;
            color: white;
        }

        h1 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .subtitle {
            color: #6c757d;
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .email-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin: 30px 0;
            border-left: 4px solid #0a58ca;
            text-align: left;
            position: relative;
        }

        .email-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 8px;
            display: block;
        }

        .email {
            font-weight: bold;
            color: #2c3e50;
            font-size: 20px;
            word-break: break-all;
            padding: 10px 15px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e9ecef;
            display: flex;
            align-items: center;
        }

        .email i {
            color: #0a58ca;
            margin-right: 10px;
            font-size: 18px;
        }

        .instructions {
            background: #e8f4fd;
            border-radius: 10px;
            padding: 25px;
            margin: 30px 0;
            text-align: left;
            border-left: 4px solid #0a58ca;
        }

        .instructions h3 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .instructions h3 i {
            margin-right: 10px;
            color: #0a58ca;
        }

        .steps {
            padding-left: 20px;
            margin: 0;
        }

        .steps li {
            margin-bottom: 12px;
            line-height: 1.5;
            color: #495057;
        }

        .steps li strong {
            color: #2c3e50;
        }

        .timer {
            background: #fff8e6;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px dashed #f0ad4e;
        }

        .timer i {
            color: #f0ad4e;
            font-size: 24px;
            margin-right: 15px;
        }

        .timer-content {
            text-align: left;
        }

        .timer-title {
            font-weight: bold;
            color: #d9534f;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .timer-time {
            font-size: 24px;
            font-weight: bold;
            color: #d9534f;
            font-family: 'Courier New', monospace;
        }

        .note {
            margin-top: 30px;
            font-size: 15px;
            color: #6c757d;
            line-height: 1.6;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .note i {
            color: #6c757d;
            margin-right: 8px;
        }

        .actions {
            margin-top: 40px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: #0a58ca;
            color: white;
        }

        .btn-primary:hover {
            background: #084298;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(10, 88, 202, 0.2);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: #0a58ca;
            border: 1px solid #0a58ca;
        }

        .btn-outline:hover {
            background: #f0f7ff;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #6c757d;
            font-size: 14px;
        }

        .footer a {
            color: #0a58ca;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
                margin: 15px;
            }

            h1 {
                font-size: 26px;
            }

            .email {
                font-size: 16px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="success-icon">
            <i class="fas fa-envelope-circle-check"></i>
        </div>

        <h1>Almost Done!</h1>
        <p class="subtitle">We've sent a confirmation email to verify your submission.</p>

        <div class="email-card">
            <div class="email-label">Confirmation sent to:</div>
            <div class="email">
                <i class="fas fa-envelope"></i>
                <span>{{ session('email') }}</span>
            </div>
        </div>

        <div class="instructions">
            <h3><i class="fas fa-list-ol"></i> Next Steps</h3>
            <ol class="steps">
                <li><strong>Check your inbox</strong> for an email from EBO Survey System</li>
                <li><strong>Click the confirmation link</strong> in the email to finalize your submission</li>
                <li><strong>Wait for the confirmation page</strong> to confirm your submission was received</li>
            </ol>
        </div>

        <div class="timer">
            <i class="fas fa-clock"></i>
            <div class="timer-content">
                <div class="timer-title">Link expires in:</div>
                <div class="timer-time" id="countdown">02:00:00</div>
            </div>
        </div>

        {{-- <div class="actions">
            <a href="mailto:" class="btn btn-primary">
                <i class="fas fa-external-link-alt"></i> Open Email Client
            </a>
            <button onclick="location.reload()" class="btn btn-secondary">
                <i class="fas fa-sync-alt"></i> Resend Confirmation
            </button>
            <a href="/" class="btn btn-outline">
                <i class="fas fa-home"></i> Return to Home
            </a>
        </div> --}}

        <div class="note">
            <p><i class="fas fa-exclamation-circle"></i> If you don't see the email within a few minutes, please check
                your spam or junk folder.</p>
            <p><i class="fas fa-shield-alt"></i> For security reasons, the confirmation link will expire in 2 hours.</p>
        </div>

        <div class="footer">
            <p>Need help? <a href="mailto:support@ebo.org">Contact EBO Support</a> or call +1 (234) 567-8900</p>
            <p>© 2025 EBO Staff Satisfaction Survey. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Countdown timer for 2 hours
        function startCountdown() {
            const twoHours = 2 * 60 * 60; // 2 hours in seconds
            let timeLeft = twoHours;

            const countdownElement = document.getElementById('countdown');

            const timer = setInterval(() => {
                timeLeft--;

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    countdownElement.textContent = "00:00:00";
                    countdownElement.style.color = "#d9534f";
                    document.querySelector('.timer-title').textContent = "Link has expired!";
                    return;
                }

                const hours = Math.floor(timeLeft / 3600);
                const minutes = Math.floor((timeLeft % 3600) / 60);
                const seconds = timeLeft % 60;

                countdownElement.textContent =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                // Change color when less than 30 minutes left
                if (timeLeft < 30 * 60) {
                    countdownElement.style.color = "#d9534f";
                }
            }, 1000);
        }

        // Start countdown when page loads
        document.addEventListener('DOMContentLoaded', startCountdown);

        // Resend confirmation button functionality
        document.querySelector('.btn-secondary').addEventListener('click', function(e) {
            e.preventDefault();
            const btn = this;
            const originalText = btn.innerHTML;

            // Show loading state
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            btn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success message
                btn.innerHTML = '<i class="fas fa-check"></i> Confirmation Resent!';
                btn.style.background = '#00A448';

                // Reset button after 3 seconds
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    btn.style.background = '';
                }, 3000);
            }, 1500);
        });
    </script>

</body>

</html>
