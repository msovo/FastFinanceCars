@extends('layouts.index')

@section('content')

<style>
body {
    font-family: 'Arial', sans-serif;
}

.container {
    margin-top: 50px;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    background: #a89884;
    margin-top: 20px;
    color: white;
    font-size: 1.5rem;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card-body {
    background: #e5e5e5;
    padding: 30px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ddd;

    font-size: 1rem;
}

.form-control:focus {
    border-color: #ff7e5f;
    box-shadow: 0 0 5px rgba(255, 126, 95, 0.5);
}

.btn-primary {
    background: #ff7e5f;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: #feb47b;
}

.invalid-feedback, .password-feedback {
    color: #ff7e5f;
    font-size: 0.9rem;
    display: none;
}

.valid-feedback {
    color: #28a745;
    font-size: 0.9rem;
}

.password-strength {
    margin-top: 5px;
    font-size: 0.9rem;
}

.weak {
    color: red;
}

.moderate {
    color: orange;
}

.strong {
    color: green;
}

.mandatory {
    color: red;
    margin-left: 5px;
}
.row {
    margin-right:0 !important; 
}
</style>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Signup</div>
            <div class="card-body">
                <form id="signup-form" action="{{ route('signup') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Full Names <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <span class="invalid-feedback" id="username-error">This field is required.</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email <span class="mandatory">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <span class="invalid-feedback" id="email-error">Please provide a valid email address.</span>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="password">Password <span class="mandatory">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span id="password-feedback" style="font-size:13px;">
                                <span id="capital">Capital Letter</span>, 
                                <span id="number">Number</span>, 
                                <span id="specialChar">Special Character</span>, 
                                <span id="length">8 Characters</span>
                            </span>
                            <div id="password-strength-meter" class="password-strength"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirm_password">Confirm Password <span class="mandatory">*</span></label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <span class="invalid-feedback" id="confirm-password-error">Passwords do not match.</span>
                        </div>

                    </div>
              
                 
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="country">Country <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" value="South Africa" readonly>
                            <span class="invalid-feedback" id="country-error">This field is required.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_type">You want to register as? <span class="mandatory">*</span></label>
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="">Choose your option</option>
                            <option value="buyer">Buyer</option>
                            <option value="private_seller">Private Seller</option>
                            <option value="dealer">Dealer</option>
                        </select>
                        <span class="invalid-feedback" id="user_type-error">This field is required.</span>
                    </div>
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">Signup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('signup-form').addEventListener('submit', function(event) {
    let isValid = true;

    // Validate required fields
    const fields = ['username', 'email', 'password', 'confirm_password', 'user_type'];
    fields.forEach(function(field) {
        const input = document.getElementById(field);
        const error = document.getElementById(field + '-error');
        if (!input.value.trim()) {
            error.style.display = 'inline';
            isValid = false;
        } else {
            error.style.display = 'none';
        }
    });

    // Password match validation
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const confirmPasswordError = document.getElementById('confirm-password-error');
    if (password !== confirmPassword) {
        confirmPasswordError.style.display = 'inline';
        isValid = false;
    } else {
        confirmPasswordError.style.display = 'none';
    }

    if (!isValid) {
        event.preventDefault();
    }
});

// Password strength validation
// Password strength and requirements
document.getElementById('password').addEventListener('input', function () {
    const password = this.value;

    // Individual requirement checks
    const capital = /[A-Z]/.test(password);
    const number = /\d/.test(password);
    const specialChar = /[@$!%*?&]/.test(password);
    const length = password.length >= 8;

    // Update strength indicator elements
    updateRequirement('capital', capital);
    updateRequirement('number', number);
    updateRequirement('specialChar', specialChar);
    updateRequirement('length', length);

    // Update overall password strength
    const strengthMeter = document.getElementById('password-strength-meter');
    const totalStrength = [capital, number, specialChar, length].filter(Boolean).length;

    if (totalStrength === 4) {
        strengthMeter.textContent = 'Strong';
        strengthMeter.style.color = 'green';
    } else if (totalStrength >= 2) {
        strengthMeter.textContent = 'Moderate';
        strengthMeter.style.color = 'orange';
    } else {
        strengthMeter.textContent = 'Weak';
        strengthMeter.style.color = 'red';
    }
});

// Confirm password validation
document.getElementById('confirm_password').addEventListener('input', function () {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    const confirmPasswordError = document.getElementById('confirm-password-error');

    if (password !== confirmPassword) {
        confirmPasswordError.style.display = 'inline';
    } else {
        confirmPasswordError.style.display = 'none';
    }
});

// Utility function to update requirement visuals
function updateRequirement(id, isValid) {
    const element = document.getElementById(id);
    element.style.color = isValid ? 'green' : 'red';
}

</script>

@endsection
