document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('registerForm');
    const errorsDiv = document.getElementById('registerErrors');

    if (!form) return;

    form.addEventListener('submit', function(e){
        e.preventDefault();
        errorsDiv.innerHTML = '';

        const formData = new FormData(form);

        fetch(REGISTER_URL, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async response => {
            const data = await response.json();

            if (response.status === 422) {
                if(data.errors) {
                    for (let key in data.errors) {
                        data.errors[key].forEach(msg => {
                            const p = document.createElement('p');
                            p.className = "text-danger";
                            p.textContent = msg;
                            errorsDiv.appendChild(p);
                        });
                    }
                }
            } else if (data.status === 'error') {
                if(data.errors) {
                    for (let key in data.errors) {
                        data.errors[key].forEach(msg => {
                            const p = document.createElement('p');
                            p.className = "text-danger";
                            p.textContent = msg;
                            errorsDiv.appendChild(p);
                        });
                    }
                }
            } else if (data.status === 'success') {
                window.location.href = data.redirect;
            }
        })
        .catch(err => {
            console.error(err);
            const p = document.createElement('p');
            p.className = "text-danger";
            p.textContent = "Une erreur est survenue. Veuillez réessayer.";
            errorsDiv.appendChild(p);
        });

    });

});

// connexion
document.getElementById('login-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    document.getElementById('login-errors').innerHTML = "";

    try {
        const response = await fetch(LOGIN_URL, {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": CSRF_TOKEN,
                "Accept": "application/json"
            },
            body: formData
        });

        const data = await response.json();

        if (response.ok && data.status === 'success') {
            window.location.href = LOGIN_REDIRECT;
            return;
        }

        let errorBox = `<div class="errors">`;

        if (data.errors) {
            Object.keys(data.errors).forEach(field => {
                data.errors[field].forEach(msg => {
                    errorBox += `<p class="text-danger">${msg}</p>`;
                });
            });
        } 
        else if (data.message) {
            errorBox += `<p class="text-danger">${data.message}</p>`;
        }

        errorBox += `</div>`;
        document.getElementById('login-errors').innerHTML = errorBox;

    } catch (err) {
        console.error(err);
    }
});

