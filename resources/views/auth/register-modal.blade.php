<style>

    #resendOtpBtn:disabled {
    color: #adb5bd;
    cursor: not-allowed;
    text-decoration: none;
}

</style>

<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <!-- HEADER -->
      <div class="modal-header text-white"
           style="background: linear-gradient(135deg, #fbbf24, #f59e0b);">
        <h5 class="modal-title fw-semibold">Create Your Account ✨</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body p-4">

        <p class="text-muted small mb-3">
          Join <strong>Kodai Choco</strong> and enjoy exclusive deals
        </p>

        <div id="registerErrors" class="alert alert-danger d-none"></div>

        <form id="registerForm">
          @csrf

          <!-- STEP INDICATOR -->
          <div class="text-center mb-3">
            <span id="stepBadge" class="badge bg-warning">Step 1 of 3</span>
          </div>

          <!-- STEP 1 : BASIC -->
          <div id="stepBasic">
            <div class="form-floating mb-3">
              <input type="text" name="name" id="regName"
                     class="form-control" placeholder="Full Name" required>
              <label>Full Name</label>
            </div>

            <div class="form-floating mb-3">
              <input type="text" name="phone" id="regPhone"
                     class="form-control" placeholder="9876543210" required>
              <label>Phone Number</label>
            </div>

            <button type="button" id="sendOtpBtn"
                    class="btn btn-warning w-100 rounded-pill" disabled>
              Send OTP
            </button>
          </div>

          <!-- STEP 2 : OTP -->
          <div id="stepOtp" class="d-none mt-3">
            <div class="form-floating mb-3">
              <input type="text" name="otp" id="regOtp"
                     class="form-control" placeholder="OTP">
              <label>Enter OTP</label>
              <!-- <small class="text-muted">OTP valid for 30 seconds</small> -->
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <small id="otpTimer" class="text-muted">
                    OTP expires in <b>30s</b>
                </small>

                <button type="button"
                        id="resendOtpBtn"
                        class="btn btn-link btn-sm text-warning p-0"
                        disabled>
                    Resend OTP
                </button>
            </div>

            <button type="button" id="verifyOtpBtn"
                    class="btn btn-warning w-100 rounded-pill">
              Verify OTP
            </button>
            <!-- OTP INFO -->


          </div>
          

          <!-- STEP 3 : ACCOUNT -->
          <div id="stepAccount" class="d-none mt-3">
            <div class="form-floating mb-3">
              <input type="email" name="email" id="regEmail"
                     class="form-control" placeholder="Email">
              <label>Email Address</label>
            </div>

            <div class="form-floating mb-3">
              <input type="password" name="password" id="regPassword"
                     class="form-control" placeholder="Password">
              <label>Password</label>
            </div>

            <div class="form-floating mb-3">
              <input type="password" name="password_confirmation"
                     class="form-control" placeholder="Confirm Password">
              <label>Confirm Password</label>
            </div>

            <button type="button" id="createAccountBtn"
                    class="btn btn-warning w-100 rounded-pill">
              Create Account
            </button>
          </div>

        </form>

        <div class="text-center mt-4">
          <span class="small text-muted">Already have an account?</span>
          <a href="#" class="fw-semibold text-warning"
             data-bs-dismiss="modal"
             data-bs-toggle="modal"
             data-bs-target="#loginModal">
            Login
          </a>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
const phoneInput = document.getElementById('regPhone');
const sendOtpBtn = document.getElementById('sendOtpBtn');
const verifyOtpBtn = document.getElementById('verifyOtpBtn');
const createAccountBtn = document.getElementById('createAccountBtn');
const errorBox = document.getElementById('registerErrors');

const stepBasic = document.getElementById('stepBasic');
const stepOtp = document.getElementById('stepOtp');
const stepAccount = document.getElementById('stepAccount');
const stepBadge = document.getElementById('stepBadge');

// PHONE VALIDATION
phoneInput.addEventListener('input', () => {
  phoneInput.value = phoneInput.value.replace(/\D/g,'');
  sendOtpBtn.disabled = phoneInput.value.length !== 10;
});

// SEND OTP
sendOtpBtn.onclick = async () => {
  errorBox.classList.add('d-none');
  const formData = new FormData(registerForm);

  const res = await fetch("{{ route('register.sendOtp') }}", {
    method:'POST',
    headers:{
      'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,
      'Accept':'application/json'
    },
    body:formData
  });

  const data = await res.json();
  if(!res.ok){
    showErrors(data.errors);
    return;
  }

  stepBasic.classList.add('d-none');
  stepOtp.classList.remove('d-none');
  stepBadge.innerText = 'Step 2 of 3';
  startOtpTimer(); 
};

// VERIFY OTP
verifyOtpBtn.onclick = async () => {
  errorBox.classList.add('d-none');
  const formData = new FormData(registerForm);

  const res = await fetch("{{ route('register.verifyOtp') }}", {
    method:'POST',
    headers:{
      'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,
      'Accept':'application/json'
    },
    body:formData
  });

  const data = await res.json();
  if(!res.ok){
    errorBox.innerText = data.message;
    errorBox.classList.remove('d-none');
    return;
  }

  stepOtp.classList.add('d-none');
  stepAccount.classList.remove('d-none');
  stepBadge.innerText = 'Step 3 of 3';
};

// CREATE ACCOUNT
createAccountBtn.onclick = async () => {
  errorBox.classList.add('d-none');
  const formData = new FormData(registerForm);

  const res = await fetch("{{ route('register.complete') }}", {
    method:'POST',
    headers:{
      'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,
      'Accept':'application/json'
    },
    body:formData
  });

  const data = await res.json();
  if(!res.ok){
    errorBox.innerText = data.message;
    errorBox.classList.remove('d-none');
    return;
  }

bootstrap.Modal.getInstance(registerModal).hide();

if (data.redirect) {
    window.location.href = data.redirect;
} else {
    window.location.href = "/cart";
}

};

// ERROR HANDLER
function showErrors(errors){
  errorBox.innerHTML='';
  Object.values(errors).forEach(e=>errorBox.innerHTML+=`<div>${e[0]}</div>`);
  errorBox.classList.remove('d-none');
}

//otp counting 

let otpSeconds = 300; // 5 minutes

let otpInterval = null;

// START TIMER
function startOtpTimer() {
    otpSeconds = 120;
    document.getElementById('resendOtpBtn').disabled = true;
    updateOtpTimer();

    otpInterval = setInterval(() => {
        otpSeconds--;
        updateOtpTimer();

        if (otpSeconds <= 0) {
            clearInterval(otpInterval);
            document.getElementById('otpTimer').innerHTML =
                '<span class="text-danger">OTP expired</span>';
            document.getElementById('resendOtpBtn').disabled = false;
        }
    }, 1000);
}

// UPDATE TIMER TEXT
function updateOtpTimer() {
    document.getElementById('otpTimer').innerHTML =
        `OTP expires in <b>${otpSeconds}s</b>`;
}




// RESEND OTP BUTTON (SAFE)
document.getElementById('resendOtpBtn').onclick = async () => {

    const errorBox = document.getElementById('registerErrors');
    errorBox.classList.add('d-none');

    const formData = new FormData(registerForm);

    const res = await fetch("{{ route('register.sendOtp') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    });

    const data = await res.json();

    if (!res.ok) {
        errorBox.innerText = data.message || 'Unable to resend OTP';
        errorBox.classList.remove('d-none');
        return;
    }

    // Restart timer
    clearInterval(otpInterval);
    startOtpTimer();
};


</script>





