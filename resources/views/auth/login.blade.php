<x-guest-layout>
    <div style="max-width: 450px; margin: 0 auto; padding: 40px 20px;">

        <!-- Header Section -->
        <div style="text-align: center; margin-bottom: 40px;">
            <div style="margin-bottom: 20px;">
                <!-- You can add your logo here -->
                <img src="{{ asset('images/logo.png') }}" alt="EBO Logo">
                {{-- <div
                    style="width: 80px; height: 80px; background: linear-gradient(135deg, #00A448 0%, #0a58ca 100%); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-lock" style="color: white; font-size: 32px;"></i>
                </div> --}}
                <h1 style="color: #2c3e50; font-size: 28px; font-weight: 700; margin-bottom: 8px;">
                    Welcome Back
                </h1>
                <p style="color: #718096; font-size: 15px;">
                    Sign in to access your dashboard
                </p>
            </div>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div
                style="background: linear-gradient(135deg, #e8f4fd 0%, #d1e9fa 100%); border-left: 4px solid #0a58ca; padding: 16px; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: flex-start;">
                <i class="fas fa-info-circle"
                    style="color: #0a58ca; font-size: 18px; margin-right: 12px; margin-top: 2px;"></i>
                <div>
                    <p style="color: #2c3e50; margin: 0; font-weight: 500; font-size: 14px;">
                        {{ session('status') }}
                    </p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div
                style="background: linear-gradient(135deg, #fde8e8 0%, #fecaca 100%); border-left: 4px solid #dc3545; padding: 16px; border-radius: 8px; margin-bottom: 25px;">
                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                    <i class="fas fa-exclamation-triangle"
                        style="color: #dc3545; font-size: 18px; margin-right: 12px;"></i>
                    <h3 style="color: #dc3545; margin: 0; font-size: 16px; font-weight: 600;">Authentication Error</h3>
                </div>
                <ul style="margin: 0; padding-left: 20px; color: #742a2a; font-size: 14px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <div
            style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 40px;">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div style="margin-bottom: 25px;">
                    <label for="email"
                        style="display: block; color: #4a5568; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                        <i class="fas fa-envelope" style="margin-right: 8px; color: #718096;"></i>
                        Email Address
                    </label>
                    <div style="position: relative;">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username"
                            style="
                                width: 100%;
                                padding: 14px 16px 14px 44px;
                                border: 2px solid #e2e8f0;
                                border-radius: 8px;
                                font-size: 15px;
                                color: #2d3748;
                                background: #f8fafc;
                                transition: all 0.3s ease;
                            "
                            placeholder="your.email@ebo.co.ug"
                            onfocus="this.style.borderColor='#0a58ca'; this.style.background='white';"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                        <i class="fas fa-user-circle"
                            style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #a0aec0; font-size: 18px;"></i>
                    </div>
                    @error('email')
                        <p style="color: #e53e3e; font-size: 13px; margin-top: 6px; margin-left: 8px;">
                            <i class="fas fa-exclamation-circle" style="margin-right: 4px;"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 20px;">
                    <label for="password"
                        style="display: block; color: #4a5568; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                        <i class="fas fa-key" style="margin-right: 8px; color: #718096;"></i>
                        Password
                    </label>
                    <div style="position: relative;">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            style="
                                width: 100%;
                                padding: 14px 16px 14px 44px;
                                border: 2px solid #e2e8f0;
                                border-radius: 8px;
                                font-size: 15px;
                                color: #2d3748;
                                background: #f8fafc;
                                transition: all 0.3s ease;
                            "
                            placeholder="Enter your password"
                            onfocus="this.style.borderColor='#0a58ca'; this.style.background='white';"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                        <i class="fas fa-lock"
                            style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #a0aec0; font-size: 18px;"></i>
                        <button type="button" id="togglePassword"
                            style="
                                position: absolute;
                                right: 16px;
                                top: 50%;
                                transform: translateY(-50%);
                                background: none;
                                border: none;
                                color: #718096;
                                cursor: pointer;
                                font-size: 16px;
                            "
                            onclick="togglePasswordVisibility()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p style="color: #e53e3e; font-size: 13px; margin-top: 6px; margin-left: 8px;">
                            <i class="fas fa-exclamation-circle" style="margin-right: 4px;"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 10px 0;">
                    <label for="remember_me" style="display: flex; align-items: center; cursor: pointer;">
                        <div style="position: relative;">
                            <input id="remember_me" type="checkbox" name="remember"
                                style="
                                    width: 18px;
                                    height: 18px;
                                    cursor: pointer;
                                    position: relative;
                                    z-index: 1;
                                    opacity: 0;
                                ">
                            <div
                                style="
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 18px;
                                height: 18px;
                                background: #f8fafc;
                                border: 2px solid #cbd5e0;
                                border-radius: 4px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            ">
                                <i class="fas fa-check" style="color: white; font-size: 12px; display: none;"></i>
                            </div>
                        </div>
                        <span style="margin-left: 28px; color: #4a5568; font-size: 14px;">
                            Remember me
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            style="
                            color: #0a58ca;
                            text-decoration: none;
                            font-size: 14px;
                            font-weight: 500;
                            transition: color 0.2s ease;
                        "
                            onmouseover="this.style.color='#084298'" onmouseout="this.style.color='#0a58ca'">
                            <i class="fas fa-question-circle" style="margin-right: 6px;"></i>
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    style="
                        width: 100%;
                        background: linear-gradient(135deg, #00A448 0%, #0a58ca 100%);
                        color: white;
                        border: none;
                        padding: 16px;
                        font-size: 16px;
                        font-weight: 600;
                        border-radius: 8px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 12px rgba(10, 88, 202, 0.2);
                    "
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(10, 88, 202, 0.3)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(10, 88, 202, 0.2)';">
                    <i class="fas fa-sign-in-alt" style="margin-right: 10px;"></i>
                    Sign In
                </button>

                <!-- Optional: Social Login or Register Link -->
                <div style="text-align: center; margin-top: 30px; padding-top: 25px; border-top: 1px solid #e2e8f0;">
                    <p style="color: #718096; font-size: 14px; margin-bottom: 20px;">
                        Using company credentials?
                        <br>
                        <span style="font-weight: 600; color: #2c3e50;">@ebo.co.ug emails only</span>
                    </p>

                    <!-- You can add social login buttons here if needed -->
                    <!--
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <button type="button" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 20px; cursor: pointer; flex: 1;">
                            <i class="fab fa-google" style="color: #DB4437; margin-right: 8px;"></i>
                            Google
                        </button>
                        <button type="button" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 20px; cursor: pointer; flex: 1;">
                            <i class="fab fa-microsoft" style="color: #00A4EF; margin-right: 8px;"></i>
                            Microsoft
                        </button>
                    </div>
                    -->
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
            <p style="color: #a0aec0; font-size: 13px;">
                © {{ date('Y') }} EBO - Staff Satisfaction Survey System
                <br>
                <span style="font-size: 12px;">v1.0.0</span>
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const icon = toggleButton.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Custom checkbox behavior
        document.getElementById('remember_me').addEventListener('change', function() {
            const checkIcon = this.parentElement.querySelector('.fa-check');
            if (this.checked) {
                this.parentElement.style.background = '#0a58ca';
                this.parentElement.style.borderColor = '#0a58ca';
                checkIcon.style.display = 'block';
            } else {
                this.parentElement.style.background = '#f8fafc';
                this.parentElement.style.borderColor = '#cbd5e0';
                checkIcon.style.display = 'none';
            }
        });

        // Form validation feedback
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.style.borderColor = '#48bb78';
                } else if (this.value.length > 0) {
                    this.style.borderColor = '#f56565';
                } else {
                    this.style.borderColor = '#e2e8f0';
                }
            });
        });

        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            submitButton.innerHTML =
                '<i class="fas fa-spinner fa-spin" style="margin-right: 10px;"></i> Signing in...';
            submitButton.disabled = true;
            submitButton.style.opacity = '0.8';
            submitButton.style.cursor = 'not-allowed';

            // Re-enable button after 5 seconds if form submission fails
            setTimeout(() => {
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                submitButton.style.opacity = '1';
                submitButton.style.cursor = 'pointer';
            }, 5000);
        });
    </script>

    <style>
        /* Additional styles for better consistency */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 88, 202, 0.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .guest-layout-container {
            animation: fadeIn 0.5s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            div[style*="max-width: 450px"] {
                max-width: 100% !important;
                padding: 20px 15px !important;
            }

            div[style*="padding: 40px;"] {
                padding: 30px 20px !important;
            }
        }
    </style>
</x-guest-layout>
