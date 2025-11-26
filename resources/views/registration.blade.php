@extends('layouts.app')

@section('title', 'Teacher Registration')

@section('content')
    <h1>Teacher Registration</h1>
    <p class="subtitle">Please fill out the form below to register your account</p>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('registration.submit') }}" id="registrationForm">
        @csrf

        <div class="form-group">
            <label for="first_name">First Name <span style="color: #e74c3c;">*</span></label>
            <input 
                type="text" 
                id="first_name" 
                name="first_name" 
                value="{{ old('first_name') }}"
                required
                autocomplete="given-name"
            >
            @error('first_name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">Last Name <span style="color: #e74c3c;">*</span></label>
            <input 
                type="text" 
                id="last_name" 
                name="last_name" 
                value="{{ old('last_name') }}"
                required
                autocomplete="family-name"
            >
            @error('last_name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email <span style="color: #e74c3c;">*</span></label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}"
                required
                autocomplete="email"
            >
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Subjects Taught <span style="color: #e74c3c;">*</span></label>
            <div class="checkbox-group">
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_math" name="subjects[]" value="Mathematics" {{ in_array('Mathematics', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_math">Mathematics</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_science" name="subjects[]" value="Science" {{ in_array('Science', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_science">Science</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_english" name="subjects[]" value="English" {{ in_array('English', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_english">English</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_history" name="subjects[]" value="History" {{ in_array('History', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_history">History</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_geography" name="subjects[]" value="Geography" {{ in_array('Geography', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_geography">Geography</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_art" name="subjects[]" value="Art" {{ in_array('Art', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_art">Art</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_pe" name="subjects[]" value="Physical Education" {{ in_array('Physical Education', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_pe">Physical Education</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_music" name="subjects[]" value="Music" {{ in_array('Music', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_music">Music</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_computer" name="subjects[]" value="Computer Science" {{ in_array('Computer Science', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_computer">Computer Science</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="subject_foreign" name="subjects[]" value="Foreign Languages" {{ in_array('Foreign Languages', old('subjects', [])) ? 'checked' : '' }}>
                    <label for="subject_foreign">Foreign Languages</label>
                </div>
            </div>
            @error('subjects')
                <span class="error-message">{{ $message }}</span>
            @enderror
            @error('subjects.*')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Register</button>
    </form>

    <div class="api-section">
        <h2>API Endpoint</h2>
        <p>You can also register via API:</p>
        <div class="api-endpoint">
            POST /api/teachers/register
        </div>
        <p style="font-size: 12px; color: #999;">
            Request body: { "first_name": "...", "last_name": "...", "email": "...", "subjects": ["..."] }
        </p>
    </div>

    <script>
        // Client-side validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const subjects = document.querySelectorAll('input[name="subjects[]"]:checked');
            if (subjects.length === 0) {
                e.preventDefault();
                alert('Please select at least one subject.');
                return false;
            }
        });
    </script>
@endsection

