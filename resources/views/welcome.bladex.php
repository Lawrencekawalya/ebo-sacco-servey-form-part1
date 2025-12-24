<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Satisfaction Survey 2025 - EBO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: "Raleway", sans-serif;
            font-optical-sizing: auto;
            background: #f4f6f8;
            margin: 0;
            color: #333;
        }

        header {
            background: #ffffff;
            text-align: center;
            padding: 0px 0;
            /* border-bottom: 3px solid #0a58ca; */
            border-bottom: 3px solid #00A448;
        }

        header img {
            max-height: 100px;
            margin-bottom: 10px;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        #progress-container {
            margin-bottom: 30px;
            background: #e9ecef;
            border-radius: 4px;
            padding: 10px;
        }

        #progress-bar {
            height: 8px;
            background: #00A448;
            /* background: #0a58ca; */
            border-radius: 4px;
            width: 0%;
            transition: width 0.3s ease;
        }

        #progress-text {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }

        .form-step {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-step.active {
            display: block;
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #e5e5e5;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        h3 {
            color: #34495e;
            margin: 20px 0 15px;
            font-size: 18px;
        }

        .question {
            margin-bottom: 30px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #00A448;
        }

        .question label {
            font-weight: bold;
            display: block;
            margin-bottom: 12px;
            color: #2c3e50;
        }

        .options-row {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .options-row label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background 0.2s;
            font-weight: normal;
        }

        .options-row label:hover {
            background: #e9ecef;
        }

        .options-row input[type="radio"] {
            margin-right: 8px;
        }

        .options-row input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 200px;
        }

        textarea {
            width: 100%;
            min-height: 100px;
            margin-top: 10px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            resize: vertical;
        }

        textarea:focus {
            outline: none;
            border-color: #0a58ca;
            box-shadow: 0 0 0 2px rgba(10, 88, 202, 0.1);
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        button {
            background: #0a58ca;
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background 0.3s ease;
            font-weight: bold;
        }

        button:hover {
            background: #084298;
        }

        button.secondary {
            background: #6c757d;
        }

        button.secondary:hover {
            background: #5a6268;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 10px;
            display: none;
        }

        .error.active {
            display: block;
        }

        .question-number {
            display: inline-block;
            background: #00A448;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            margin-right: 10px;
            font-size: 14px;
        }

        .question-required {
            color: #dc3545;
        }

        .section-description {
            color: #6c757d;
            margin-bottom: 25px;
            font-style: italic;
        }

        .highlight-box {
            background: #e8f4fd;
            border: 1px solid #b6d4fe;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }

        .highlight-box-danger {
            background: #fde8e8;
            border: 1px solid #feb7b6;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }

        .multiple-inputs {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .multiple-inputs input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 15px;
            }

            .options-row {
                flex-direction: column;
                gap: 10px;
            }

            button {
                padding: 10px 20px;
                width: 100%;
                margin-bottom: 10px;
            }

            .buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <header style="padding-top: 20px">
        <img src="{{ asset('images/logo.png') }}" alt="EBO Logo">
        <h1>Staff Satisfaction Survey 2025</h1>
        {{-- <form method="POST" action="{{ route('logout') }}"> @csrf <button type="submit"> Logout </button> </form>
        --}}
    </header>

    <div class="container">

        @if (session()->has('error'))
        <div class="highlight-box-danger">
            <p>{{ session()->get('error') }}</p>
        </div>
        @endif

        <!-- Progress Bar -->
        <div id="progress-container">
            <div id="progress-text">Step 1 of 6</div>
            <div id="progress-bar"></div>
        </div>

        <form method="POST" action="{{ route('savings-submissions.store') }}" id="surveyForm">
            @csrf

            <!-- STEP 0: EMAIL VERIFICATION -->
            {{-- <div class="form-step active">
                <h2>Before We Begin</h2>
                <div class="highlight-box">
                    <p>Please enter your <strong style="text-decoration: underline">correct official EBO email
                            address</strong>
                        to start the survey. Your responses
                        will be kept
                        confidential.</p>
                </div>

                <div class="question">
                    <label><span class="question-number">1</span> Email Address <span
                            class="question-required">*</span></label>
                    <input type="email" name="email" placeholder="your.name@ebo.co.ug" required>
                    <div class="error" id="email-error">Please enter a valid email address</div>
                </div>

                <div class="buttons">
                    <span></span>
                    <button type="button" onclick="nextStep()">Start Survey</button>
                    <button type="button" onclick="checkEmailAndProceed()">Start Survey</button>
                </div>
            </div> --}}

            <!-- STEP 1: MANAGEMENT & SUPPORT -->
            <div class="form-step">
                <h2>Management & Support</h2>
                <div class="section-description">This section asks about your experience with management and support
                    systems.</div>

                <div class="question">
                    <label><span class="question-number">1</span> I believe my manager cares about my concerns.</label>
                    <div class="options-row">
                        <label><input type="radio" name="q1" value="strongly_disagree" required> Strongly
                            disagree</label>
                        <label><input type="radio" name="q1" value="disagree"> Disagree</label>
                        <label><input type="radio" name="q1" value="agree"> Agree</label>
                        <label><input type="radio" name="q1" value="strongly_agree"> Strongly agree</label>
                    </div>
                    <textarea name="q1_reason" placeholder="Reasons for above (optional)"></textarea>
                </div>

                <div class="question">
                    <label><span class="question-number">2</span> I feel genuinely appreciated at EBO.</label>
                    <div class="options-row">
                        <label><input type="radio" name="q2" value="strongly_agree" required> Strongly
                            Agree</label>
                        <label><input type="radio" name="q2" value="agree"> Agree</label>
                        <label><input type="radio" name="q2" value="disagree"> Disagree</label>
                        <label><input type="radio" name="q2" value="strongly_disagree"> Strongly Disagree</label>
                    </div>
                    <textarea name="q2_reason" placeholder="Reasons for above (optional)"></textarea>
                </div>

                <div class="buttons">
                    <button type="button" class="secondary" onclick="prevStep()">Previous</button>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- STEP 2: WORK ENVIRONMENT -->
            <div class="form-step">
                <h2>Work Environment</h2>
                <div class="section-description">Questions about your daily work experience and environment.</div>

                <div class="question">
                    <label><span class="question-number">3</span> How often do you feel stressed by work?</label>
                    <div class="options-row">
                        <label><input type="radio" name="q3" value="always" required> Always</label>
                        <label><input type="radio" name="q3" value="sometimes"> Sometimes</label>
                        <label><input type="radio" name="q3" value="rarely"> Rarely</label>
                        <label><input type="radio" name="q3" value="never"> Never</label>
                    </div>
                    <textarea name="q3_reason" placeholder="Reasons for above (optional)"></textarea>
                </div>

                <div class="question">
                    <label><span class="question-number">4</span> How often are your suggestions at work taken
                        seriously
                        at your work station?</label>
                    <div class="options-row">
                        <label><input type="radio" name="q4" value="always" required> Always</label>
                        <label><input type="radio" name="q4" value="sometimes"> Sometimes</label>
                        <label><input type="radio" name="q4" value="rarely"> Rarely</label>
                        <label><input type="radio" name="q4" value="never"> Never</label>
                    </div>
                    <textarea name="q4_reason" placeholder="Reasons for above (optional)"></textarea>
                </div>

                <div class="buttons">
                    <button type="button" class="secondary" onclick="prevStep()">Previous</button>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- STEP 3: GROWTH & DEVELOPMENT -->
            <div class="form-step">
                <h2>Growth & Development</h2>
                <div class="section-description">Questions about career opportunities and professional growth.</div>

                <div class="question">
                    <label><span class="question-number">5</span> Does your organization offer ample career growth
                        opportunities to you?</label>
                    <div class="options-row">
                        <label><input type="radio" name="q5" value="yes" required> Yes</label>
                        <label><input type="radio" name="q5" value="no"> No</label>
                        <label><input type="radio" name="q5" value="other"> Other</label>
                    </div>
                    <textarea name="q5_reason" placeholder="Please elaborate (optional)"></textarea>
                </div>

                <div class="question">
                    <label><span class="question-number">6</span> Do you have the tools and support needed to do your
                        job well?</label>
                    <div class="options-row">
                        <label><input type="radio" name="q6" value="yes" required> Yes</label>
                        <label><input type="radio" name="q6" value="no"> No</label>
                    </div>
                    <textarea name="q6_reason" placeholder="Reasons for the above (optional)"></textarea>
                </div>

                <div class="question">
                    <label><span class="question-number">7</span> I receive constructive feedback that helps me
                        improve at my workplace.</label>
                    <div class="options-row">
                        <label><input type="radio" name="q7" value="yes" required> Yes</label>
                        <label><input type="radio" name="q7" value="no"> No</label>
                    </div>
                    <textarea name="q7_reason" placeholder="Reasons for the above (optional)"></textarea>
                </div>

                <div class="buttons">
                    <button type="button" class="secondary" onclick="prevStep()">Previous</button>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- STEP 4: ORGANIZATIONAL CULTURE -->
            <div class="form-step">
                <h2>Organizational Culture</h2>
                <div class="section-description">Questions about EBO's culture, direction, and recognition.</div>

                <div class="question">
                    <label><span class="question-number">8</span> How satisfied are you working for EBO?</label>
                    <div class="options-row">
                        <label><input type="radio" name="q8" value="very_satisfied" required> Very
                            satisfied</label>
                        <label><input type="radio" name="q8" value="satisfied"> Satisfied</label>
                        <label><input type="radio" name="q8" value="dissatisfied"> Dissatisfied</label>
                        <label><input type="radio" name="q8" value="very_dissatisfied"> Very
                            dissatisfied</label>
                    </div>
                    <textarea name="q8_reason" placeholder="Reasons for above (optional)"></textarea>
                </div>

                <div class="question">
                    <label><span class="question-number">9</span> I believe EBO is going in the right
                        direction.</label>
                    <div class="options-row">
                        <label><input type="radio" name="q9" value="strongly_agree" required> Strongly
                            agree</label>
                        <label><input type="radio" name="q9" value="agree"> Agree</label>
                        <label><input type="radio" name="q9" value="disagree"> Disagree</label>
                        <label><input type="radio" name="q9" value="strongly_disagree"> Strongly
                            Disagree</label>
                    </div>
                    <textarea name="q9_reason" placeholder="Reasons for above (optional)"></textarea>
                </div>

                <div class="question">
                    <label><span class="question-number">10</span> Do you feel the culture transformation project has
                        made any impact on EBO?</label>
                    <div class="options-row">
                        <label><input type="radio" name="q10" value="yes" required> Yes</label>
                        <label><input type="radio" name="q10" value="no"> No</label>
                    </div>
                    <textarea name="q10_reason" placeholder="Reasons for the above (optional)"></textarea>
                </div>

                <div class="question">
                    <label><span class="question-number">11</span> Do you feel good performance is recognized and
                        appreciated?</label>
                    <div class="options-row">
                        <label><input type="radio" name="q11" value="yes" required> Yes</label>
                        <label><input type="radio" name="q11" value="no"> No</label>
                    </div>
                    <textarea name="q11_reason" placeholder="Reasons for the above (optional)"></textarea>
                </div>

                <div class="buttons">
                    <button type="button" class="secondary" onclick="prevStep()">Previous</button>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- STEP 5: OPEN FEEDBACK -->
            <div class="form-step">
                <h2>Open Feedback</h2>
                <div class="section-description">Your detailed feedback helps us improve. Please be candid.</div>

                <div class="question">
                    <label><span class="question-number">12</span> What do you like about EBO?</label>
                    <textarea name="q12"
                        placeholder="Please share what you appreciate about working at EBO..."></textarea>
                </div>

                <div class="question">
                    <label><span class="question-number">13</span> Enlist three things you are extremely dissatisfied
                        about at EBO</label>
                    <div class="multiple-inputs">
                        <input type="text" name="q13_1" placeholder="1. First point of dissatisfaction">
                        <input type="text" name="q13_2" placeholder="2. Second point of dissatisfaction">
                        <input type="text" name="q13_3" placeholder="3. Third point of dissatisfaction">
                    </div>
                </div>

                <div class="question">
                    <label><span class="question-number">14</span> What are the three things you would like to suggest
                        to make EBO's functionality better?</label>
                    <div class="multiple-inputs">
                        <input type="text" name="q14_1" placeholder="1. First suggestion">
                        <input type="text" name="q14_2" placeholder="2. Second suggestion">
                        <input type="text" name="q14_3" placeholder="3. Third suggestion">
                    </div>
                </div>

                <div class="question">
                    <label><span class="question-number">15</span> Any further information you feel relevant</label>
                    <textarea name="q15" placeholder="Any other comments, suggestions, or feedback..."></textarea>
                </div>

                <div class="highlight-box">
                    <p><strong>Thank you for your honest feedback!</strong> Your responses will help guide management in
                        improving the work environment and staff support.</p>
                </div>

                <div class="buttons">
                    <button type="button" class="secondary" onclick="prevStep()">Previous</button>
                    <button type="submit">Submit Survey</button>
                </div>
            </div>
        </form>
    </div>

    <footer>
        <p style="padding:15px;font-size:14px;color:#555;text-align:center;">
            <strong>STAFF SATISFACTION SURVEY 2025</strong>
            <br>
            <br>
            EBO - Confidential Feedback System
        </p>
    </footer>

    <script>
        async function checkEmailAndProceed() {
            const step = steps[0];
            const emailInput = step.querySelector('input[type="email"]');
            const emailError = step.querySelector('#email-error');

            const email = emailInput.value.trim().toLowerCase();

            if (!isValidEmail(email)) {
                emailError.textContent = 'Please enter a valid email address.';
                emailError.classList.add('active');
                return;
            }

            if (!isAllowedDomain(email)) {
                emailError.textContent = 'Please use your official EBO email address (@ebo.co.ug).';
                emailError.classList.add('active');
                return;
            }

            emailError.classList.remove('active');

            try {
                const response = await fetch("{{ route('submission.check-email') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        email
                    }),
                });

                const data = await response.json();

                if (data.status === 'confirmed') {
                    window.location.href = "{{ route('submission.confirmation-result') }}";
                    return;
                }

                if (data.status === 'pending') {
                    window.location.href = "{{ route('submission.email-sent') }}";
                    return;
                }

                // status === new
                currentStep++;
                showStep(currentStep);

            } catch (error) {
                alert('Unable to verify email at the moment. Please try again.');
            }
        }


        let currentStep = 0;
        const steps = document.querySelectorAll('.form-step');
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        const totalSteps = steps.length;

        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle('active', i === index);
            });

            // Update progress bar
            const progressPercentage = ((index + 1) / totalSteps) * 100;
            progressBar.style.width = `${progressPercentage}%`;
            progressText.textContent = `Step ${index + 1} of ${totalSteps}`;

            // Scroll to top on step change
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function validateStep(index) {
            const step = steps[index];
            let isValid = true;

            // Clear previous errors
            step.querySelectorAll('.error').forEach(error => {
                error.classList.remove('active');
            });

            // Validate email step
            if (index === 0) {
                const email = step.querySelector('input[type="email"]');
                const emailError = step.querySelector('#email-error');

                const value = email.value.trim().toLowerCase();

                if (!value || !isValidEmail(value)) {
                    emailError.textContent = 'Please enter a valid email address.';
                    emailError.classList.add('active');
                    email.style.borderColor = '#dc3545';
                    return false;
                }

                if (!isAllowedDomain(value)) {
                    emailError.textContent = 'Please use your official EBO email address (@ebo.co.ug).';
                    emailError.classList.add('active');
                    email.style.borderColor = '#dc3545';
                    return false;
                }

                emailError.classList.remove('active');
                email.style.borderColor = '#0a58ca';
                return true;
            }


            // Validate radio groups in other steps
            const radioGroups = {};
            step.querySelectorAll('input[type="radio"]').forEach(radio => {
                if (!radioGroups[radio.name]) {
                    radioGroups[radio.name] = false;
                }
                if (radio.checked) {
                    radioGroups[radio.name] = true;
                }
            });

            // Check if all required radio groups are answered
            Object.keys(radioGroups).forEach(groupName => {
                if (!radioGroups[groupName]) {
                    isValid = false;
                    // Highlight the first radio in the unanswered group
                    const firstRadio = step.querySelector(`input[name="${groupName}"]`);
                    if (firstRadio) {
                        const question = firstRadio.closest('.question');
                        if (question) {
                            question.style.borderLeftColor = '#dc3545';
                            question.style.backgroundColor = '#f8d7da';
                        }
                    }
                }
            });

            if (!isValid) {
                alert('Please answer all required questions before continuing.');
                return false;
            }

            return true;
        }

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function isAllowedDomain(email) {
            return email.toLowerCase().endsWith('@ebo.co.ug');
        }

        function nextStep() {
            if (!validateStep(currentStep)) {
                return;
            }

            if (currentStep < totalSteps - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        // Initialize
        showStep(currentStep);

        // Reset question styles when radios are clicked
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const question = this.closest('.question');
                if (question) {
                    question.style.borderLeftColor = '#0a58ca';
                    question.style.backgroundColor = '#f8f9fa';
                }
            });
        });

        // Handle form submission
        document.getElementById('surveyForm').addEventListener('submit', function (e) {
            if (!validateStep(currentStep)) {
                e.preventDefault();
                alert('Please complete all required questions before submitting.');
            } else {
                // Add loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = 'Submitting...';
                    submitBtn.disabled = true;
                }
            }
        });
    </script>

</body>

</html>