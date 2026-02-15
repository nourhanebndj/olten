@extends('layouts.main')

@section('title', 'Détail de l\'annonce - Olten-location.fr')

@section('content')

<h2>Finaliser votre réservation</h2>

<form id="payment-form">
    @csrf

    <div class="d-flex p-3 gap-3">
        <div class="w-50 border p-2 rounded">
            <div class="form-group">
                <label class="form-label">Nom</label>
                <input type="text" value="{{ auth()->user()->lastname }}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Prénom</label>
                <input type="text" value="{{ auth()->user()->firstname }}" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Téléphone</label>
                <input type="tel" id="phone" class="w-100" required>
                <input type="hidden" id="phone_full" name="phone">
            </div>

            <div class="form-group">
                <label class="form-label">Date de début</label>
                <input type="date" value="{{ session('start_date') }}" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Date de fin</label>
                <input type="date" value="{{ session('end_date') }}" readonly>
            </div>
        </div>

        <div class="w-50 border p-2 rounded h-25">
            {{-- STRIPE --}}
            <div class="form-group">
                <label class="form-label">Carte bancaire</label>
                <div id="card-element"></div>
                <div id="card-errors" style="color:red;"></div>
            </div>
                <div class="text-end">
                    <button id="submit" class="btn-submit w-auto">Payer & Réserver</button>
                </div>
        </div>
    </div>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>

<script>
/* TELEPHONE */
const phoneInput = document.querySelector("#phone");
const iti = window.intlTelInput(phoneInput, {
    initialCountry: "fr",
    separateDialCode: true,
    utilsScript:
      "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
});

phoneInput.addEventListener("blur", () => {
    document.getElementById("phone_full").value = iti.getNumber();
});

/* STRIPE */
const stripe = Stripe("{{ config('services.stripe.key') }}");
const elements = stripe.elements();
const card = elements.create("card");
card.mount("#card-element");

const form = document.getElementById("payment-form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const {paymentMethod, error} = await stripe.createPaymentMethod({
        type: "card",
        card: card,
    });

    if (error) {
        document.getElementById("card-errors").textContent = error.message;
        return;
    }

    fetch("{{ route('bookings.pay') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({
            payment_method: paymentMethod.id,
            phone: document.getElementById("phone_full").value,
            start_date: "{{ session('start_date') }}",
            end_date: "{{ session('end_date') }}",
            ad_id: "{{ session('ad')->id }}"
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            alert(data.message);
        }
    });
});
</script>

@endsection
