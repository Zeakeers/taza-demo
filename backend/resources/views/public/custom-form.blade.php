<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $form->title }} - Taman Zakat</title>
    <meta name="description" content="{{ $form->description ?? $form->title }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #EBF1D5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative background circles */
        body::before {
            content: '';
            position: fixed;
            top: -10%;
            right: -10%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(93, 166, 48, 0.06);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -15%;
            left: -10%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(93, 166, 48, 0.04);
            pointer-events: none;
        }

        .form-container {
            max-width: 600px;
            width: 100%;
            position: relative;
            z-index: 10;
        }

        .form-card {
            background: #fff;
            border-radius: 32px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.04);
            padding: 3rem 1.5rem 2.5rem;
            position: relative;
            border: 1px solid rgba(255,255,255,0.5);
        }

        @media (min-width: 640px) {
            .form-card {
                border-radius: 40px;
                padding: 3rem 2.5rem 3rem;
            }
        }

        .logo-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        .logo-wrapper img {
            width: 96px;
            height: 96px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .form-title {
            font-size: 20px;
            font-weight: 700;
            color: #2d7d42;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-align: center;
            line-height: 1.3;
        }

        @media (min-width: 640px) {
            .form-title { font-size: 24px; }
        }

        .form-description {
            text-align: center;
            color: #71717a;
            font-size: 14px;
            margin-top: 8px;
            line-height: 1.5;
        }

        .form-body {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .field-group {
            display: flex;
            flex-direction: column;
        }

        .field-label {
            color: #52525b;
            margin-bottom: 6px;
            margin-left: 4px;
            font-size: 14px;
            font-weight: 500;
        }

        @media (min-width: 640px) {
            .field-label { font-size: 15px; }
        }

        .field-required {
            color: #ef4444;
        }

        .field-input,
        .field-select {
            width: 100%;
            background: #eff4fd;
            border: 1px solid #d2def2;
            color: #27272a;
            border-radius: 18px;
            padding: 0.75rem 1rem;
            min-height: 50px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field-input:focus,
        .field-select:focus {
            border-color: #5DA630;
            box-shadow: 0 0 0 3px rgba(93, 166, 48, 0.15);
        }

        .field-textarea {
            width: 100%;
            background: #eff4fd;
            border: 1px solid #d2def2;
            color: #27272a;
            border-radius: 18px;
            padding: 0.75rem 1rem;
            min-height: 100px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            outline: none;
            resize: vertical;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field-textarea:focus {
            border-color: #5DA630;
            box-shadow: 0 0 0 3px rgba(93, 166, 48, 0.15);
        }

        .field-select {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
            padding-right: 2.5rem;
            display: none;
        }

        .pub-select-wrapper { position: relative; }
        .pub-select-trigger {
            display: flex; align-items: center; justify-content: space-between;
            width: 100%; background: #eff4fd; border: 1px solid #d2def2; color: #27272a;
            border-radius: 18px; padding: 0.75rem 1rem; min-height: 50px;
            font-family: 'Poppins', sans-serif; font-size: 14px;
            cursor: pointer; transition: border-color 0.2s, box-shadow 0.2s;
        }
        .pub-select-trigger:hover { border-color: #5DA630; }
        .pub-select-trigger.active { border-color: #5DA630; box-shadow: 0 0 0 3px rgba(93, 166, 48, 0.15); }
        .pub-select-trigger .trigger-arrow { width: 18px; height: 18px; color: #6b7280; transition: transform 0.2s; flex-shrink: 0; }
        .pub-select-trigger.active .trigger-arrow { transform: rotate(180deg); }
        .pub-select-dropdown {
            position: absolute; top: calc(100% + 6px); left: 0; right: 0;
            background: #fff; border: 1px solid #e2e8f0; border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.12); z-index: 50;
            overflow: hidden; animation: pubDropOpen 0.2s ease-out;
            max-height: 240px; overflow-y: auto;
        }
        .pub-select-dropdown::-webkit-scrollbar { width: 4px; }
        .pub-select-dropdown::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .pub-select-item { padding: 0.75rem 1.25rem; cursor: pointer; font-size: 14px; color: #374151; transition: background 0.15s; }
        .pub-select-item:hover { background: #f0fdf4; }
        .pub-select-item.selected { background: #f0fdf4; color: #166534; font-weight: 600; }
        .pub-select-item.placeholder { color: #9ca3af; }
        @keyframes pubDropOpen { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: translateY(0); } }

        .radio-group,
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 4px;
        }

        .radio-option,
        .checkbox-option {
            display: flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            border: 1px solid #a1a1aa;
            padding: 6px 16px;
            border-radius: 9999px;
            cursor: pointer;
            font-size: 13px;
            color: #3f3f46;
            transition: background 0.2s, border-color 0.2s;
        }

        @media (min-width: 640px) {
            .radio-option,
            .checkbox-option {
                font-size: 14px;
            }
        }

        .radio-option:hover,
        .checkbox-option:hover {
            background: #f4f4f5;
        }

        .radio-option input,
        .checkbox-option input {
            accent-color: #5DA630;
            width: 16px;
            height: 16px;
        }

        .file-input-wrapper {
            display: flex;
            align-items: center;
        }

        .file-input {
            display: block;
            width: 100%;
            font-size: 14px;
            color: #71717a;
            cursor: pointer;
        }

        .file-input::file-selector-button {
            margin-right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            border: 1px solid #b4c4dd;
            font-size: 14px;
            font-weight: 500;
            background: #eff4fd;
            color: #3f3f46;
            cursor: pointer;
            transition: background 0.2s;
        }

        .file-input::file-selector-button:hover {
            background: #e0eaf9;
        }

        .submit-wrapper {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .submit-btn {
            width: 90%;
            max-width: 400px;
            background: #5DA630;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            padding: 1rem 3rem;
            border-radius: 9999px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(93, 166, 48, 0.2);
        }

        .submit-btn:hover {
            background: #4a8a26;
            box-shadow: 0 6px 20px rgba(93, 166, 48, 0.3);
        }

        .submit-btn:active {
            transform: scale(0.97);
        }

        /* Success Message */
        .success-overlay {
            position: fixed;
            inset: 0;
            background: rgba(13, 43, 5, 0.5);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 1rem;
            animation: fadeIn 0.3s ease-out;
        }

        .success-card {
            background: #fff;
            border-radius: 32px;
            padding: 3rem 2rem;
            text-align: center;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            animation: scaleIn 0.4s ease-out;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #5DA630, #7FC248);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 32px rgba(93, 166, 48, 0.3);
        }

        .success-icon svg {
            width: 40px;
            height: 40px;
            color: #fff;
        }

        .success-title {
            font-size: 22px;
            font-weight: 700;
            color: #0D2B05;
            margin-bottom: 0.5rem;
        }

        .success-text {
            color: #71717a;
            font-size: 14px;
            line-height: 1.6;
        }

        .error-text {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
            margin-left: 4px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Branding footer */
        .brand-footer {
            text-align: center;
            margin-top: 2rem;
            color: #a1a1aa;
            font-size: 11px;
        }

        .brand-footer a {
            color: #5DA630;
            text-decoration: none;
            font-weight: 600;
        }

        /* Closed State Styling */
        .closed-state {
            text-align: center;
            padding: 1.5rem 0 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .closed-icon {
            width: 80px;
            height: 80px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border: 1px solid #fee2e2;
            box-shadow: 0 8px 32px rgba(239, 68, 68, 0.15);
        }
        .closed-icon svg {
            width: 40px;
            height: 40px;
            color: #ef4444;
        }
        .closed-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        .closed-desc {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 2rem;
            max-width: 320px;
            line-height: 1.6;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f3f4f6;
            color: #374151;
            padding: 0.85rem 1.75rem;
            border-radius: 9999px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            border: 1px solid #e5e7eb;
        }
        .btn-back:hover {
            background: #e5e7eb;
            color: #111827;
            transform: translateY(-2px);
        }
        .btn-back svg {
            width: 18px;
            height: 18px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-card">
            {{-- Logo & Title --}}
            <div class="logo-wrapper">
                <img src="/images/logo.svg" alt="Logo Taman Zakat" onerror="this.style.display='none'">
                <h1 class="form-title">{{ $form->title }}</h1>
                @if($form->description)
                    <p class="form-description">{{ $form->description }}</p>
                @endif
            </div>

            {{-- Form Status Check --}}
            @if(!$form->is_active)
                <div class="closed-state">
                    <div class="closed-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h2 class="closed-title">Formulir Ditutup</h2>
                    <p class="closed-desc">Mohon maaf, formulir ini sudah tidak menerima tanggapan baru untuk saat ini.</p>
                    <a href="{{ env('FRONTEND_URL', 'http://localhost:3000') }}" class="btn-back">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            @else
                {{-- Form --}}
                <form action="{{ route('public.form.submit', $form->slug) }}" method="POST" enctype="multipart/form-data" class="form-body">
                    @csrf

                @foreach($form->fields as $field)
                    <div class="field-group">
                        <label class="field-label">
                            {{ $field->label }}
                            @if($field->is_required)
                                <span class="field-required">*</span>
                            @endif
                        </label>

                        @switch($field->type)
                            @case('text')
                            @case('email')
                            @case('number')
                            @case('date')
                                <input 
                                    type="{{ $field->type }}" 
                                    name="field_{{ $field->id }}" 
                                    class="field-input"
                                    value="{{ old('field_' . $field->id) }}"
                                    {{ $field->is_required ? 'required' : '' }}
                                >
                                @break

                            @case('textarea')
                                <textarea 
                                    name="field_{{ $field->id }}" 
                                    class="field-textarea" 
                                    rows="4"
                                    {{ $field->is_required ? 'required' : '' }}
                                >{{ old('field_' . $field->id) }}</textarea>
                                @break

                            @case('select')
                                <select 
                                    name="field_{{ $field->id }}" 
                                    class="field-select"
                                    {{ $field->is_required ? 'required' : '' }}
                                >
                                    <option value="">-- Pilih --</option>
                                    @if($field->options)
                                        @foreach($field->options as $option)
                                            <option value="{{ $option }}" {{ old('field_' . $field->id) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="pub-select-wrapper">
                                    <div class="pub-select-trigger" onclick="togglePubSelect(this)">
                                        <span class="pub-select-text" style="{{ old('field_' . $field->id) ? '' : 'color:#9ca3af' }}">{{ old('field_' . $field->id) ?: '-- Pilih --' }}</span>
                                        <svg class="trigger-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                                @break

                            @case('radio')
                                <div class="radio-group">
                                    @if($field->options)
                                        @foreach($field->options as $option)
                                            <label class="radio-option">
                                                <input 
                                                    type="radio" 
                                                    name="field_{{ $field->id }}" 
                                                    value="{{ $option }}"
                                                    {{ old('field_' . $field->id) == $option ? 'checked' : '' }}
                                                >
                                                <span>{{ $option }}</span>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                @break

                            @case('checkbox')
                                <div class="checkbox-group">
                                    @if($field->options)
                                        @foreach($field->options as $option)
                                            <label class="checkbox-option">
                                                <input 
                                                    type="checkbox" 
                                                    name="field_{{ $field->id }}[]" 
                                                    value="{{ $option }}"
                                                    {{ is_array(old('field_' . $field->id)) && in_array($option, old('field_' . $field->id)) ? 'checked' : '' }}
                                                >
                                                <span>{{ $option }}</span>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                @break

                            @case('file')
                                <div class="file-input-wrapper">
                                    <input 
                                        type="file" 
                                        name="field_{{ $field->id }}" 
                                        class="file-input"
                                        accept="image/*,.pdf,.doc,.docx,.xls,.xlsx"
                                        {{ $field->is_required ? 'required' : '' }}
                                    >
                                </div>
                                @break
                        @endswitch

                        @error('field_' . $field->id)
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div class="submit-wrapper">
                    <button type="submit" class="submit-btn">Kirim</button>
                </div>
            </form>
            @endif
        </div>

        <div class="brand-footer">
            Didukung oleh <a href="#">Taman Zakat</a>
        </div>
    </div>

    {{-- Success Overlay --}}
    @if(session('success'))
        <div class="success-overlay" onclick="this.remove()">
            <div class="success-card" onclick="event.stopPropagation()">
                <div class="success-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h2 class="success-title">Terima Kasih!</h2>
                <p class="success-text">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <script>
        function togglePubSelect(trigger) {
            const wrapper = trigger.closest('.pub-select-wrapper');
            let dropdown = wrapper.querySelector('.pub-select-dropdown');
            const isOpen = dropdown !== null;

            document.querySelectorAll('.pub-select-dropdown').forEach(d => d.remove());
            document.querySelectorAll('.pub-select-trigger').forEach(t => t.classList.remove('active'));

            if (!isOpen) {
                const selectEl = wrapper.previousElementSibling;
                dropdown = document.createElement('div');
                dropdown.className = 'pub-select-dropdown';

                Array.from(selectEl.options).forEach(opt => {
                    const item = document.createElement('div');
                    item.className = 'pub-select-item' + (opt.selected && opt.value ? ' selected' : '') + (!opt.value ? ' placeholder' : '');
                    item.textContent = opt.text;
                    item.addEventListener('click', () => {
                        selectEl.value = opt.value;
                        const textEl = wrapper.querySelector('.pub-select-text');
                        textEl.textContent = opt.text;
                        textEl.style.color = opt.value ? '#27272a' : '#9ca3af';
                        dropdown.remove();
                        trigger.classList.remove('active');
                    });
                    dropdown.appendChild(item);
                });

                wrapper.appendChild(dropdown);
                trigger.classList.add('active');
            }
        }

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.pub-select-wrapper')) {
                document.querySelectorAll('.pub-select-dropdown').forEach(d => d.remove());
                document.querySelectorAll('.pub-select-trigger').forEach(t => t.classList.remove('active'));
            }
        });
    </script>
</body>
</html>
