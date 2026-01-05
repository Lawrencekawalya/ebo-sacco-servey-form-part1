<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Submission Status - EBO Survey</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/fav_icon.png') }}">
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
            padding: 20px;
        }

        .container {
            max-width: 750px;
            width: 100%;
            background: #ffffff;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
        }

        .success .container::before {
            background: linear-gradient(90deg, #00A448, #4CAF50);
        }

        .warning .container::before {
            background: linear-gradient(90deg, #f0ad4e, #ff9800);
        }

        .error .container::before {
            background: linear-gradient(90deg, #dc3545, #f44336);
        }

        .default .container::before {
            background: linear-gradient(90deg, #6c757d, #9e9e9e);
        }

        .status-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 50px auto 30px;
            font-size: 54px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .success .status-icon {
            background: linear-gradient(135deg, #00A448 0%, #4CAF50 100%);
            color: white;
            animation: pulseSuccess 2s infinite;
        }

        .warning .status-icon {
            background: linear-gradient(135deg, #f0ad4e 0%, #ff9800 100%);
            color: white;
        }

        .error .status-icon {
            background: linear-gradient(135deg, #dc3545 0%, #f44336 100%);
            color: white;
        }

        .default .status-icon {
            background: linear-gradient(135deg, #6c757d 0%, #9e9e9e 100%);
            color: white;
        }

        @keyframes pulseSuccess {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 164, 72, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(0, 164, 72, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(0, 164, 72, 0);
            }
        }

        h1 {
            color: #2c3e50;
            font-size: 36px;
            margin-bottom: 15px;
            font-weight: 700;
            padding: 0 30px;
        }

        .success h1 {
            color: #00A448;
        }

        .warning h1 {
            color: #f0ad4e;
        }

        .error h1 {
            color: #dc3545;
        }

        .default h1 {
            color: #6c757d;
        }

        .subtitle {
            color: #6c757d;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
            padding: 0 30px;
        }

        .message {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px 30px;
            margin: 30px 40px;
            text-align: left;
            border-left: 4px solid;
            font-size: 16px;
            line-height: 1.7;
        }

        .success .message {
            border-left-color: #00A448;
            background-color: #f0f9f0;
        }

        .warning .message {
            border-left-color: #f0ad4e;
            background-color: #fff8e6;
        }

        .error .message {
            border-left-color: #dc3545;
            background-color: #fdf0f0;
        }

        .default .message {
            border-left-color: #6c757d;
            background-color: #f8f9fa;
        }

        .details {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 40px;
            border: 1px solid #e9ecef;
            text-align: left;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f1f1f1;
        }

        .detail-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #6c757d;
        }

        .detail-text {
            flex: 1;
        }

        .detail-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 3px;
        }

        .detail-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .actions {
            margin: 40px 30px 50px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 35px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 16px;
            cursor: pointer;
            border: none;
            min-width: 180px;
        }

        .btn-primary {
            background: #0a58ca;
            color: white;
        }

        .btn-primary:hover {
            background: #084298;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(10, 88, 202, 0.2);
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
            transform: translateY(-2px);
        }

        .btn i {
            margin-right: 10px;
            font-size: 18px;
        }

        .footer {
            margin-top: 30px;
            padding: 25px;
            background: #f8f9fa;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #e9ecef;
        }

        .footer a {
            color: #0a58ca;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
            }

            h1 {
                font-size: 28px;
                padding: 0 20px;
            }

            .message,
            .details {
                margin: 25px 20px;
                padding: 20px;
            }

            .actions {
                margin: 30px 20px 40px;
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        .confetti {
            position: fixed;
            width: 20px;
            height: 20px;
            pointer-events: none;
            opacity: 0;
        }
    </style>
</head>

{{-- <body class="{{ session('status') ? session('status') : 'default' }}"> --}}

<body class="success">

    <div class="container">
        {{-- @php $status = session('status'); @endphp --}}

        {{-- @if ($status === 'success') --}}
        <div class="status-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Submission Sent Successfully!</h1>
        <p class="subtitle">Thank you for completing the EBO Staff Satisfaction Survey 2025</p>

        <div class="message">
            <p>Your survey responses have been securely recorded and submitted to the HR department. Your feedback
                is valuable and will contribute to improving our workplace environment.</p>
            {{-- <p><strong>Submission ID:</strong> #{{ substr(md5(uniqid()), 0, 10) }}</p> --}}
        </div>

        <div class="details">
            <div class="detail-item">
                <div class="detail-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="detail-text">
                    <div class="detail-label">Confidentiality</div>
                    <div class="detail-value">Your responses are anonymous and confidential</div>
                </div>
            </div>
            {{-- <div class="detail-item">
                <div class="detail-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="detail-text">
                    <div class="detail-label">Submission Time</div>
                        <div class="detail-value">{{ date('F j, Y g:i A') }}</div>
                    @if (session('confirmed_at'))
                        <div class="detail-value">{{ session('confirmed_at')->format('F j, Y g:i A') }}</div>
                    @endif
                </div>
            </div> --}}
            <div class="detail-item">
                <div class="detail-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="detail-text">
                    <div class="detail-label">Survey Reference</div>
                    {{-- <div class="detail-value">EBO-SAT-2025-{{ rand(1000, 9999) }}</div> --}}
                </div>
            </div>
        </div>

        {{-- <div class="actions">
                <a href="/" class="btn btn-primary">
                    <i class="fas fa-home"></i> Return to Homepage
                </a>
                <a href="/survey" class="btn btn-outline">
                    <i class="fas fa-clipboard-list"></i> View Survey Summary
                </a>
                <button onclick="downloadConfirmation()" class="btn btn-secondary">
                    <i class="fas fa-download"></i> Download Receipt
                </button>
            </div> --}}


        <div class="footer">
            <p>© 2025 EBO Staff Satisfaction Survey. All rights reserved.</p>
            <p>For assistance, contact <a href="mailto:sorishaba@ebo.co.ug">HR Department</a> or call
                <a href="tel:+256787320618">+256(0) 78 732 0618</a>,
                <a href="tel:+256701142253">+256(0) 70 114 2253</a>
            </p>
        </div>
    </div>

    <script>
        // Add confetti animation for success

        document.addEventListener('DOMContentLoaded', function() {
            createConfetti();

            // Trigger confetti every 3 seconds
            setInterval(createConfetti, 3000);
        });

        function createConfetti() {
            const colors = ['#00A448', '#0a58ca', '#4CAF50', '#FFC107', '#FF5722'];
            const container = document.querySelector('.container');

            for (let i = 0; i < 15; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-20px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = Math.random() * 10 + 8 + 'px';
                confetti.style.height = confetti.style.width;
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;

                document.body.appendChild(confetti);

                const animation = confetti.animate([{
                        transform: `translateY(0) rotate(0deg)`,
                        opacity: 1
                    },
                    {
                        transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 360}deg)`,
                        opacity: 0
                    }
                ], {
                    duration: Math.random() * 3000 + 2000,
                    easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)'
                });

                animation.onfinish = () => confetti.remove();
            }
        }

        function downloadConfirmation() {
            const btn = event.target.closest('button');
            const originalText = btn.innerHTML;

            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';
            btn.disabled = true;

            // Simulate download process
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Downloaded!';
                btn.style.background = '#00A448';

                // Create a fake download
                const element = document.createElement('a');
                element.setAttribute('href',
                    'data:text/plain;charset=utf-8,Thank you for completing the EBO Staff Satisfaction Survey 2025.%0D%0A%0D%0ASubmission ID: ' +
                    Date.now() + '%0D%0ADate: ' + new Date().toLocaleDateString() + '%0D%0ATime: ' +
                    new Date().toLocaleTimeString());
                element.setAttribute('download', 'EBO_Survey_Confirmation.txt');
                element.style.display = 'none';
                document.body.appendChild(element);
                element.click();
                document.body.removeChild(element);

                // Reset button after 2 seconds
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    btn.style.background = '';
                }, 2000);
            }, 1500);
        }


        // Add subtle entrance animation for all statuses
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';

            setTimeout(() => {
                container.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>

</body>

</html>
