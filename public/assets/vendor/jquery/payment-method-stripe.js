window.onload = function () {
    const stripe = Stripe('pk_test_a5YPZqZcfYT0Z1F9EHkOnnKc00WeGEVRDm');

    // Create Pre-Built UI Components
    const elements = stripe.elements();
    // Creates An Instance Of A Specific Element
    const cardElement = elements.create('card');
    // Attaches Your Element To The DOM
    cardElement.mount('#card-element');


    // Take Property
    const cardButton = document.getElementById('card-button');

    let takeMethod = cardButton.dataset.secret;


    if (takeMethod === '') {
        singleMethod()
    } else {
        subcribeMethod()
    }


    function singleMethod() {
        // Take Property
        const cardHolderName = document.getElementById('card-holder-name');

        // Input Validation
        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: { name: cardHolderName.value }
                }
            );

            if (error) {
                alert(error.message);
                return false;
            }
            document.getElementById('payment-method-id').value = paymentMethod.id;

            document.getElementById('payment-form').submit();
        });
    }

    function subcribeMethod() {
        // Take Values
        const clientSecret = cardButton.dataset.secret;

        // Input Validation
        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const {setupIntent, error} = await stripe.handleCardSetup(
                clientSecret, cardElement, {
                    payment_method_data: {
                        billing_details: {
                            name: document.getElementById('card-holder-name').value
                        }
                    }
                }
            );
            if (error) {
                alert(error.message);
                return false;
            }

            document.getElementById('payment-method-id').value = setupIntent.payment_method;

            document.getElementById('payment-form').submit();
        });
    }

};





















