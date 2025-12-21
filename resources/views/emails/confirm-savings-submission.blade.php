<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your EBO Staff Satisfaction Survey Submission</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8fafc;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        /* Header Section */
        .email-header {
            background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
            padding: 30px;
            text-align: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background-color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .logo-icon svg {
            width: 24px;
            height: 24px;
            color: #0a58ca;
        }

        .organization-name {
            color: white;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .email-title {
            color: white;
            font-size: 18px;
            font-weight: 500;
            opacity: 0.9;
        }

        /* Content Section */
        .email-content {
            padding: 40px 35px;
        }

        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        .intro-text {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 25px;
            line-height: 1.7;
        }

        /* Confirmation Box */
        .confirmation-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 30px;
            margin: 30px 0;
            border-left: 4px solid #0a58ca;
            text-align: center;
        }

        .confirmation-label {
            font-size: 14px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .confirmation-button {
            display: inline-block;
            background: linear-gradient(135deg, #00A448 0%, #008c3a 100%);
            color: white;
            text-decoration: none;
            padding: 16px 40px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 17px;
            margin: 15px 0;
            box-shadow: 0 4px 15px rgba(0, 164, 72, 0.2);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .confirmation-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 164, 72, 0.3);
            background: linear-gradient(135deg, #00b851 0%, #00a042 100%);
        }

        .confirmation-link {
            display: block;
            margin-top: 20px;
            padding: 12px;
            background-color: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            color: #4a5568;
            word-break: break-all;
            text-align: left;
            line-height: 1.5;
        }

        /* Timer Section */
        .timer-section {
            background-color: #fff8e6;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            border: 1px solid #ffecb3;
            display: flex;
            align-items: center;
        }

        .timer-icon {
            width: 40px;
            height: 40px;
            background-color: #f0ad4e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .timer-icon svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .timer-text {
            flex: 1;
        }

        .timer-title {
            font-weight: 600;
            color: #d35400;
            margin-bottom: 5px;
        }

        .timer-desc {
            font-size: 14px;
            color: #7d6608;
        }

        /* Details Section */
        .details-box {
            background-color: #f0f7ff;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            border: 1px solid #cfe2ff;
        }

        .details-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .details-title svg {
            margin-right: 10px;
            color: #0a58ca;
        }

        .detail-item {
            display: flex;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #cfe2ff;
        }

        .detail-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .detail-label {
            font-weight: 500;
            color: #4a5568;
            min-width: 120px;
        }

        .detail-value {
            font-weight: 600;
            color: #2c3e50;
        }

        /* Security Notice */
        .security-notice {
            background-color: #fdf0f0;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            border: 1px solid #f5c6cb;
            display: flex;
            align-items: flex-start;
        }

        .security-icon {
            width: 40px;
            height: 40px;
            background-color: #dc3545;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .security-icon svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .security-text {
            flex: 1;
        }

        .security-title {
            font-weight: 600;
            color: #c0392b;
            margin-bottom: 5px;
        }

        .security-desc {
            font-size: 14px;
            color: #a93226;
        }

        /* Footer */
        .email-footer {
            padding: 25px 35px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }

        .footer-text {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .contact-info {
            font-size: 13px;
            color: #6c757d;
            margin-top: 20px;
        }

        .contact-link {
            color: #0a58ca;
            text-decoration: none;
        }

        .contact-link:hover {
            text-decoration: underline;
        }

        .footer-divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 20px 0;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .email-container {
                border-radius: 0;
            }

            .email-header,
            .email-content,
            .email-footer {
                padding: 25px 20px;
            }

            .confirmation-button {
                padding: 14px 30px;
                font-size: 16px;
                display: block;
                text-align: center;
            }

            .timer-section,
            .security-notice {
                flex-direction: column;
                align-items: flex-start;
            }

            .timer-icon,
            .security-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .detail-item {
                flex-direction: column;
            }

            .detail-label {
                min-width: auto;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo-container">
                <div class="logo-icon">
                    <!-- SVG Check Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="organization-name">EBO</div>
            </div>
            <div class="email-title">Staff Satisfaction Survey 2025</div>
        </div>

        <!-- Content -->
        <div class="email-content">
            <div class="greeting">Hello,</div>

            <p class="intro-text">
                Thank you for participating in the EBO Staff Satisfaction Survey 2025.
                We've received your submission initiated from your SACCO email address.
            </p>

            <p class="intro-text">
                To ensure the security and validity of your submission, we need you to confirm
                your participation by clicking the confirmation button below.
            </p>

            <!-- Confirmation Section -->
            <div class="confirmation-box">
                <div class="confirmation-label">Action Required</div>
                <h2 style="margin: 15px 0; color: #2c3e50; font-size: 22px;">
                    Confirm Your Survey Submission
                </h2>
                <p style="color: #64748b; margin-bottom: 20px;">
                    Click the button below to verify and finalize your submission
                </p>

                <a href="{{ url('/confirm-submission/' . $submission->confirmation_token) }}"
                    class="confirmation-button">
                    Confirm My Submission
                </a>

                <p style="font-size: 14px; color: #94a3b8; margin: 15px 0;">
                    Or copy and paste this link into your browser:
                </p>

                <div class="confirmation-link">
                    {{ url('/confirm-submission/' . $submission->confirmation_token) }}
                </div>
            </div>

            <!-- Timer Section -->
            <div class="timer-section">
                <div class="timer-icon">
                    <!-- SVG Clock Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="timer-text">
                    <div class="timer-title">⏰ Link Expires in 2 Hours</div>
                    <div class="timer-desc">
                        For security reasons, this confirmation link will expire at
                        {{ date('g:i A', strtotime('+2 hours')) }}. Please confirm before then.
                    </div>
                </div>
            </div>

            <!-- Submission Details -->
            <div class="details-box">
                <div class="details-title">
                    <!-- SVG Document Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        width="20" height="20">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Submission Details
                </div>

                {{-- <div class="detail-item">
                    <span class="detail-label">Submission ID:</span>
                    <span class="detail-value">#{{ substr(md5($submission->id), 0, 10) }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Submitted At:</span>
                    <span class="detail-value">{{ date('F j, Y g:i A', strtotime($submission->created_at)) }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Survey:</span>
                    <span class="detail-value">EBO Staff Satisfaction Survey 2025</span>
                </div> --}}
            </div>

            <!-- Security Notice -->
            <div class="security-notice">
                <div class="security-icon">
                    <!-- SVG Shield Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div class="security-text">
                    <div class="security-title">🔒 Security Notice</div>
                    <div class="security-desc">
                        If you did not initiate this submission or do not recognize this survey request,
                        please disregard this email. No action is required on your part.
                    </div>
                </div>
            </div>

            <p style="margin-top: 25px; color: #4a5568; line-height: 1.7;">
                Your feedback is valuable to us and will help guide improvements to our workplace environment,
                staff support systems, and organizational culture.
            </p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p class="footer-text">
                Thank you for your participation in making EBO a better place to work.
            </p>

            <div class="footer-divider"></div>

            <p style="color: #2c3e50; font-weight: 600; margin-bottom: 10px;">
                Regards,<br>
                <span style="color: #0a58ca;">EBO Human Resources Team</span>
            </p>

            <div class="contact-info">
                <p style="margin-bottom: 5px;">For questions or assistance, please contact:</p>
                <p>
                    📧 <a href="mailto:hr@ebo.org" class="contact-link">hr@ebo.org</a> |
                    📞 <a href="tel:+12345678900" class="contact-link">+1 (234) 567-8900</a>
                </p>
            </div>

            <div class="footer-divider"></div>

            <p style="font-size: 12px; color: #94a3b8; margin-top: 15px;">
                © 2025 EBO Staff Satisfaction Survey. All rights reserved.<br>
                This is an automated email. Please do not reply to this message.
            </p>
        </div>
    </div>
</body>

</html>
