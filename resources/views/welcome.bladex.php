<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Satisfaction Survey</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        header,
        footer {
            background: #ffffff;
            text-align: center;
            padding: 0;
        }

        header img {
            max-height: 200px;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 6px;
        }

        #progress {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        h2 {
            border-bottom: 2px solid #e5e5e5;
            padding-bottom: 8px;
        }

        .question {
            margin-bottom: 25px;
        }

        .question label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .options-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        textarea {
            width: 100%;
            min-height: 80px;
            margin-top: 10px;
            padding: 8px;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        button {
            background: #0a58ca;
            color: #fff;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        button.secondary {
            background: #6c757d;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <header>
        <img src="{{ asset('images/logo.png') }}" alt="Organization Logo">
    </header>

    <div class="container">

        <!-- Progress Indicator -->
        <div id="progress">Step 1 of 4</div>

        <form method="POST" action="{{ route('savings-submissions.store') }}">
            @csrf

            <!-- STEP 0: EMAIL -->
            <div class="form-step active">
                <h2>Before we begin</h2>
                <p>Please enter your official SACCO email address.</p>

                <div class="question">
                    <label>Email address</label>
                    <input type="email" name="email" placeholder="example@ebo.co.ug">
                </div>

                <div class="buttons">
                    <span></span>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- STEP 1: SECTION A -->
            <div class="form-step">
                <h2>Section A: Work & Management</h2>

                <div class="question">
                    <label>1. I believe my manager cares about my concerns.</label>
                    <div class="options-row">
                        <label><input type="radio" name="q1" value="strongly_disagree"> Strongly disagree</label>
                        <label><input type="radio" name="q1" value="disagree"> Disagree</label>
                        <label><input type="radio" name="q1" value="agree"> Agree</label>
                        <label><input type="radio" name="q1" value="strongly_agree"> Strongly agree</label>
                    </div>
                </div>

                <div class="buttons">
                    <button type="button" class="secondary" onclick="prevStep()">Previous</button>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- STEP 2: SECTION B -->
            <div class="form-step">
                <h2>Section B: Experience & Satisfaction</h2>

                <div class="question">
                    <label>How satisfied are you working for EBO?</label>
                    <div class="options-row">
                        <label><input type="radio" name="q9" value="very_satisfied"> Very satisfied</label>
                        <label><input type="radio" name="q9" value="satisfied"> Satisfied</label>
                        <label><input type="radio" name="q9" value="dissatisfied"> Dissatisfied</label>
                        <label><input type="radio" name="q9" value="very_dissatisfied"> Very dissatisfied</label>
                    </div>
                </div>

                <div class="buttons">
                    <button type="button" class="secondary" onclick="prevStep()">Previous</button>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- STEP 3: SECTION C -->
            <div class="form-step">
                <h2>Section C: Open Feedback</h2>

                <div class="question">
                    <label>What do you like about EBO?</label>
                    <textarea name="q6"></textarea>
                </div>

                <div class="question">
                    <label>Any further information you feel is relevant?</label>
                    <textarea name="q15"></textarea>
                </div>

                <div class="buttons">
                    <button type="button" class="secondary" onclick="prevStep()">Previous</button>
                    <button type="submit">Submit Survey</button>
                </div>
            </div>
        </form>
    </div>

    <footer>
        <p style="padding:15px;font-size:14px;color:#555;">
            Thank you for taking your time to complete this survey.
            Your honest feedback is valued and will guide management in improving the work environment.
        </p>
    </footer>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll('.form-step');
        const progress = document.getElementById('progress');

        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle('active', i === index);
            });
            progress.textContent = `Step ${index + 1} of ${steps.length}`;
        }

        function validateStep(index) {
            const step = steps[index];

            // Step 0: email required
            if (index === 0) {
                const email = step.querySelector('input[type="email"]');
                return email && email.value.trim() !== '';
            }

            // Other steps: each radio group must be answered
            const radios = step.querySelectorAll('input[type="radio"]');
            if (radios.length === 0) return true;

            const groups = {};
            radios.forEach(radio => {
                if (!groups[radio.name]) groups[radio.name] = false;
                if (radio.checked) groups[radio.name] = true;
            });

            return Object.values(groups).every(v => v === true);
        }

        function nextStep() {
            if (!validateStep(currentStep)) {
                alert('Please answer all required questions before continuing.');
                return;
            }
            if (currentStep < steps.length - 1) {
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

        showStep(currentStep);
    </script>

</body>

</html>