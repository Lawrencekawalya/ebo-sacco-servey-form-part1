<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">

    {{-- Submission Info --}}
    <div>
        <h4
            style="margin-bottom: 15px; color: var(--color-primary); font-weight: 600; border-bottom: 2px solid var(--color-primary-light); padding-bottom: 8px;">
            <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
            Submission Information
        </h4>
        <div
            style="background: white; padding: 25px; border-radius: var(--radius-md); border: 1px solid var(--gray-border); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div class="info-row"
                style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid var(--gray-light);">
                <span style="color: var(--gray-medium); font-weight: 500;">
                    <i class="fas fa-envelope" style="margin-right: 10px; width: 20px; color: var(--color-primary);"></i>
                    Email
                </span>
                <strong style="color: var(--color-primary); font-weight: 600;">{{ $submission->email }}</strong>
            </div>

            <div class="info-row"
                style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid var(--gray-light);">
                <span style="color: var(--gray-medium); font-weight: 500;">
                    <i class="fas fa-calendar-alt"
                        style="margin-right: 10px; width: 20px; color: var(--color-primary);"></i>
                    Submitted
                </span>
                <strong style="color: var(--gray-dark);">{{ $submission->created_at->format('M d, Y h:i A') }}</strong>
            </div>

            <div class="info-row"
                style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
                <span style="color: var(--gray-medium); font-weight: 500;">
                    <i class="fas fa-flag" style="margin-right: 10px; width: 20px; color: var(--color-primary);"></i>
                    Status
                </span>
                <span class="status-badge {{ $submission->status }}"
                    style="padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                    {{ ucfirst($submission->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Key Metrics --}}
    <div>
        <h4
            style="margin-bottom: 15px; color: var(--color-primary); font-weight: 600; border-bottom: 2px solid var(--color-primary-light); padding-bottom: 8px;">
            <i class="fas fa-chart-bar" style="margin-right: 8px;"></i>
            Key Metrics
        </h4>
        <div
            style="background: white; padding: 25px; border-radius: var(--radius-md); border: 1px solid var(--gray-border); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

            <div class="metric-card"
                style="background: linear-gradient(135deg, #e8f4fd 0%, #d1e9fa 100%); border-left: 4px solid #0a58ca; padding: 18px; border-radius: 8px; margin-bottom: 15px;">
                <div
                    style="font-size: 12px; color: #2c5282; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px;">
                    <i class="fas fa-smile" style="margin-right: 6px;"></i>
                    Overall Satisfaction
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">
                    {{ ucwords(str_replace('_', ' ', $submission->answers['q8'] ?? 'N/A')) }}
                </div>
                @if (isset($submission->answers['q8_reason']))
                    <div style="font-size: 13px; color: #4a5568; margin-top: 8px; font-style: italic;">
                        "{{ Str::limit($submission->answers['q8_reason'], 80) }}"
                    </div>
                @endif
            </div>

            <div class="metric-card"
                style="background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%); border-left: 4px solid #00A448; padding: 18px; border-radius: 8px;">
                <div
                    style="font-size: 12px; color: #276749; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px;">
                    <i class="fas fa-user-tie" style="margin-right: 6px;"></i>
                    Manager Support
                </div>
                <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">
                    {{ ucwords(str_replace('_', ' ', $submission->answers['q1'] ?? 'N/A')) }}
                </div>
                @if (isset($submission->answers['q1_reason']))
                    <div style="font-size: 13px; color: #4a5568; margin-top: 8px; font-style: italic;">
                        "{{ Str::limit($submission->answers['q1_reason'], 80) }}"
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Detailed Responses --}}
    <div style="grid-column: 1 / -1;">
        <h4
            style="margin-bottom: 20px; color: var(--color-primary); font-weight: 600; border-bottom: 2px solid var(--color-primary-light); padding-bottom: 8px;">
            <i class="fas fa-list-alt" style="margin-right: 8px;"></i>
            Detailed Responses
        </h4>

        <div
            style="background: white; padding: 30px; border-radius: var(--radius-md); border: 1px solid var(--gray-border); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 25px;">

                @php
                    // Group questions by category for better organization
                    $categories = [
                        'Management & Support' => ['q1', 'q2', 'q3', 'q4'],
                        'Growth & Development' => ['q5', 'q6', 'q7'],
                        'Organizational Culture' => ['q8', 'q9', 'q10', 'q11'],
                        'Work Environment' => ['q3', 'q4'],
                    ];

                    $questionLabels = config('survey_questions');
                    $questionMap = [];
                    foreach ($questionLabels as $item) {
                        if (isset($item['key']) && !str_contains($item['key'], '_reason')) {
                            $questionMap[$item['key']] = $item['label'] ?? $item['key'];
                        }
                    }
                @endphp

                @foreach ($categories as $category => $questions)
                    <div class="category-card"
                        style="background: #f8fafc; border-radius: 10px; padding: 20px; border: 1px solid #e2e8f0;">
                        <h5
                            style="color: #2d3748; font-weight: 600; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #cbd5e0;">
                            <i class="fas fa-folder" style="margin-right: 10px; color: #4a5568;"></i>
                            {{ $category }}
                        </h5>

                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            @foreach ($questions as $q)
                                @if (isset($submission->answers[$q]))
                                    <div class="response-item"
                                        style="background: white; padding: 15px; border-radius: 6px; border-left: 3px solid #4299e1;">
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                            <div style="font-size: 14px; color: #4a5568; font-weight: 500;">
                                                {{ $questionMap[$q] ?? strtoupper($q) }}
                                            </div>
                                            <div style="font-weight: 600; color: #2d3748; font-size: 16px;">
                                                {{ ucwords(str_replace('_', ' ', $submission->answers[$q])) }}
                                            </div>
                                        </div>

                                        @if (isset($submission->answers[$q . '_reason']) && !empty($submission->answers[$q . '_reason']))
                                            <div
                                                style="font-size: 13px; color: #718096; background: #f7fafc; padding: 10px; border-radius: 4px; margin-top: 8px; border-left: 2px solid #cbd5e0;">
                                                <div style="font-weight: 500; color: #4a5568; margin-bottom: 4px;">
                                                    <i class="fas fa-comment-alt" style="margin-right: 5px;"></i>Reason:
                                                </div>
                                                {{ $submission->answers[$q . '_reason'] }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{-- Open Feedback Section --}}
    <div style="grid-column: 1 / -1;">
        <h4
            style="margin-bottom: 20px; color: var(--color-primary); font-weight: 600; border-bottom: 2px solid var(--color-primary-light); padding-bottom: 8px;">
            <i class="fas fa-comments" style="margin-right: 8px;"></i>
            Open Feedback
        </h4>

        <div
            style="background: white; padding: 30px; border-radius: var(--radius-md); border: 1px solid var(--gray-border); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

            {{-- What they like about EBO --}}
            @if (isset($submission->answers['q12']))
                <div class="feedback-section" style="margin-bottom: 30px;">
                    <div style="display: flex; align-items: center; margin-bottom: 15px; color: #2d3748;">
                        <div
                            style="width: 32px; height: 32px; background: #38b2ac; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                            <i class="fas fa-heart" style="color: white; font-size: 16px;"></i>
                        </div>
                        <h5 style="margin: 0; font-weight: 600;">What they like about EBO</h5>
                    </div>
                    <div
                        style="background: #f0fff4; padding: 20px; border-radius: 8px; border: 1px solid #c6f6d5; white-space: pre-line; word-break: break-word;">
                        {{ $submission->answers['q12'] }}
                    </div>
                </div>
            @endif

            {{-- Areas for Improvement --}}
            <div class="feedback-section" style="margin-bottom: 30px;">
                <div style="display: flex; align-items: center; margin-bottom: 15px; color: #2d3748;">
                    <div
                        style="width: 32px; height: 32px; background: #f56565; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <i class="fas fa-exclamation-triangle" style="color: white; font-size: 16px;"></i>
                    </div>
                    <h5 style="margin: 0; font-weight: 600;">Areas for Improvement</h5>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                    @for ($i = 1; $i <= 3; $i++)
                        @if (isset($submission->answers['q13_' . $i]) && !empty($submission->answers['q13_' . $i]))
                            <div
                                style="background: #fff5f5; padding: 18px; border-radius: 8px; border: 1px solid #fed7d7; position: relative;">
                                <div
                                    style="position: absolute; top: -10px; left: -10px; width: 24px; height: 24px; background: #f56565; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12px;">
                                    {{ $i }}
                                </div>
                                <div style="font-size: 14px; color: #742a2a;">
                                    {{ $submission->answers['q13_' . $i] }}
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>

            {{-- Suggestions --}}
            <div class="feedback-section" style="margin-bottom: 30px;">
                <div style="display: flex; align-items: center; margin-bottom: 15px; color: #2d3748;">
                    <div
                        style="width: 32px; height: 32px; background: #4299e1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <i class="fas fa-lightbulb" style="color: white; font-size: 16px;"></i>
                    </div>
                    <h5 style="margin: 0; font-weight: 600;">Suggestions</h5>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                    @for ($i = 1; $i <= 3; $i++)
                        @if (isset($submission->answers['q14_' . $i]) && !empty($submission->answers['q14_' . $i]))
                            <div
                                style="background: #ebf8ff; padding: 18px; border-radius: 8px; border: 1px solid #bee3f8; position: relative;">
                                <div
                                    style="position: absolute; top: -10px; left: -10px; width: 24px; height: 24px; background: #4299e1; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12px;">
                                    {{ $i }}
                                </div>
                                <div style="font-size: 14px; color: #2c5282;">
                                    {{ $submission->answers['q14_' . $i] }}
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>

            {{-- Additional Comments --}}
            @if (isset($submission->answers['q15']) && !empty($submission->answers['q15']))
                <div class="feedback-section">
                    <div style="display: flex; align-items: center; margin-bottom: 15px; color: #2d3748;">
                        <div
                            style="width: 32px; height: 32px; background: #9f7aea; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                            <i class="fas fa-sticky-note" style="color: white; font-size: 16px;"></i>
                        </div>
                        <h5 style="margin: 0; font-weight: 600;">Additional Comments</h5>
                    </div>
                    <div
                        style="background: #faf5ff; padding: 20px; border-radius: 8px; border: 1px solid #e9d8fd; white-space: pre-line; word-break: break-word;">
                        {{ $submission->answers['q15'] }}
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>

<style>
    /* Add status badge colors */
    .status-badge.pending {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fbbf24;
    }

    .status-badge.confirmed {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #34d399;
    }

    .status-badge.submitted {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #60a5fa;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }

        .category-card {
            grid-column: 1 !important;
        }
    }
</style>
